<?php

namespace App\Jobs;

use App\Repositories\FanRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncWechatFans implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     *
     */
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

        $materialService = app('easywechat')->material;

        $stats = $materialService->stats();

        $totalCount = $stats[$this->syncMaterialType.'_count'];

        $totalPage = $totalCount / self::PAGE_SIZE;

        $this->fanRepository = app(FanRepository::class);

        for ($i = 0; $i < $totalPage; $i++) {
            $materials = $materialService->lists($this->syncMaterialType, $i, self::PAGE_SIZE);

            if ($materials['item_count']) {
                foreach ($materials['item'] as $material) {
                    app(MaterialRepository::class)->updateOrCreate(['media_id' => $material['media_id']], array_merge($material, ['type' => $this->syncMaterialType, 'account_id' => $accountId]));
                }
            }
        }
    }
}
