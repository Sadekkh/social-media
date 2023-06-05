<?php

namespace App\Rules;

use App\Models\Like;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserHasLikedRule implements Rule {
    public function __construct() {
    }

    public function passes($attribute, $value): bool {
        return Like::where("user_id", Auth::id())->where("post_id", $value)->count() === 1;
    }

    public function message(): string {
        return 'You haven\'t liked the post';
    }
}
