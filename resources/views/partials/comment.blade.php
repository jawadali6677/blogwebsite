<div class="media mt-4">
    {{-- <img src="{{ Storage::url($comment->commentBy->image) }}" class="mr-3 thumb-sm rounded-circle" alt="..."> --}}
    <div class="media-body">
        <h6 class="mt-0">{{ $comment->commentBy->name }}</h6>
        <p>
            @if($comment->parent)<b class="replay_to">{{@$comment->parent->commentBy->name}}</b>@endif 
            {{ $comment->description }}</p>
        <a href="javascript:void(0)" data-id="{{ $comment->id }}" class="text-dark small font-weight-bold replay">
            <i class="ti-back-right"></i> Reply
        </a>

        <!-- Recursive Rendering of Child Comments -->
        @if($comment->childern->count() > 0)
            @foreach($comment->childern as $childComment)
                <div class="media ml-3">
                    @include('partials.comment', ['comment' => $childComment])
                </div>
            @endforeach
        @endif
    </div>
</div>
