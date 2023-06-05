<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Gate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    protected $fillable = ["user_id", "post_id", "comment", "parent_id"];
    protected $hidden = ["user_id", "created_at", "updated_at"];
    protected $appends = ["for_humans"];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function replies() {
        return $this->hasMany(Comment::class, "parent_id");
    }

    protected function forHumans(): Attribute {
        return new Attribute(get: fn() => $this->created_at->diffForHumans(["syntax" => CarbonInterface::DIFF_ABSOLUTE]));
    }
}