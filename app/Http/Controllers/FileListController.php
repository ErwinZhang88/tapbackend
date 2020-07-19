<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileList;
use View;
use Illuminate\Support\Str;

class FileListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->page = 'filelist';
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
        $banner = FileList::get();
        return view('admin.filelist.index',compact('subpage','banner'));
    }

    public function create()
    {
        $subpage = 'create';
        $item = array();
        return view('admin.filelist.form',compact('subpage','item'));
    }

    public function store(Request $request){
        return $this->save(0,$request);
    }

    public function edit($id){
        $subpage = 'create';
        $item = FileList::find($id);
        return view('admin.filelist.form',compact('subpage','item'));
    }

    public function update($id,Request $request){
        return $this->save($id,$request);
    }

    public function save($id, Request $request){
        if($id != 0){
            $item = FileList::find($id);
        }else{
            $item = new FileList;
        }
        $item->name = $request->name;
        $item->save();
        return redirect()->route('admin.filelist.index');
    }

    public function destroy($id){
        FileList::destroy($id);

		$response = [
			'success' => true,
			'data' => array(),
			'message' => 'berhasil',
		];

		return response()->json($response, 200);
    }
}
