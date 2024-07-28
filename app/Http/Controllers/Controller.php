<?php

namespace App\Http\Controllers;

use App\Services\HelperService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $helper;

    public function __construct(HelperService $helper)
    {
        $this->helper = $helper;
    }
}
