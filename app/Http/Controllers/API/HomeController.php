<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContentPost;
use App\Menu;
use App\Banner;
use App\Setting;
use Illuminate\Support\Str;
use Mail;

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
                'press' => ContentPost::where('category_id',32)->limit(3)->get(),
                'menu' => Menu::where('id','>',2)->where('parent_id',0)->limit(4)->get(),
                'video' => ContentPost::where('category_id',34)->OrderBy('id','desc')->first(),
                'kontak_kami' => array(
                    'text' => 'Hubungi kami untuk informasi lebih lanjut',
                    'button' => 'Kontak Kami'
                )
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('error', 'terjadi kesalahan pada sistem',400);
        }
    }

    public function sendemail(Request $request){
        $errorMessages = array();
        $error = '';
        try {
            $to_name = 'test';
            $to_email = 'hayria76@yahoo.com';
            $name = 'test';
            $data['sender'] = "[TEST] ".$name;
            $data['content'] = "[TEST] ".$name;
            Mail::send('email.test', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->subject('[TEST]',$to_name);
                $message->from('no-reply@tap-agri.com','no-reply@tap-agri.com');
            });
            $item = array(
                'banner' => Banner::get(),
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            echo 'asd';
            dd($th);
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