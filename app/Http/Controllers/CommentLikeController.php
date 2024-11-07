<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLike;

class CommentLikeController extends Controller
{
    public function likeComment(Request $request)
    {
        try {
            $exists = CommentLike::where(['comment_id' => $request->comment_id, "like_by" => $request->like_by])->first();
            if($exists){
                $exists->delete();
                return response()->json(['success' => false , "status" => "deleted",  "message" => "You unlike this successfully."],200);
            }
            CommentLike::create([
                "comment_id"=> $request->comment_id,
                "like_by"=> $request->like_by,
            ]);

            return response()->json(['success' => true ,"status" => "liked", "message"=> "You like this successfully."], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["success" => false , "message" => $th->getMessage()], 500);
        }
    }
}
