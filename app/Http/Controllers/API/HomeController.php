<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContentPost;
use App\ContentPostTranslation;
use App\Menu;
use App\Models\MenuId;
use App\Models\MenuEn;
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
                $menus = SettingHome::leftJoin('menus','menus.id','=','setting_homes.menu_id')
                    ->select('menus.id','setting_homes.display_name as name','menus.nicename','menus.banner','menus.banner_mobile',
                    'menus.icon','menus.parent_id','menus.type','menus.status','menus.comp_name','menus.path','menus.left','menus.right','menus.center')
                    ->where('setting_homes.type',1)->get();
                $banner = Banner::select('id','name','nicename','banner','banner_mobile',
                    'link','type','order')->get();
                $detailpress = SettingHome::where('type',4)->where('key','detail.id')->first();
            }else{
                $kontak = SettingHome::where('type',3)->where('key','kontak.en')->first();
                $menus = SettingHome::leftJoin('menus','menus.id','=','setting_homes.menu_id')
                    ->select('menus.id','setting_homes.value as name','menus.nicenameEn as nicename','menus.banner','menus.banner_mobile',
                    'menus.icon','menus.parent_id','menus.type','menus.status','menus.comp_name','menus.path','menus.left','menus.right','menus.center')
                    ->where('setting_homes.type',1)->get();
                $banner = Banner::select('id','nameEn as name','nicenameEn as nicename','banner','banner_mobile',
                    'link','type','order')->get();
                $detailpress = SettingHome::where('type',4)->where('key','detail.en')->first();
            }
            $item = array(
                'banner' => $banner,
                'press' => ContentPostTranslation::join('content_posts','content_posts.id','=','content_post_translations.content_post_id')
                    ->where('content_posts.category_id',32)->where('content_post_translations.locale',$lang)
                    ->select('content_post_translations.*','content_posts.id')->OrderBy('content_posts.id','desc')->limit(3)->get(),
                'menu' => $menus,
                'video' => SettingHome::where('type',2)->first(),
                'kontak_kami' => array(
                    'text' => $kontak->value,
                    'button' => $kontak->display_name,
                    'image' => $kontak->image
                ),
                'detailpress' => array(
                    'button' => $detailpress->display_name,
                    'text' => $detailpress->value
                )
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('error', 'terjadi kesalahan pada sistem',400);
        }
    }

    public function readmore(Request $request){
        $lang = 'id';
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        if($lang == 'id'){
            $detailpress = SettingHome::where('type',4)->where('key','detail.id')->first();
        }else{
            $detailpress = SettingHome::where('type',4)->where('key','detail.en')->first();
        }
        $item = $detailpress->display_name;
        return $this->sendResponse($item, 'Data successfully.');
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
                'contact' => Setting::where('group','site')->where('order','!=',8)->get(),
                'sosmed' => Setting::where('group','sosmed')->orderBy('order','asc')->get()
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('error', 'terjadi kesalahan pada sistem',400);
        }
    }

    public function karir(Request $request){
        $errorMessages = array();
        $error = '';
        try {
            $item = array(
                'iframe' => Setting::where('group','site')->where('order',8)->select('value')->first()
            );
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('error', 'terjadi kesalahan pada sistem',400);
        }
    }
}