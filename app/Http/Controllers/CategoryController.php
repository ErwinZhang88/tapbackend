<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Category;
use View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->page = 'category';
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
        $category = Category::get();
        return view('admin.category.index',compact('subpage','category'));
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
        $item->nameEn = $request->nameEn;
        $item->show_name = $request->show_name;
        $item->pagination = $request->pagination;
        $item->is_sort = $request->is_sort;
        if(isset($request->limitpage)){
            $item->limitpage = $request->limitpage;
        }
        if($id == 0){
            $item->nicename =  $this->generateSlug('nicename',$request->name);
            $item->nicenameEn =  $this->generateSlug('nicenameEn',$request->nameEn);
        }
        $item->status = 1;
        $item->save();
        return redirect()->route('admin.category.index');

    }

    public function destroy($id){
        $menu = Category::onlyTrashed()->find($id);
        if (!is_null($menu)) {
            $menu->restore();
        }else{
            Category::destroy($id);
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
			if (Category::where($type, $current_slug)->withTrashed()->first() !== null) {
				$found = true;
				$index++;
			} else {
				$found = false;
			}
		} while ($found);

		return $current_slug;
	}
}
