{{-- <div class="media mt-4"> --}}
{{-- <img src="{{ Storage::url($comment->commentBy->image) }}" class="mr-3 thumb-sm rounded-circle" alt="..."> --}}
{{-- <div class="media-body">
        <h6 class="mt-0">{{ $comment->commentBy->name }}</h6>
        <p>
            @if ($comment->parent)<b class="replay_to">{{@$comment->parent->commentBy->name}}</b>@endif 
            {{ $comment->description }}</p>
        <a href="javascript:void(0)" data-id="{{ $comment->id }}" class="text-dark small font-weight-bold replay">
            <i class="ti-back-right"></i> Reply
        </a>

        <!-- Recursive Rendering of Child Comments -->
        @if ($comment->childern->count() > 0)
            @foreach ($comment->childern as $childComment)
                <div class="media ml-3">
                    @include('partials.comment', ['comment' => $childComment])
                </div>
            @endforeach
        @endif
    </div>
</div> --}}

<style>
.hide{
    display: none;
}
.show{
    display: block;
}
</style>

<!-- Newsfeed Content -->
<!--===================================================-->
<div class="media-block">
    <a class="media-left mr-2" href="#"><img class="img-circle img-sm" alt="Profile Picture"
            src="{{ Storage::url('image/admin.jpeg') ? Storage::url($comment->commentBy->image) : Storage::url('image/admin.jpeg') }}"></a>
    <div class="media-body">
        <div class="mar-btm">
            <a href="#"
                class="btn-link text-semibold media-heading box-inline"><b>{{ $comment->commentBy->name }}</b></a>
            <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i>
                {{ $comment->created_at->format('M d, Y') }}
            </p>
        </div>
        <p>{{ $comment->description }}</p>
        <div class="pad-ver">
            <div class="btn-group">
                <a class="btn btn-sm btn-default btn-hover-success" href="#">
                    <i style="font-size:24px" class="fa">&#xf087;</i></a>
            </div>
            <a href="javascript:void(0)" data-id="{{ $comment->id }}"
                class="btn btn-sm btn-default btn-hover-primary replay">Replay</a>
                @if ($comment->childern->count() > 0)
                <a href="javascript:void(0)"
                    class="btn btn-sm btn-default btn-hover-primary show_replay">View Replays</a>
                @endif
        </div>
        <hr>

        <!-- Comments -->

        @if ($comment->childern->count() > 0)
        
        <div class="hide">
            @foreach ($comment->childern as $child)
                @include('partials.comment', ['comment' => $child])
            @endforeach
        </div>
        @endif
    </div>
</div>
<!--===================================================-->
<!-- End Newsfeed Content -->
