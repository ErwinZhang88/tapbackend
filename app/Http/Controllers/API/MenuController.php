<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuId;
use App\Models\MenuEn;
use DB;
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
        $order = 'asc';
        $content_category = array();
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        if($request->header('order') != ''){
            $order = $request->header('order');
        }
        // echo $nicename;die;
        if($lang == 'en'){
            $menus = MenuEn::select('id','nameEn as name','banner','banner_mobile','type')->where('nicenameEn',$nicename)->first();
        }else{
            $menus = MenuId::select('id','name','banner','banner_mobile','type')->where('nicename',$nicename)->first();
        }
        if($menus){
            if($lang == 'en'){
                $category = Category::select('id','nameEn as name','nicename','type','show_name','pagination','limitpage','is_sort')
                    ->where('menu_id',$menus->id)->get();
            }else{
                $category = Category::select('id','name','nicename','type','show_name','pagination','limitpage','is_sort')
                    ->where('menu_id',$menus->id)->get();
            }
            if($category){
                foreach($category as $row){
                    $row['content'] = array();
                    $order = $row->is_sort == 1 ? 'asc' : 'desc';
                    if($row->is_sort == 3){
                        $menusParent = MenuEn::select('id')->where('parent_menu_id',$menus->id)->where('type',0)->get()->pluck('id');
                        $categoryLatest = Category::whereIn('menu_id',$menusParent)->get()->pluck('id');
                        $content = ContentPost::join('categories','categories.id','=','content_posts.category_id');
                        if($lang == 'en'){
                            $content = $content->select(DB::raw('content_posts.*, max(content_posts.id) as id,categories.name as name'));
                        }else{
                            $content = $content->select(DB::raw('content_posts.*, max(content_posts.id) as id,categories.nameEn as name'));
                        }
                        $content = $content->whereIn('category_id',$categoryLatest)->groupBy('category_id')->OrderBy('id',$order)->get();
                        // dd($content);
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
                                    'image_mobile' => $rowcontent->image_mobile,
                                    'icon' => $rowcontent->icon,
                                    'files' => $rowcontent->files,
                                    'is_download' => $rowcontent->is_download,
                                    'video' => $rowcontent->video,
                                    'created_at' => $createdAt->format('d F Y'),
                                    'createdAt' => $createdAt->format('Y F'),
                                    'title' => $rowcontent ? $rowcontent->name : '',
                                    'nicename' => $contentData ? $contentData->nicename : '',
                                    'desc' => $contentData ? $contentData->description : '',
                                    'short_desc' => $contentData ? $contentData->short_desc : ''
                                );
                            }
                            $row['content'] = $contentrow;
                        }
                    }else{
                        if($row->pagination == 1){
                            $content = ContentPost::where('category_id',$row->id)->OrderBy('id',$order)->paginate($row->limitpage);
                            $row->contentTotal	= $content->count();
                            $row->current_page 	= $content->currentPage();
                            $row->lastPage 	    = $content->lastPage();
                        }else{
                            $content = ContentPost::where('category_id',$row->id)->OrderBy('id',$order)->get();
                            $row->contentTotal = 0;
                            $row->current_page = 0;
                            $row->lastPage = 0;
                        }
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
                                    'image_mobile' => $rowcontent->image_mobile,
                                    'icon' => $rowcontent->icon,
                                    'files' => $rowcontent->files,
                                    'is_download' => $rowcontent->is_download,
                                    'video' => $rowcontent->video,
                                    'created_at' => $createdAt->format('d F Y'),
                                    'createdAt' => $createdAt->format('Y F'),
                                    'title' => $contentData ? $contentData->name : '',
                                    'nicename' => $contentData ? $contentData->nicename : '',
                                    'desc' => $contentData ? $contentData->description : '',
                                    'short_desc' => $contentData ? $contentData->short_desc : ''
                                );
                            }
                            $row['content'] = $contentrow;
                        }
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
            $category = Category::select('id','name','nicename','type','show_name','menu_id')->where('id',$content->category_id)->first();
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
                'is_download' => $content->is_download,
                'video' => $content->video,
                'created_at' => $createdAt->format('d F Y'),
                'createdAt' => $createdAt->format('Y F'),
                'title' => $contentData ? $contentData->name : '',
                'nicename' => $contentData ? $contentData->nicename : '',
                'desc' => $contentData ? $contentData->description : '',
                'short_desc' => $contentData ? $contentData->short_desc : ''
            );
            return $this->sendResponse($data, 'Data successfully.');
        }else{
            return $this->sendError('Data not found.',$content,200);
        }
    }

}