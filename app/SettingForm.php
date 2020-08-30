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
}