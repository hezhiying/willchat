<?php

namespace App\Http\Controllers\Api;

use App\Repositories\MaterialRepository;

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
}
