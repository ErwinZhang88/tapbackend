<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Complain;
use App\SettingForm;
use Illuminate\Support\Str;

class ComplainController extends BaseController
{
    public $successStatus = 200;
    public $Status = true;

    public function index(Request $request){
        $errorMessages = array();
        $error = '';
        // if($request->name == ''){
        //     $error = 'error';
        //     $errorMessages[] = 'nama tidak boleh kosong';
        // }
        // if($request->phone == ''){
        //     $error = 'error';
        //     $errorMessages[] = 'phone tidak boleh kosong';
        // }
        // if($request->email == ''){
        //     $error = 'error';
        //     $errorMessages[] = 'email tidak boleh kosong';
        // }
        // if($request->informasi_keluhan == ''){
        //     $error = 'error';
        //     $errorMessages[] = 'informasi keluhan tidak boleh kosong';
        // }
        // if($request->bukti == ''){
        //     $error = 'error';
        //     $errorMessages[] = 'bukti tidak boleh kosong';
        // }
        if($error != ''){
            return $this->sendError($error, $errorMessages,400);
        }
        try {
            $item = new Complain;
            $item->name = $request->name;
            $item->nicename =  $this->generateSlug('nicename',$request->name);
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
            $item->bukti = $request->bukti;
            $item->tindakan = $request->tindakan == 1 ? true : false;
            $item->langkah_kebijakan = $request->langkah_kebijakan;
            $item->metode_masalah = $request->metode_masalah;
            $item->hasil_keluhan = $request->hasil_keluhan;
            $item->status = 0;
            $item->date_closed = null;
            $item->save();
            return $this->sendResponse($item, 'Data successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('error', 'terjadi kesalahan pada sistem',400);
        }
    }

    public function upload(Request $request){

        if(!$request->hasFile('bukti')) {
            $error = 'error';
            $errorMessages[] = 'bukti tidak boleh kosong';
            return $this->sendError($error, $errorMessages,400);
        }
        $file = $request->file('bukti');
        if(!$file->isValid()) {
            $error = 'error';
            $errorMessages[] = 'invalid_file_upload';
            return $this->sendError($error, $errorMessages,400);
        }
        $path = public_path() . '/bukti/';
        $file->move($path, $file->getClientOriginalName());
        $item = array(
            'path' => 'bukti/'.$file->getClientOriginalName(),
            'link' => url('bukti/'.$file->getClientOriginalName())
        );
        return $this->sendResponse($item, 'Data successfully.');
    }
    
    public function listkeluhan(){
        $item = array();
        $item = Complain::whereIn('status', [1, 2])->get();
        return $this->sendResponse($item, 'Data successfully.');
    }

    public function tabelkeluhan(Request $request){
        $lang = 'id';
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        if($lang == 'id'){
            $data = array(
                'ID','Nama','Tanggal Input','Tanggal Selesai','Status','Detail'
            );
        }else{
            $data = array(
                'ID','Name','Date Filed','Date Closed','Status','Detail'
            );
        }
        return $this->sendResponse($data, 'Data successfully.');
    }
    
    public function formkeluhan(Request $request){
        $lang = 'id';
        if($request->header('lang') != ''){
            $lang = $request->header('lang');
        }
        if($lang == 'id'){
            $title = SettingForm::where('type',7)->select('value as name')->first();
            $button = SettingForm::where('type',8)->select('value as name')->first();
            $body = SettingForm::where('type','<',7)->select('id','value as name','is_sort','type','is_required',
            'is_placeholder', 'data as additional','placeholder')->orderBy('is_sort','asc')->get();
        }else{
            $title = SettingForm::where('type',7)->select('valueEn as name')->first();
            $button = SettingForm::where('type',8)->select('valueEn as name')->first();
            $body = SettingForm::where('type','<',7)->select('id','valueEn as name','is_sort','type','is_required',
            'is_placeholder', 'dataEn as additional','placeholderEn')->orderBy('is_sort','asc')->get();
        }
        $data = array(
            'title' => $title->name,
            'body' => $body,
            'button' => $button->name
        );
        return $this->sendResponse($data, 'Data successfully.');
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