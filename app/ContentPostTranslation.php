<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContentPostTranslation extends Model
{
    protected $fillable = [
        'content_post_id','locale','name','nicename','description','short_desc'
    ];

    protected $appends = ['createdAt'];

    public function getCreatedAtAttribute(){
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $createdAt = $createdAt->format('d F Y');
        return $createdAt;
    }
}
