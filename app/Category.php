<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'menu_id','name','nameEn','nicename','status','type','show_name','pagination','limitpage'
    ];

    protected $appends = ['menus','types'];

    public function menu(){
		return $this->belongsTo('App\Menu');
    }

    public function getMenusAttribute(){
        $menu = $this->menu_id;
        return $menu;
    }

    public function getTypesAttribute(){
        $type = '';
        switch ($this->type) {
            case 1:
                $type = 'Article';
                break;
            case 2:
                $type = 'Images';
                break;
            case 3:
                $type = 'List';
                break;
            default:
                $type = '';
                break;
        }
        return $type;
    }
}
