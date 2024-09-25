<style>
    .img-sm {
        width: 46px;
        height: 46px;
    }

    .panel {
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.075);
        border-radius: 0;
        border: 0;
        margin-bottom: 15px;
    }

    .panel .panel-footer,
    .panel>:last-child {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .panel .panel-heading,
    .panel>:first-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .panel-body {
        padding: 25px 0px;
    }

    .comments-panel {
        height: 400px;
        overflow: auto;
    }

    .media-block .media-left {
        display: block;
        float: left
    }

    .media-block .media-right {
        float: right
    }

    .media-block .media-body {
        display: block;
        overflow: hidden;
        width: auto
    }

    .middle .media-left,
    .middle .media-right,
    .middle .media-body {
        vertical-align: middle
    }

    .thumbnail {
        border-radius: 0;
        border-color: #e9e9e9
    }

    .tag.tag-sm,
    .btn-group-sm>.tag {
        padding: 5px 10px;
    }

    .tag:not(.label) {
        background-color: #fff;
        padding: 6px 12px;
        border-radius: 2px;
        border: 1px solid #cdd6e1;
        font-size: 12px;
        line-height: 1.42857;
        vertical-align: middle;
        -webkit-transition: all .15s;
        transition: all .15s;
    }

    .text-muted,
    a.text-muted:hover,
    a.text-muted:focus {
        color: #acacac;
    }

    .text-sm {
        font-size: 0.9em;
    }

    .text-5x,
    .text-4x,
    .text-5x,
    .text-2x,
    .text-lg,
    .text-sm,
    .text-xs {
        line-height: 1.25;
    }

    .btn-trans {
        background-color: transparent;
        border-color: transparent;
        color: #929292;
    }

    .btn-icon {
        padding-left: 9px;
        padding-right: 9px;
    }

    .btn-sm,
    .btn-group-sm>.btn,
    .btn-icon.btn-sm {
        padding: 5px 10px !important;
    }

    .mar-top {
        margin-top: 15px;
    }

    .comments-panel::-webkit-scrollbar {
        width: 12px;
        /* width of the entire scrollbar */
    }

    .comments-panel::-webkit-scrollbar-track {
        background: rgb(253, 253, 253);
        /* color of the tracking area */
    }

    .comments-panel::-webkit-scrollbar-thumb {
        background-color: #c2f6ea;
        /* color of the scroll thumb */
        border-radius: 20px;
        /* roundness of the scroll thumb */
        border: 3px solid rgb(255, 255, 255);
        /* creates padding around scroll thumb */
    }
</style>

<div class="card-footer" id="comments">
    <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Comments {{ $comments->count() }}</a></h6>
    <hr>
    <div class="main">
        <div class="container bootdey">
            <div class="col-md-12 bootstrap snippets">
                <div class="panel">
                    @guest
                        <div class="mt-4">
                            <a href="{{ route('login') }}" style="color:#22b08f">Login to post comment</a>
                        </div>
                    @endguest
                    @auth
                        <form wire:submit.prevent="submit">
                            <div class="panel-body">
                                @csrf <!-- Optional, as Livewire handles CSRF automatically -->
                                <textarea wire:model="description" class="form-control" placeholder="What are you thinking?"></textarea>

                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <input type="hidden" wire:model="post_id" value="{{ $post->id }}">
                                <input type="hidden" wire:model="parent_id" value="">

                                <div class="mar-top clearfix">
                                    <button type="submit"
                                        class="btn btn-sm btn-primary pull-right btnSubmit">Submit</button>
                                </div>
                            </div>
                        </form>
                    @endauth
                </div>

                <div class="panel">
                    <div class="panel-body comments-panel">
                        @foreach ($comments as $comment)
                            @if (!$comment->parent)
                                <!-- Top-level comment -->

                                @include('partials.comment', ['comment' => $comment])
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- @foreach ($comments as $comment)
            @if (!$comment->parent)
                <!-- Top-level comment -->
                
                    @include('partials.comment', ['comment' => $comment])
                
            @endif
        @endforeach --}}
    </div>

    {{-- @guest
        <div class="mt-4">
            <a href="{{ route('login') }}" style="color:#22b08f">Login to post comment</a>
        </div>
    @endguest

    @auth
        <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Write Your Comment</a></h6>
        <hr>
        <form wire:submit.prevent="submit">
            @csrf
            <div class="form-row">
                <div class="col-12 form-group">
                    <textarea wire:model="description" id="commentbox" cols="30" rows="10" class="form-control"
                        placeholder="Enter Your Comment Here"></textarea>
                    @error('description')
                        <font color="red">{{ $message }}</font>
                    @enderror
                </div>
                <div class="col-sm-4 form-group">
                    <input type="text" class="form-control" id="post_id" hidden wire:model="post_id"
                        value="{{ $post->id }}">
                    <input type="text" class="form-control" id="parent_id" hidden wire:model="parent_id" value="">
                </div>
                <div class="form-group col-12">
                    <button class="btn btn-primary btn-block btnSubmit">Post Comment</button>
                </div>
            </div>
        </form>
    @endauth --}}
</div>

@section('script')
    <script>
        window.addEventListener('comment:save', event => {
            var msg = event.detail[0].message
            var text = event.detail[0].text
            var type = event.detail[0].type

            Swal.fire(msg, text, type, 'top-end');
        });

        $(document).on('click', '.replay', function(e) {
            e.preventDefault();
            var parent_id = $(this).data('id');
            console.log('parent_id', parent_id);
            @this.set('parent_id', parent_id); // Make sure Livewire JS is properly included
            $("#commentbox").focus();
        });

        $("#commentbox").focus(function() {

        })

        $(document).on('click', '.show_replay', function(e) {
            e.preventDefault();
            $(this).parent().closest('div').next('div').removeClass('hide').addClass('show');
        });
    </script>
@endsection
