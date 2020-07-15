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
            $menus = MenuEn::where('parent_id',0)->select('id','nameEn as name','nicenameEn as nicename','banner','icon','parent_id','type','status','comp_name','path')->get();
        }else{
            $menus = MenuId::where('parent_id',0)->select('id','name','nicename','banner','icon','parent_id','type','status','comp_name','path')->get();
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
            $menus = MenuEn::select('id','name','banner')->where('nicenameEn',$nicename)->first();
        }else{
            $menus = MenuId::select('id','name','banner')->where('nicename',$nicename)->first();
        }
        if($menus){
            $category = Category::select('id','name','nicename','type')->where('menu_id',$menus->id)->get();
            if($category){
                foreach($category as $row){
                    $row['content'] = array();
                    $content = ContentPost::select('id')->where('category_id',$row->id)->first();
                    if($content){
                        $contentData = ContentPostTranslation::where('locale',$lang)->where('content_post_id',$content->id)->first();
                        // dd($contentData);
                        $row['content'] = array(
                            'id' => $content->id,
                            'type' => $content->type,
                            'title' => $content->name,
                            'image' => $content->images,
                            'title' => $contentData ? $contentData->name : '',
                            'nicename' => $contentData ? $contentData->nicename : '',
                            'desc' => $contentData ? $contentData->description : ''
                        );
                    }
                    $content_category[] = $row;
                }
            
                $data = array(
                     'banner' => $menus->banner,
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


}