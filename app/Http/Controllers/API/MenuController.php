<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuId;
use App\Models\MenuEn;
use App\Category;
use App\ContentPost;
use App\ContentPostTranslation;
use View;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MenuController extends BaseController
{
    public $successStatus = 200;
    public $Status = true;

    public function index(Request $request){
        $lang = 'id';
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        if($lang == 'en'){
            $menus = MenuEn::where('parent_id',0)->select('id','nameEn as name','nicenameEn as nicename','banner','banner_mobile',
                'icon','parent_id','type','status','comp_name','path','left','right','center')->get();
        }else{
            $menus = MenuId::where('parent_id',0)->select('id','name','nicename','banner','icon','banner_mobile',
                'parent_id','type','status','comp_name','path','left','right','center')->get();
        }
        return $this->sendResponse($menus, 'Data successfully.');
    }

    public function content(Request $request){
        $nicename = $request->input('nicename');
        $lang = 'id';
        $content_category = array();
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        // echo $nicename;die;
        if($lang == 'en'){
            $menus = MenuEn::select('id','name','banner','banner_mobile')->where('nicenameEn',$nicename)->first();
        }else{
            $menus = MenuId::select('id','name','banner','banner_mobile')->where('nicename',$nicename)->first();
        }
        if($menus){
            $category = Category::select('id','name','nicename','type','show_name')->where('menu_id',$menus->id)->get();
            if($category){
                foreach($category as $row){
                    $row['content'] = array();
                    $content = ContentPost::where('category_id',$row->id)->get();
                    if($content){
                        $contentrow = array();
                        foreach($content as $rowcontent){
                            $contentData = ContentPostTranslation::where('locale',$lang)->where('content_post_id',$rowcontent->id)->first();
                            // dd($contentData);
                            $createdAt = Carbon::parse($rowcontent->created_at);
                            $contentrow[] = array(
                                'id' => $rowcontent->id,
                                'type' => $rowcontent->type,
                                'format' => $rowcontent->format,
                                'bg_color' => $rowcontent->bg_color,
                                'button' => $rowcontent->button,
                                'title' => $rowcontent->name,
                                'show_title' => $rowcontent->show_title,
                                'image' => $rowcontent->images,
                                'icon' => $rowcontent->icon,
                                'files' => $rowcontent->files,
                                'video' => $rowcontent->video,
                                'created_at' => $createdAt->format('d F Y'),
                                'createdAt' => $createdAt->format('Y F'),
                                'title' => $contentData ? $contentData->name : '',
                                'nicename' => $contentData ? $contentData->nicename : '',
                                'desc' => $contentData ? $contentData->description : ''
                            );
                        }
                        $row['content'] = $contentrow;
                    }
                    $content_category[] = $row;
                }
            
                $data = array(
                     'banner' => $menus->banner,
                     'banner_mobile' => $menus->banner_mobile,
                     'title' => $menus->name,
                     'category' => $content_category,   
                );
                
                return $this->sendResponse($data, 'Data successfully.');
            }else{
                return $this->sendError('Data not found.',$content_category,200);
            }
        }else{
            return $this->sendError('Data not found.',$content_category,200);
        }
    }

    public function detail(Request $request){
        $content = ContentPost::where('id',$request->id)->first();
        $lang = 'id';
        // echo $lang;die;
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        if($content){
            $category = Category::select('id','name','nicename','type','show_name','menu_id')->where('id',$content->id)->first();
            if($lang == 'en'){
                $menus = MenuEn::select('id','name','banner','banner_mobile')->where('id',$category->menu_id)->first();
            }else{
                $menus = MenuId::select('id','name','banner','banner_mobile')->where('id',$category->menu_id)->first();
            }

            $createdAt = Carbon::parse($content->created_at);
            $contentData = ContentPostTranslation::where('locale',$lang)->where('content_post_id',$content->id)->first();
            $data = array(
                'category' => $category,
                'menu' => $menus,
                'id' => $content->id,
                'type' => $content->type,
                'format' => $content->format,
                'bg_color' => $content->bg_color,
                'button' => $content->button,
                'title' => $content->name,
                'show_title' => $content->show_title,
                'image' => $content->images,
                'icon' => $content->icon,
                'files' => $content->files,
                'video' => $content->video,
                'created_at' => $createdAt->format('d F Y'),
                'createdAt' => $createdAt->format('Y F'),
                'title' => $contentData ? $contentData->name : '',
                'nicename' => $contentData ? $contentData->nicename : '',
                'desc' => $contentData ? $contentData->description : '',
                'short_desc' => $contentData ? $contentData->description : ''
            );
            return $this->sendResponse($data, 'Data successfully.');
        }else{
            return $this->sendError('Data not found.',$content,200);
        }
    }

}