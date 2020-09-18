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
        return view('admin.banner.form',compact('subpage','menu','item'));
    }

    public function store(Request $request){
        return $this->save(0,$request);
    }

    public function edit($id){
        $subpage = 'create';
        $menu = Menu::select('id','name','parent_id')->get();
        $item = Banner::find($id);
        return view('admin.banner.form',compact('subpage','menu','item'));
    }

    public function update($id,Request $request){
        return $this->save($id,$request);
    }

    public function save($id, Request $request){
        if($id != 0){
            $item = Banner::find($id);
        }else{
            $item = new Banner;
        }
        $item->name = $request->name;
        $item->nicename =  $this->generateSlug('nicename',$request->name);
        $item->nameEn = $request->nameEn;
        $item->nicenameEn =  $this->generateSlug('nicenameEn',$request->nameEn);
        if($request->banner != ''){
            $item->banner = $request->banner;
        }
        if($request->banner_mobile != ''){
            $item->banner_mobile = $request->banner_mobile;
        }
        $item->type = $request->type;
        $item->link = $request->link;
        $item->order = 1;
        $item->save();
        return redirect()->route('admin.banner.index');

    }

	function generateSlug($type,$name) {
		$index = 0;
		do {
			$current_slug = Str::slug($name) . ($index !== 0 ? "-$index" : '');
			if (Banner::where($type, $current_slug)->withTrashed()->first() !== null) {
				$found = true;
				$index++;
			} else {
				$found = false;
			}
		} while ($found);

		return $current_slug;
	}

    public function destroy($id){
        $menu = Banner::onlyTrashed()->find($id);
        if (!is_null($menu)) {
            $menu->restore();
        }else{
            Banner::destroy($id);
        }
		$response = [
			'success' => true,
			'data' => array(),
			'message' => 'berhasil',
		];

		return response()->json($response, 200);
    }
}
