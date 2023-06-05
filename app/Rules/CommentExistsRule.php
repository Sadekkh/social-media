<?php

namespace App\Rules;

use App\Models\Comment;
use Illuminate\Contracts\Validation\Rule;

class CommentExistsRule implements Rule {
    public function __construct() {
    }

    public function passes($attribute, $value): bool {
        return (bool)Comment::find($value);
    }

    public function message(): string {
        return 'The comment do not exist.';
    }
}
