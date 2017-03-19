<?php

namespace App\Services;

use App\Account as AccountModel;
use App\Repositories\ReplyRepository;

/**
 * Class WillChat.
 */
class WillChat
{
    /**
     * @var ReplyRepository
     */
    private $replyRepository;

    /**
     * @var AccountModel
     */
    private $account;

    /**
     * Wechat constructor.
     *
     * @param AccountModel $account
     */
    public function __construct(AccountModel $account)
    {
        $this->account = $account;
    }

    /**
     * 公众号对应的 EasyWechat 初始参数.
     *
     * @return array
     */
    private function getWechatOptions()
    {
        return [
            'debug'  => true,
            'app_id' => $this->account->app_id,
            'secret' => $this->account->app_secret,
            'token'  => $this->account->token,
            'log'    => [
                'level' => \Monolog\Logger::DEBUG,
                'file'  => storage_path('logs/easywechat.log'),
            ],
        ];
    }
}
