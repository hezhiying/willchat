<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Request;

class BaseController extends Controller
{
    protected $currentAccountId;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        if (Request::hasHeader('AccountId')) {
            $this->currentAccountId = Request::header('AccountId');
        }
    }
}
