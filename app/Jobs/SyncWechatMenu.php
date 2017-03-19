<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Account;
use EasyWeChat\Foundation\Application as EasywechatApplication;

class SyncWechatMenu implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Account
     */
    private $account;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $wechat = new EasywechatApplication([
                'debug'  => true,
                'app_id' => $this->account->app_id,
                'secret' => $this->account->app_secret,
                'token'  => $this->account->token,
                'log'    => [
                    'level' => \Monolog\Logger::DEBUG,
                    'file'  => storage_path('logs/easywechat.log'),
                ],
            ]);

            $menu = $wechat->menu->all();


        } catch (\Exception $e) {

        }
    }
}
