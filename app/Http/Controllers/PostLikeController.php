<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostLikeController extends Controller
{
    public function likePost(Request $request)
    {
        DB::beginTransaction();
        try {
            $exists = PostLike::where(['post_id' => $request->post_id, "like_by" => $request->like_by])->first();
            if($exists){
                $exists->delete();
                return response()->json(['success' => false , "status" => "deleted",  "message" => "You unlike this successfully."],200);
            }
            PostLike::create([
                "post_id"=> $request->post_id,
                "like_by"=> $request->like_by,
            ]);
            DB::commit();
            return response()->json(['success' => true ,"status" => "liked", "message"=> "You like this successfully."], 200);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return response()->json(["success" => false , "message" => $th->getMessage()], 500);
        }
    }
}
