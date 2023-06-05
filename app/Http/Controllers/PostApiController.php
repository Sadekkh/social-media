<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;

class PostApiController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): Paginator {
        return Post::latest()->with("original_post")->withCount("allComments", "total_likes", "user_liked")->simplePaginate(12);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): Response {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response {
        //
    }
}