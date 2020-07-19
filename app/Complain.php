<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complain extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name','nicename','group','country','address','phone','email','fax',
        'keluhan_kepada','nama_responden','lokasi_keluhan','informasi_keluhan',
        'hal_kebijakan','bukti','tindakan','langkah_kebijakan','metode_masalah',
        'hasil_keluhan','status'
    ];

    protected $appends = ['status_complain'];

    public function getStatusComplainAttribute(){
        $submenu = '';
        switch ($this->status) {
            case 1:
                $submenu = 'Diterima';
                break;
            case 2:
                $submenu = 'Proses';
                break;
            case 3:
                $submenu = 'Selesai';
                break;
            case 4:
                $submenu = 'Ditolak';
                break;
            default:
                $submenu = 'Keluhan Baru';
                break;
        }
        return $submenu;
    }
}
