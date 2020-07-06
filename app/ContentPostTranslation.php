<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentPostTranslation extends Model
{
    protected $fillable = [
        'content_post_id','locale','name','nicename','description'
    ];
}
