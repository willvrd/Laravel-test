<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements TranslatableContract
{

    use Translatable;

    protected $table = 'blog_posts';

    protected $fillable = [
        'user_id',
        'options'
    ];

    protected $translatedAttributes = [
        'title',
        'slug',
        'description',
        'summary',
        'meta_title',
        'meta_description',
        'meta_keywords'
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
