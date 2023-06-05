<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Gate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;

    protected $with = ["post_photos", "owner"];

    protected $appends = ["for_humans", "can"];
    protected $hidden = ["created_at", "updated_at"];

    public function post_photos() {
        return $this->hasMany(PostPhoto::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, "user_id")->select("name", "id", "profile_picture");
    }

    public function total_likes() {
        return $this->hasMany(Like::class, "post_id");
    }
    public function user_liked() {
        return $this->hasMany(Like::class, "post_id")->where("user_id", auth()->id());
    }

    public function original_post() {
        return $this->belongsTo(Post::class, "original_post_id");
    }

    public function comments() {
        return $this->hasMany(Comment::class, "post_id")->whereNull("parent_id")->latest();
    }
    public function allComments() {
        return $this->hasMany(Comment::class, "post_id");
    }

    protected function forHumans(): Attribute {
        return new Attribute(get: fn() => $this->created_at->diffForHumans(["syntax" => CarbonInterface::DIFF_ABSOLUTE]));
    }

    protected function can(): Attribute {
        return new Attribute(get: fn() => ['is_post_owner' => Gate::allows("post_owner", $this)]);
    }
}