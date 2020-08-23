<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContentPost;
use App\ContentPostTranslation;
use App\Menu;
use App\Banner;
use App\Setting;
use App\SettingHome;
use Illuminate\Support\Str;
use Mail;

class HomeController extends BaseController
{
    public $successStatus = 200;
    public $Status = true;

    public function index(Request $request){
        $errorMessages = array();
        $lang = 'id';
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        $error = '';
        try {
            if($lang == 'id'){
                $kontak = SettingHome::where('type',3)->where('key','kontak.id')->first();
            }else{
                $kontak = SettingHome::where('type',3)->where('key','kontak.en')->first();
            }
            $item = array(
                'banner' => Banner::get(),
                'press' => ContentPostTranslation::join('content_posts','content_posts.id','=','content_post_translations.content_post_id')
                    ->where('content_posts.category_id',32)->where('content_post_translations.locale',$lang)->select('content_post_translations.*')->limit(3)->get(),
                'menu' => SettingHome::leftJoin('menus','menus.id','=','setting_homes.menu_id')
                ->select('menus.*')->where('setting_homes.type',1)->get(),
                'video' => SettingHome::where('type',2)->first(),
                'kontak_kami' => array(
                    'text' => $kontak->value,
                    'button' => $kontak->display_name
                )
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            dd($th);
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