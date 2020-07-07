<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuId extends Model
{
	use SoftDeletes;
	protected $table = 'menus';

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'parent_id','name','nicename','banner','icon','status','type'
    ];

    protected $appends = ['banner_url', 'icon_url','sub_menu_left','sub_menu_center','sub_menu_right'];

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

    public function getSubMenuLeftAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && $this->type == 1){
            $datamenu = MenuId::select('name','nicename')->where('parent_id',$this->id)->get();
            $submenu = $datamenu;
        }
        return $submenu;
    }

    public function getSubMenuCenterAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && $this->type == 3){
            $datamenu = MenuId::select('name','nicename')->where('parent_id',$this->id)->get();
            $submenu = $datamenu;
        }
        return $submenu;
    }

    public function getSubMenuRightAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && $this->type == 2){
            $datamenu = MenuId::select('name','nicename')->where('parent_id',$this->id)->get();
            $submenu = $datamenu;
        }
        return $submenu;
    }
}
