<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingForm extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'is_sort','type','is_required','is_placeholder','nicename',
        'valueEn','value','data','dataEn','placeholder','placeholderEn'
    ];

    protected $appends = ['type_name'];

    public function getTypeNameAttribute(){
        $names = '';
        switch ($this->type) {
            case 1:
                $names = 'Number';
                break;
            case 2:
                $names = 'Number';
                break;
            case 3:
                $names = 'TextArea';
                break;
            case 4:
                $names = 'File';
                break;
            case 5:
                $names = 'Radio Button';
                break;
            case 6:
                $names = 'CheckBox';
                break;
            case 7:
                $names = 'Title';
                break;
            case 8:
                $names = 'Button';
                break;
            case 9:
                $names = 'Button File';
                break;
            case 10:
                $names = 'Message Error';
                break;
            case 11:
                $names = 'Email Error';
                break;
            case 12:
                $names = 'Label Table';
                break;
            default:
                $names = 'Text';
                break;
        }
        return $names;
    }
}