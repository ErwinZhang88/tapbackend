<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ContentPost extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'category_id','type','images','image_mobile','status','video','format',
        'icon','bg_color','button','show_title','files','is_download'
    ];

    protected $appends = ['createdAt'];


    public function getCreatedAtAttribute(){
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $createdAt = $createdAt->format('d F Y');
        return $createdAt;
    }

}
