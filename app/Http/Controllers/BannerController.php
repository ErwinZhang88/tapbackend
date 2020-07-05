<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Menu;
use View;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->page = 'banner';
        View::share('page', $this->page);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subpage = 'list';
        $banner = Banner::get();
        return view('admin.banner.index',compact('subpage','banner'));
    }

    public function create()
    {
        $subpage = 'create';
        $menu = Menu::select('id','name','parent_id')->get();
        $item = array();
        return view('admin.category.form',compact('subpage','menu','item'));
    }

    public function store(Request $request){
        return $this->save(0,$request);
    }

    public function edit($id){
        $subpage = 'create';
        $menu = Menu::select('id','name','parent_id')->get();
        $item = Category::find($id);
        return view('admin.category.form',compact('subpage','menu','item'));
    }

    public function update($id,Request $request){
        return $this->save($id,$request);
    }

    public function save($id, Request $request){
        if($id != 0){
            $item = Category::find($id);
        }else{
            $item = new Category;
        }
        $item->menu_id = $request->menu_id;
        $item->type = $request->type;
        $item->name = $request->name;
        $item->nicename =  $this->generateSlug('nicename',$request->name);
        $item->nameEn = $request->nameEn;
        $item->nicenameEn =  $this->generateSlug('nicenameEn',$request->nameEn);
        $item->status = 1;
        $item->save();
        return redirect()->route('admin.category.index');

    }

	function generateSlug($type,$name) {
		$index = 0;
		do {
			$current_slug = Str::slug($name) . ($index !== 0 ? "-$index" : '');
			if (Category::where($type, $current_slug)->first() !== null) {
				$found = true;
				$index++;
			} else {
				$found = false;
			}
		} while ($found);

		return $current_slug;
	}
}
