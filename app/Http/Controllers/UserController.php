<?php

namespace App\Http\Controllers;

use App\Http\Middleware\UserSameAsAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller {
    public function __construct() {
        $this->middleware(UserSameAsAuth::class)->only("edit");
    }
    public function show(User $user) {
        return Inertia::render("User/UserView", [
            "user" => $user,
            "posts" => $user->posts()->latest()->with("original_post")->withCount("allComments", "total_likes", "user_liked")->get()
        ]);
    }
    public function edit(User $user) {
        return Inertia::render("User/UserEdit", [
            "user" => $user->makeVisible("email")
        ]);
    }
    public function update(Request $request, User $user) {
        $hasEmailChanged = $request->email !== $user->email ? "|unique:users" : "";
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "email|required|string|max:255$hasEmailChanged",
            "bio" => "string|nullable"
        ]);
        if ($user->id === auth()->id()) {
            $user->updateOrFail([
                "name" => $request->name,
                "email" => $request->email,
                "bio" => $request->bio
            ]);
            return redirect()->back();
        }
        return abort(403);
    }
    public function updateProfilePicture(Request $request, User $user) {
        $request->validate([
            "profile_picture" => 'required|image',
        ]);
        if ($user->profile_picture != "default.png") {
            Storage::delete("/public/profile/" . $user->profile_picture);
        }

        // Generate a unique new name for the profile_picture
        $newName = uniqid() . "_profile_picture." . $request->file("profile_picture")->getClientOriginalExtension();
        // Save that profile_picture
        Storage::putFileAs($request->file("profile_picture"), "/public/profile/" . $newName);
        // Update the file name in user
        $user->profile_picture = $newName;
        $user->update();

        return redirect()->back();
    }
}