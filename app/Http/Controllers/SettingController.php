<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use View;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->page = 'setting';
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
        $banner = Setting::where('group','site')->get();
        return view('admin.setting.index',compact('subpage','banner'));
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
        $item = Setting::find($id);
        return view('admin.setting.form',compact('subpage','item'));
    }

    public function update($id,Request $request){
        return $this->save($id,$request);
    }

    public function save($id, Request $request){
        if($id != 0){
            $item = Setting::find($id);
        }else{
            $item = new Setting;
        }
        $item->display_name = $request->display_name;
        $item->value = $request->value;
        $item->save();
        return redirect()->route('admin.setting.index');

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
}
