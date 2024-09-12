<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        DB::beginTransaction();
        try {

            Comment::create([
                'description'=> $request->description,
                'comment_by' => Auth::user()->id,
                'post_id' => $request->post_id,
            ]);

            DB::commit();
            return response()->json(['success' => true , 'message' => "Comment added successfully."]);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['success' => false , 'message' => $th->getMessage()] , 500);
        }
    }
}
