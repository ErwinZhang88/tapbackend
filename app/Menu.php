<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'parent_id','name','nameEn','nicename','nicenameEn','banner','icon','status','type','comp_name','path','banner_mobile'
    ];


    protected $appends = ['sub_menu'];

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function getSubMenuAttribute(){
        $submenu = '';
        if($this->parent_id != 0){
            $datamenu = Menu::select('name')->find($this->parent_id);
            if($datamenu){
                $submenu = $datamenu->name;
            }
        }
        return $submenu;
    }
}
