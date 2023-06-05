<?php

namespace App\Rules;

use App\Models\Like;
use Auth;
use Illuminate\Contracts\Validation\Rule;

class UserHasNotLikedRule implements Rule {
    public function __construct() {
    }

    public function passes($attribute, $value): bool {
        return Like::where("user_id", Auth::id())->where("post_id", $value)->count() === 0;
    }

    public function message(): string {
        return 'You have already liked the post';
    }
}
