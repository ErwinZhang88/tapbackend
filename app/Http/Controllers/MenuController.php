<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use View;
use Illuminate\Support\Str;
use Auth;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->page = 'menu';
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
        $menu = Menu::get();
        return view('admin.menu.index',compact('subpage','menu'));
    }

    public function create()
    {
        $subpage = 'create';
        $menu = Menu::select('id','name')->where('parent_id',0)->get();
        $item = array();
        return view('admin.menu.form',compact('subpage','menu','item'));
    }

    public function store(Request $request){
        return $this->save(0,$request);
    }

    public function edit($id){
        $subpage = 'create';
        $menu = Menu::select('id','name')->where('parent_id',0)->get();
        $item = Menu::find($id);
        return view('admin.menu.form',compact('subpage','menu','item'));
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
        // $item->parent_id = $request->parent_id;
        $item->name = $request->name;
        $item->nameEn = $request->nameEn;
        if($id == 0){
            $item->nicename =  $this->generateSlug('nicename',$request->name);
            $item->nicenameEn =  $this->generateSlug('nicenameEn',$request->nameEn);
        }
        if(Auth::user()->id == 1){
            $item->path = $request->path;
            $item->comp_name = $request->comp_name;
        }
        $item->banner = $request->banner;
        $item->icon = $request->icon;
        $item->status = 1;
        $item->save();
        return redirect()->route('admin.menu.index');

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
