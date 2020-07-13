<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuEn extends Model
{
	use SoftDeletes;
	protected $table = 'menus';

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'parent_id','nameEn','nicenameEn','banner','icon','status','type'
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
        if($this->parent_id == 0 && ($this->type == 1 || $this->type == 4)){
            $parent_id = $this->status > 10 ? $this->status : $this->id;
            $datamenu = MenuEn::select('nameEn as name','nicenameEn as nicename','comp_name','path')->where('parent_id',$parent_id)->get();
            $submenu = $datamenu;
        }
        return $submenu;
    }

    public function getSubMenuCenterAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && ($this->type == 3 || $this->type == 5)){
            $datamenu = MenuEn::select('nameEn as name','nicenameEn as nicename','comp_name','path')
                ->where('type',0)->where('parent_id',$this->status)->get();
            $submenu = $datamenu;
        }
        return $submenu;
    }

    public function getSubMenuRightAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && ($this->type == 2 || $this->type == 4 || $this->type == 5)){
            $datamenu = MenuId::select('id','nameEn as name','nicenameEn as nicename','status','comp_name','path')->where('parent_id',$this->id)->get();
            if($datamenu){
                foreach($datamenu as $row){
                    if($row->status == 2){
                        $datamenu_child = MenuId::select('nameEn as name','nicenameEn as nicename','comp_name','path')->where('parent_id',$row->id)->get();
                        $row->item = $datamenu_child;
                    }
                }
            }
            $submenu = $datamenu;
        }
        return $submenu;
    }
}
