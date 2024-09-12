<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReadComment extends Component
{

    public $postId;
    public $post;
    public $comments;
    public $description;
    public $parent_id;

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function loadComments()
    {
        $this->comments = Comment::where('post_id' , $this->postId)->with(['childern' ,'parent', 'commentBy'])->get();
    }

    public function getPost()
    {
        $this->post = Post::where('id' , $this->postId)->first();
    }
    public function render()
    {
        $this->loadComments();
        $this->getPost();
        return view('livewire.read-comment' , ['comments' => $this->comments , 'post' => $this->post]);
    }

    public function submit()
    {
        $description = $this->description;
        $postId = $this->postId;
        $parent_id = $this->parent_id;

        DB::beginTransaction();
        try {

            Comment::create([
                'description'=> $description,
                'comment_by' => Auth::user()->id,
                'post_id' => $postId,
                'parent_id' => $parent_id,
            ]);

            DB::commit();
            $this->description = " ";
            $this->parent_id = " ";
            $this->dispatch("comment:save" , [
                "message" => "Success",
                "text" => "Comment added successfully.",
                "type" => "success",
            ]);

            $this->render();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            $this->dispatch("comment:save" , [
                "message" => "Error",
                "text" => $th->getMessage(),
                "type" => "error",
            ]);
        }
    }
}
