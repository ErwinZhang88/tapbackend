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

    protected $appends = ['sub_menu_left','sub_menu_center','sub_menu_right'];

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function getSubMenuLeftAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && $this->left == 1){
            $parent_id = $this->status > 10 ? $this->status : $this->id;
            $datamenu = MenuId::select('id','name','nicename','status','comp_name','path')->where('parent_id',$parent_id)
                ->where('left',1)->get();
            if(!$datamenu){
                foreach($datamenu as $row){
                    if($row->status == 2){
                        $datamenu_child = MenuId::select('name','nicename','comp_name','path')->where('parent_id',$row->id)
                            ->where('left',1)->get();
                        $row->item = $datamenu_child;
                    }
                }
            }else{
                $datamenu = MenuId::select('id','name','nicename','status','comp_name','path')->where('parent_menu_id',$parent_id)
                    ->where('left',1)->get();
            }
            $submenu = $datamenu;
        }
        return $submenu;
    }

    public function getSubMenuCenterAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && $this->center == 1){
            $datamenu = MenuId::select('name','nicename','comp_name','path')->where('type',0)
                ->where('center',1)->where('parent_menu_id',$this->id)->get();
            $submenu = $datamenu;
        }
        return $submenu;
    }

    public function getSubMenuRightAttribute(){
        $submenu = array();
        if($this->parent_id == 0 && $this->right == 1){
            $datamenu = MenuId::select('id','name','nicename','status','comp_name','path')
                ->where('right',1)->where('parent_id',$this->id)->OrderBy('is_order','asc')->get();
            if($datamenu){
                foreach($datamenu as $row){
                    if($row->status == 2){
                        $datamenu_child = MenuId::select('name','nicename','comp_name','path')
                            ->where('right',1)->where('parent_id',$row->id)->OrderBy('is_order','asc')->get();
                        $row->item = $datamenu_child;
                    }
                }
            }
            $submenu = $datamenu;
        }
        return $submenu;
    }
}
