<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Image;

class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }

    /**
     * 设置头像.
     *
     * @param Request $request
     */
    public function uploadAvatar(Request $request)
    {
        if (!$user = Auth::user()) {
            return response('Unauthorized.', 401);
        }

        $data = $request->all();

        $file = $request->file('avatar');

        if ($file->isValid()) {
            $avatarUrl = "/uploads/avatar/avatar-{$user->id}.jpg";

//            Image::make($file)->resize($data['width'], $data['height'])->crop($data['cropWidth'], $data['cropHeight'], $data['cropX'], $data['cropY'])->save(public_path($avatarUrl));
            Image::make($file)->save(public_path($avatarUrl));

            $this->userRepository->update(['avatar' => $avatarUrl], $user->id);

            $token = \JWTAuth::refresh(true);

            return response()->json(['status' => 1, 'info' => '保存成功', 'token' => $token]);
        } else {
            $token = \JWTAuth::refresh(true);

            return response()->json(['status' => 0, 'info' => '文件无效', 'token' => $token]);
        }
    }
}
