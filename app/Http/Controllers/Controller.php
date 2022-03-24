<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function errorResponse($msg)
    {
        request()->session()->flash('error', $msg);
        return redirect()->back()->withInput();
    }

    public function successResponse($msg = null)
    {
        request()->session()->flash('success', $msg);
    }
}
