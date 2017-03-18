<?php

namespace App\Http\Controllers\Api;

use App\Repositories\QrcodeRepository;
use Illuminate\Http\Request;

class QrcodeController extends BaseController
{
    /**
     * @var QrcodeRepository;
     */
    private $qrcodeRepository;

    /**
     * QrcodeController constructor.
     *
     * @param QrcodeRepository $qrcodeRepository
     */
    public function __construct(QrcodeRepository $qrcodeRepository)
    {
        parent::__construct();

        $this->qrcodeRepository = $qrcodeRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {
        $keyword = $request->input('keyword');
        $sex = $request->input('sex', 'all');

        $qrcodes = $this->qrcodeRepository->scopeQuery(function ($query) use ($keyword, $sex) {
            $query->where('account_id', $this->currentAccountId);

//            if ($keyword) {
//                $query->where('nickname', 'like', "%{$keyword}%");
//            }
//
//            if ($sex !== 'all') {
//                $query->where('sex', $sex);
//            }

            return $query;
        })->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->paginate();

        return response()->json(compact('qrcodes'));
    }
}
