<?php

namespace App\Http\Controllers\Api;

use App\Reply;
use App\Repositories\ReplyRepository;
use Illuminate\Http\Request;

class ReplyController extends BaseController
{
    /**
     * @var ReplyRepository;
     */
    private $replyRepository;

    /**
     * ReplyController constructor.
     *
     * @param ReplyRepository $replyRepository
     */
    public function __construct(ReplyRepository $replyRepository)
    {
        parent::__construct();

        $this->replyRepository = $replyRepository;
    }

    public function lists(Request $request)
    {
        $keyword = $request->input('keyword');
        $sex = $request->input('sex', 'all');

        $fans = $this->fanRepository->scopeQuery(function ($query) use ($keyword, $sex) {
            $query->where('account_id', $this->currentAccountId);

            if ($keyword) {
                $query->where('nickname', 'like', "%{$keyword}%");
            }

            if ($sex !== 'all') {
                $query->where('sex', $sex);
            }

            return $query;
        })->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->paginate();

        return response()->json(compact('fans'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDefaultReply()
    {
        $reply = $this->replyRepository->getDefaultReply($this->currentAccountId);

        return response()->json(compact('reply'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubscribeReply()
    {
        $reply = $this->replyRepository->getSubscribeReply($this->currentAccountId);

        return response()->json(compact('reply'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLists(Request $request)
    {
        $replies = $this->replyRepository->getLists($this->currentAccountId, $request->query('type', 'text'));

        return response()->json(compact('replies'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['account_id'] = $this->currentAccountId;

        $reply = $this->replyRepository->updateOrCreate(['id' => $data['id']], $data);

        return response()->json(compact('reply'));
    }
}
