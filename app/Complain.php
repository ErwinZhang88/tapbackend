<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Complain extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name','nicename','group','country','address','phone','email','fax',
        'keluhan_kepada','nama_responden','lokasi_keluhan','informasi_keluhan',
        'hal_kebijakan','bukti','tindakan','langkah_kebijakan','metode_masalah',
        'hasil_keluhan','status','date_closed','file_download','is_download'
    ];

    protected $appends = ['status_complain','date_filed','url_file','date_closed'];

    public function getDateFiledAttribute(){
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $createdAt = $createdAt->format('d F Y');
        return $createdAt;
    }

    public function getDateClosedAttribute(){
        $createdAt = Carbon::parse($this->attributes['date_closed']);
        $createdAt = $createdAt->format('d F Y');
        return $createdAt;
    }

    public function getUrlFileAttribute(){
        return $this->attributes['file_download'];
    }

    public function getStatusComplainAttribute(){
        $submenu = '';
        switch ($this->status) {
            case 1:
                $submenu = 'Diproses';
                break;
            case 2:
                $submenu = 'Selesai';
                break;
            case 3:
                $submenu = 'Ditolak';
                break;
            default:
                $submenu = 'Keluhan Baru';
                break;
        }
        return $submenu;
    }
}
