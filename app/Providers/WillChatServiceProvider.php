<?php

namespace App\Providers;

use App\Services\User as UserService;
use Illuminate\Support\ServiceProvider;

class WillChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //        $this->registerUserService();
    }

    /**
     * 注册用户服务提供者.
     */
    protected function registerUserService()
    {
        $this->app->singleton('willchat.user_service', function () {
            $user = app('App\User');

            return new UserService($user);
        });
    }

    /**
     * 提供的服务.
     *
     * @return array
     */
    public function provides()
    {
        return ['easywechat' => 'EasyWechat\\Foundation\\Application'];
    }
}
