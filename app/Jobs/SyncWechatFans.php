<?php

namespace App\Jobs;

use App\Repositories\FanRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncWechatFans implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const PAGE_SIZE = 20;

    /**
     * @var FanRepository
     */
    private $fanRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $accountId = \Request::header('AccountId');

        $wechatFansService = app('easywechat')->user;

        $this->fanRepository = app(FanRepository::class);

        $nextOpenid = null;
        do {
            $lists = $wechatFansService->lists($nextOpenid);

            if ($openids = $lists['data']['openid'] ?? []) {
                $batchResult = $wechatFansService->batchGet($lists['data']['openid']);

                foreach ($batchResult['user_info_list'] as $key => $fan) {
                    $this->fanRepository->updateOrCreate(['account_id' => $accountId, 'openid' => $fan['openid']], array_merge(['account_id' => $accountId], $fan));
                }
            }

            $nextOpenid = $lists['next_openid'];
        } while ($lists['next_openid']);

        // TODO: 删除本地库中存在但微信服务器上不存在的粉丝数据，即已经取关的粉丝
    }
}
