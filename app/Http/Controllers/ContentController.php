<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Category;
use App\SettingHome;
use App\ContentPost;
use App\ContentPostTranslation;
use View;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // View::share('total_credit', $total - $total_class);
        $this->page = 'tentangkami';
        View::share('page', $this->page);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $menu = Menu::select('nicename')->find($id);
        $page = $menu->nicename;
        $subpage = 'list';
        if($id != 1){
            $menu = ContentPost::join('categories','categories.id','=','content_posts.category_id')
                ->join('menus','menus.id','=','categories.menu_id')
                ->leftjoin('content_post_translations','content_post_translations.content_post_id','=','content_posts.id')
                ->where(function($q) use($id) {
                    $q->where('menus.parent_id', $id)
                    ->orWhere('menus.id', $id)->OrWhere('menus.parent_menu_id',$id);
                })->select('content_posts.*','content_post_translations.name','categories.name as category','menus.name as menu_name')->get();
            return view('admin.content.index',compact('subpage','menu','id','page'));
        }else{
            $menu = SettingHome::leftJoin('menus','menus.id','=','setting_homes.menu_id')
                ->select('setting_homes.*','menus.name')->get();
            return view('admin.content.home',compact('subpage','menu','id','page'));
        }
    }

    public function create($id)
    {
        $subpage = 'create';
        $menu = Menu::select('id','name')->where('parent_id',0)->get();
        $category = Category::join('menus','menus.id','=','categories.menu_id')
            ->where(function($q) use($id) {
                $q->where('menus.parent_id', $id)
                ->orWhere('menus.id', $id)->OrWhere('menus.parent_menu_id',$id);
            })->select('categories.id','categories.name')->get();
        // dd($category);
        $item = array();
        return view('admin.content.form',compact('subpage','menu','item','id','category'));
    }

    public function store($eventid,Request $request){
        return $this->save($eventid,0,$request);
    }

    public function edit($eventid,$id){
        $subpage = 'create';
        $menu = Menu::select('id','name')->where('parent_id',0)->get();
        $category = Category::join('menus','menus.id','=','categories.menu_id')
            ->where(function($q) use($eventid) {
                $q->where('menus.parent_id', $eventid)
                ->orWhere('menus.id', $eventid)->OrWhere('menus.parent_menu_id',$eventid);
            })->select('categories.id','categories.name')->get();
        // dd($category);
        $content = ContentPost::find($id);
        $content_translation_en = array();
        $content_translation = array();
        if($content){
            $content_translation_en = ContentPostTranslation::where('content_post_id',$content->id)->where('locale','en')->first();
            $content_translation = ContentPostTranslation::where('content_post_id',$content->id)->where('locale','id')->first();
        }
        $item = array(
            'content' => $content,
            'translations_en' => $content_translation_en,
            'translations' => $content_translation
        );
        $id = $eventid;
        return view('admin.content.form',compact('subpage','menu','item','id','category'));
    }

    public function update($eventid,$id,Request $request){
        return $this->save($eventid,$id,$request);
    }

    public function save($eventid, $id, Request $request){
        if($id != 0){
            $item = ContentPost::find($id);
        }else{
            $item = new ContentPost;
        }
        $item->category_id = $request->category_id;
        $item->type = $request->type;
        $item->format = $request->format;
        $item->bg_color = $request->bg_color;
        $item->button = $request->button;
        $item->show_title = $request->show_title;
        $item->is_download = $request->is_download;
        $item->status = 1;
        if(isset($request->filepath)){
            $item->images = $request->filepath;
        }
        if(isset($request->image_mobile)){
            $item->image_mobile = $request->image_mobile;
        }
        if(isset($request->icon)){
            $item->icon = $request->icon;
        }
        if(isset($request->video)){
            $item->video = $request->video;
        }
        if(isset($request->filedownload)){
            $item->files = $request->filedownload;
        }
        $item->save();
        if(isset($request->titleEn)){
            $item_content_en = ContentPostTranslation::where('content_post_id',$item->id)->where('locale','en')->first();
            if(!$item_content_en){
                $item_content_en = new ContentPostTranslation;
                $item_content_en->locale = 'en';
                $item_content_en->content_post_id = $item->id;
            }
            $item_content_en->name = $request->titleEn;
            $item_content_en->nicename = $this->generateSlug('nicename',$request->titleEn);
            $item_content_en->description = $request->descEn;
            $item_content_en->short_desc = $request->shortdescEn;
            $item_content_en->save();
        }

        if(isset($request->title)){
            $item_content_id = ContentPostTranslation::where('content_post_id',$item->id)->where('locale','id')->first();
            if(!$item_content_id){
                $item_content_id = new ContentPostTranslation;
                $item_content_id->locale = 'id';
                $item_content_id->content_post_id = $item->id;
            }
            $item_content_id->name = $request->title;
            $item_content_id->nicename = $this->generateSlug('nicename',$request->title);
            $item_content_id->description = $request->desc;
            $item_content_id->short_desc = $request->shortdesc;
            $item_content_id->save();
        }
        return redirect()->route('admin.content',['eventid' => $eventid]);

    }

    public function upload(){
        
    }

    public function destroy($id){
        $menu = ContentPost::onlyTrashed()->find($id);
        if (!is_null($menu)) {
            $menu->restore();
        }else{
            ContentPost::destroy($id);
        }
		$response = [
			'success' => true,
			'data' => array(),
			'message' => 'berhasil',
		];

		return response()->json($response, 200);
    }

	function generateSlug($type,$name) {
		$index = 0;
		do {
			$current_slug = Str::slug($name) . ($index !== 0 ? "-$index" : '');
			if (ContentPostTranslation::where($type, $current_slug)->first() !== null) {
				$found = true;
				$index++;
			} else {
				$found = false;
			}
		} while ($found);

		return $current_slug;
    }
    
    public function edithome($id){
        $subpage = 'create';
        $menu = Menu::select('id','name')->get();
        $item = SettingHome::find($id);
        $eventid = 1;
        return view('admin.content.homeedit',compact('subpage','menu','item','id','eventid'));

    }

    public function updatehome($eventid, $id, Request $request){
        if($id != 0){
            $item = SettingHome::find($id);
        }else{
            $item = new SettingHome;
        }
        $item->display_name = $request->display_name;
        if($request->type == 3 || $request->type == 4){
            $item->value = $request->value;
            if(isset($request->image)){
                $item->image = $request->image;
            }
        }
        if($request->type == 2){
            $item->value = $request->display_name;
            if(isset($request->image)){
                $item->image = $request->image;
            }
        }
        if($request->type == 1){
            $item->menu_id = $request->menu_id;
            $item->value = $request->value;
        }
        $item->save();
        $eventid = 1;
        return redirect()->route('admin.content',['eventid' => $eventid]);

    }
}
