<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SynchronizeWechatMaterials;
use App\Material;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;

class MaterialController extends BaseController
{
    /**
     * @var MaterialRepository
     */
    private $materialRepository;

    /**
     * FansController constructor.
     *
     * @param MaterialRepository $materialRepository
     */
    public function __construct(MaterialRepository $materialRepository)
    {
        parent::__construct();

        $this->materialRepository = $materialRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {
        $keyword = $request->input('keyword');

        $type = $request->input('type');

        $materials = $this->materialRepository->where('type', $type)->where(function ($query) use ($keyword) {
            if ($keyword) {
                $query->where('media_id', 'like', "%{$keyword}%")->orWhere('name', 'like', "%{$keyword}%");
            }

            return $query;
        })->orderBy('created_at', 'DESC')->paginate(30);

        return response()->json(compact('materials'));
    }

    /**
     * 上传素材.
     *
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $type = $request->input('type');

        $description = $request->input('description');

        $file = $request->file;

        if ($file->isValid()) {
            try {
                // 图片先上传到业务服务器
                $localResult = $request->file->move('material_temp', $file->getClientOriginalName());

                if ($type === Material::TYPE_IMAGE) {
                    // 上传图片素材到微信
                    $uploadResult = app('wechat')->material->uploadImage($localResult->getRealPath());
                } elseif ($type === Material::TYPE_VOICE) {
                    // 上传语音素材到微信
                    $uploadResult = app('wechat')->material->uploadVoice($localResult->getRealPath());
                } elseif ($type === Material::TYPE_VIDEO) {
                    // 上传视频素材到微信
                    $uploadResult = app('wechat')->material->uploadVideo($localResult->getRealPath(), $request->input('name'), $description);
                }

                // 添加数据库记录
                $this->materialRepository->create(array_merge($uploadResult->toArray(), ['type' => $type, 'name' => $file->getClientOriginalName(), 'description' => $description]));

                // 删除上传至本地的文件
                unlink(public_path('material_temp/'.$file->getClientOriginalName()));

                return response('上传成功', 200);
            } catch (\Exception $e) {
                return response($e->getMessage(), 500);
            }
        } else {
            return response('上传的文件无效', 400);
        }
    }

    /**
     * 将微信上的素材同步到随手编数据库.
     *
     * @param Request $request
     *
     * @return string
     */
    public function sync(Request $request)
    {
        $type = $request->input('type');

        $this->dispatch(new SynchronizeWechatMaterials($type));

        return response('同步完成', 200);
    }

    /**
     * 删除.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $media_id = $request->input('media_id');

        try {
            // TODO：　删除微信上的素材
//            app('wechat')->material->delete($media_id);

            // 删除本地对应数据记录
            $this->materialRepository->delete($id);

            return response('删除成功');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
