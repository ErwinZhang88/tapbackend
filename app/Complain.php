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
}
