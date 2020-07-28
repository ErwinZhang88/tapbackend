<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Complain;
use App\Banner;
use App\Setting;
use Illuminate\Support\Str;

class HomeController extends BaseController
{
    public $successStatus = 200;
    public $Status = true;

    public function index(Request $request){
        $errorMessages = array();
        $error = '';
        try {
            $item = array(
                'banner' => Banner::get(),
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('error', 'terjadi kesalahan pada sistem',400);
        }
    }

    public function footer(Request $request){
        $errorMessages = array();
        $error = '';
        try {
            $item = array(
                'contact' => Setting::where('group','site')->get(),
                'sosmed' => Setting::where('group','sosmed')->orderBy('order','asc')->get()
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('error', 'terjadi kesalahan pada sistem',400);
        }
    }
}