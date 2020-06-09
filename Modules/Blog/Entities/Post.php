<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'blog_posts';

    protected $fillable = [
        'user_id',
        'options'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo("Modules\User\Entities\User");
    }

    public function getOptionsAttribute($value)
    {
        try {
            return json_decode(json_decode($value));
        } catch (\Exception $e) {
            return json_decode($value);
        }
    }


}
