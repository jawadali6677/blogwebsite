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
    .hide {
        display: none;
    }

    .show {
        display: block;
    }

    .black {
        color: black;
    }

    .facebook_blue {
        color: #316FF6;
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
                @auth
                @php
                    $thumb_color = 'black';
                    if ($comment->like) {
                        $thumb_color = 'facebook_blue';
                    }
                @endphp
                <a class="btn btn-sm btn-default btn-hover-success like" data-user="{{ auth()->user()->id }}"
                    data-id="{{ $comment->id }}" href="javascript:void(0)">
                    <i style="font-size:24px;" class="fa fa-thumbs-up like_icon {{ $thumb_color }}"
                        aria-hidden="true"></i></a>
                @endauth
            </div>
            <a href="javascript:void(0)" data-id="{{ $comment->id }}"
                class="btn btn-sm btn-default btn-hover-primary replay">Replay</a>
            @if ($comment->childern->count() > 0)
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-hover-primary show_replay">View
                    Replays</a>
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

<script>
    $(document).off('click', '.show_replay').on('click', '.show_replay', function() {
        var obj = $(this).closest('.pad-ver').nextAll('div.hide, div.show').first();

        if (obj.hasClass('hide')) {
            $(this).text('Hide')
            obj.removeClass('hide').addClass('show');
        } else {
            $(this).text('View Replays')
            obj.removeClass('show').addClass('hide');
        }
    });

    $(document).off('click', '.like').on('click', '.like', function() {
        const comment_id = $(this).data('id');
        const like_by = $(this).data('user');
        const csrf = $('meta[name="csrf-token"]').attr('content');
        const $icon = $(this).find('i');
        $.ajax({
            url: "{{ route('like_comment') }}",
            method: "POST",
            data: {
                comment_id: comment_id,
                _token: csrf,
                like_by: like_by
            },
            success: function(response) {
                console.log(response);

                if (response.status == "liked") {
                    $icon.removeClass('black').addClass("facebook_blue");
                }
                if (response.status == "deleted") {
                    $icon.removeClass('facebook_blue').addClass("black");
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    })


    $(document).off('click', '.likePost').on('click', '.likePost', function(e) {
        e.preventDefault();
        const post_id = $(this).data('id');
        const like_by = $(this).data('user');
        const csrf = $('meta[name="csrf-token"]').attr('content');
        const $icon = $(this).find('i');
        console.log("clicked");

        $.ajax({
            url: "{{ route('like_post') }}",
            method: "POST",
            data: {
                post_id: post_id,
                _token: csrf,
                like_by: like_by
            },
            success: function(response) {
                console.log(response);

                if (response.status == "liked") {
                    console.log($icon);
                    $icon.removeClass('black').addClass("facebook_blue");
                }
                if (response.status == "deleted") {
                    $icon.removeClass('facebook_blue').addClass("black");
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    })
</script>
