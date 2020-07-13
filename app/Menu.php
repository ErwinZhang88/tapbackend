<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'parent_id','name','nameEn','nicename','nicenameEn','banner','icon','status','type','comp_name','path'
    ];

    protected $appends = ['banner_url', 'icon_url'];

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function getBannerUrlAttribute(){
      return url('menu/'.$this->banner);
    }

    public function getIconUrlAttribute(){
      return url('menu/'.$this->icon);
    }
}
