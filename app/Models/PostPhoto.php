<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model {
    protected $hidden = ["post_id", "filename", "created_at", "updated_at", "id"];
    protected $appends = ["photo_src"];

    protected function photoSrc(): Attribute {
        return new Attribute(get: fn() => asset("/storage/post/$this->filename"));
    }
}
