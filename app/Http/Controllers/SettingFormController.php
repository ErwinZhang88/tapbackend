<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingForm;
use View;
use Illuminate\Support\Str;

class SettingFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->page = 'settingform';
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
        $banner = SettingForm::get();
        return view('admin.settingform.index',compact('subpage','banner'));
    }

    public function create()
    {
        $subpage = 'create';
        $item = array();
        return view('admin.settingform.form',compact('subpage','item'));
    }

    public function store(Request $request){
        return $this->save(0,$request);
    }

    public function edit($id){
        $subpage = 'create';
        $item = SettingForm::find($id);
        return view('admin.settingform.form',compact('subpage','item'));
    }

    public function update($id,Request $request){
        return $this->save($id,$request);
    }

    public function save($id, Request $request){
        if($id != 0){
            $item = SettingForm::find($id);
        }else{
            $item = new SettingForm;
        }
        $item->type = $request->type;
        $item->is_required = $request->is_required;
        $item->value = $request->value;
        $item->valueEn = $request->valueEn;
        $item->is_placeholder = $request->is_placeholder;
        if($request->is_placeholder == 1){
            $item->placeholder = $request->placeholder;
            $item->placeholderEn = $request->placeholderEn;
        }
        $item->save();
        return redirect()->route('admin.settingform.index');

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
