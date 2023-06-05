<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Rules\CommentExistsRule;
use App\Rules\PostExistsRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller {
    public function store(Request $request) {
        $request->validate([
            "comment" => "string|max:255",
            "post_id" => [new PostExistsRule()],
            "parent_id" => [new CommentExistsRule()]
        ]);
        $comment = new Comment();
        $comment->post_id = $request['post_id'];
        $comment->user_id = Auth::id();
        $comment->comment = $request['comment'];
        if (isset($request->parent_id)) {
            $comment->parent_id = $request["parent_id"];
        }
        $comment->save();
        return redirect()->back();
    }

    public function update(Request $request, Comment $comment) {
        $request->validate([
            "comment" => "string|max:255"
        ]);
        if (Gate::allows("comment_owner", $comment)) {
            $comment->update(["comment" => $request["comment"]]);
        }
    }

    public function destroy(Comment $comment) {
        if (Gate::allows("comment_owner", $comment)) {
            $comment->delete();
            return back()->with("message", "Comment Deleted");
        }
        return back()->with("message", "Cannot delete the message");
    }
}