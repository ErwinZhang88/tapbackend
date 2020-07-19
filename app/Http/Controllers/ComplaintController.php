<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complain;
use View;
use Illuminate\Support\Str;
use Auth;

class ComplaintController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->page = 'complaint';
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
        $menu = Complain::get();
        return view('admin.complain.index',compact('subpage','menu'));
    }

    public function create()
    {
        $subpage = 'create';
        $item = array();
        return view('admin.complain.form',compact('subpage','item'));
    }

    public function store(Request $request){
        return $this->save(0,$request);
    }

    public function edit($id){
        $subpage = 'create';
        $item = Complain::find($id);
        return view('admin.complain.form',compact('subpage','menu','item'));
    }

    public function update($id,Request $request){
        return $this->save($id,$request);
    }

    public function save($id, Request $request){
        if($id != 0){
            $item = Complain::find($id);
        }else{
            $item = new Complain;
        }
        // $item->parent_id = $request->parent_id;
        $item->name = $request->name;
        if($id == 0){
            $item->nicename =  $this->generateSlug('nicename',$request->name);
        }
        if(Auth::user()->id == 1){
            $item->path = $request->path;
            $item->comp_name = $request->comp_name;
        }
        $item->group = $request->group;
        $item->country = $request->country;
        $item->address = $request->address;
        $item->phone = $request->phone;
        $item->email = $request->email;
        $item->fax = $request->fax;
        $item->keluhan_kepada = $request->keluhan_kepada;
        $item->nama_responden = $request->nama_responden;
        $item->lokasi_keluhan = $request->lokasi_keluhan;
        $item->informasi_keluhan = $request->informasi_keluhan;
        $item->hal_kebijakan = $request->hal_kebijakan;
        if($request->bukti != ''){
            $item->bukti = $request->bukti;
        }
        $item->tindakan = $request->tindakan == 1 ? true : false;
        $item->langkah_kebijakan = $request->langkah_kebijakan;
        $item->metode_masalah = $request->metode_masalah;
        $item->hasil_keluhan = $request->hasil_keluhan;
        $item->status = $request->status;
        $item->save();
        return redirect()->route('admin.complaint.index');

    }

    public function destroy($id){
        $menu = Complain::onlyTrashed()->find($id);
        if (!is_null($menu)) {
            $menu->restore();
        }else{
            Complain::destroy($id);
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
			if (Complain::where($type, $current_slug)->first() !== null) {
				$found = true;
				$index++;
			} else {
				$found = false;
			}
		} while ($found);

		return $current_slug;
	}
}
