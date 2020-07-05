<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Category;
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
        $subpage = 'list';
        $menu = Menu::get();
        return view('admin.content.index',compact('subpage','menu','id'));
    }

    public function create($id)
    {
        $subpage = 'create';
        $menu = Menu::select('id','name')->where('parent_id',0)->get();
        $category = Category::join('menus','menus.id','=','categories.menu_id')
            ->where(function($q) use($id) {
                $q->where('menus.parent_id', $id)
                ->orWhere('menus.id', $id);
            })->select('categories.id','categories.name')->get();
        $item = array();
        return view('admin.content.form',compact('subpage','menu','item','id','category'));
    }

    public function store(Request $request){
        return $this->save(0,$request);
    }

    public function edit($id){
        $subpage = 'create';
        $menu = Menu::select('id','name')->where('parent_id',0)->get();
        $item = Menu::find($id);
        return view('admin.content.form',compact('subpage','menu','item'));
    }

    public function update($id,Request $request){
        return $this->save($id,$request);
    }

    public function save($id, Request $request){
        if($id != 0){
            $item = Menu::find($id);
        }else{
            $item = new Menu;
        }
        $item->parent_id = $request->parent_id;
        $item->name = $request->name;
        $item->nicename =  $this->generateSlug('nicename',$request->name);
        $item->nameEn = $request->nameEn;
        $item->nicenameEn =  $this->generateSlug('nicenameEn',$request->nameEn);
        $item->status = 1;
        if($request->file('banner')){
            $item->banner = time().'.'.$request->banner->extension();
            $request->banner->move(public_path('menu'), $item->banner);
        }
        if($request->file('icon')){
            $item->icon = time().'.'.$request->icon->extension();
            $request->icon->move(public_path('menu'), $item->icon);
        }
        $item->save();
        return redirect()->route('admin.content');

    }

	function generateSlug($type,$name) {
		$index = 0;
		do {
			$current_slug = Str::slug($name) . ($index !== 0 ? "-$index" : '');
			if (Menu::where($type, $current_slug)->first() !== null) {
				$found = true;
				$index++;
			} else {
				$found = false;
			}
		} while ($found);

		return $current_slug;
	}
}
