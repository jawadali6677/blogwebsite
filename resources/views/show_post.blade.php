@extends('layout.app')

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

    .black {
        color: black;
    }

    .facebook_blue {
        color: #316FF6;
    }
</style>
@section('content')
    <section class="container">
        <div class="page-container">
            <div class="page-content">
                <div class="card">
                    <div class="card-header pt-0">
                        <h3 class="card-title mb-4">{{ $post->title }}</h3>
                        <div class="blog-media mb-4">
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="" class="w-100">
                            <a href="#" class="badge badge-primary">#Salupt</a>
                        </div>
                        <small class="small text-muted">
                            @auth
                            @php
                                $like_img = asset('images/like.png');
                                if ($post->like) {
                                $like_img = asset('images/liked.png');
                                }
                            @endphp
                                <img src="{{ $like_img }}" width="30px" data-user="{{auth()->user()->id}}" data-id="{{$post->id}}" class="likePost mr-2" alt="">
                            @endauth
                            <a href="#" class="text-muted">{{ $post->author->name }}</a>
                            <span class="px-2">·</span>
                            <span>{{ $post->created_at->format('M-Y-d') }}</span>
                            <span class="px-2">·</span>
                            <a href="#comments" class="text-muted">{{ $post->comments->count() }} Comments</a>
                        </small>
                    </div>
                    <div class="card-body border-top">

                        <div>{!! markdown_to_html($post->content) !!}</div>
                    </div>
                    <livewire:read-comment :postId="$post->id" />
                </div>

                <h6 class="mt-5 text-center">Related Posts</h6>
                <hr>
                <div class="row">
                    @foreach ($related_posts as $r_post)
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-5">
                                <div class="card-header p-0">
                                    <div class="blog-media">
                                        <img src="{{ Storage::url($r_post->thumbnail) }}" alt="" class="w-100">
                                        <a href="#" class="badge badge-primary">{{ $r_post->category->name }}</a>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <h6 class="card-title mb-2"><a href="#" class="text-dark">{{ $r_post->name }}</a>
                                    </h6>
                                    <small class="small text-muted">{{ $r_post->created_at->format('M-Y-d') }}
                                        <span class="px-2">-</span>
                                        <a href="#" class="text-muted">{{ $r_post->comments->count() }} Comments</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="col-md-6 col-lg-4">
                        <div class="card mb-5">
                            <div class="card-header p-0">
                                <div class="blog-media">
                                    <img src="assets/imgs/blog-3.jpg" alt="" class="w-100">
                                    <a href="#" class="badge badge-primary">#dolores</a>
                                </div>
                            </div>
                            <div class="card-body px-0">
                                <h6 class="card-title mb-2"><a herf="#" class="text-dark">Dolorum Dolores
                                        Itaque</a></h6>
                                <small class="small text-muted">January 19 2019
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-muted">64 Comments</a>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 d-none d-lg-block">
                        <div class="card mb-5">
                            <div class="card-header p-0">
                                <div class="blog-media">
                                    <img src="assets/imgs/blog-4.jpg" alt="" class="w-100">
                                    <a href="#" class="badge badge-primary">#amet</a>
                                </div>
                            </div>
                            <div class="card-body px-0">
                                <h6 class="card-title mb-2">Quisquam Dignissimos</h6>
                                <small class="small text-muted">January 17 2019
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-muted">93 Comments</a>
                                </small>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- Sidebar -->
            <div class="page-sidebar">
                <h6 class=" ">tags</h6>
                @foreach ($post->tags as $tag)
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#{{ $tag }}</a>
                @endforeach

                <div class="ad-card d-flex text-center align-items-center justify-content-center mt-4">
                    <span href="#" class="font-weight-bold">ADS</span>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(".btnSubmit").click(function(e) {
            e.preventDefault();

            var form = $(this).closest('form');
            var formData = form.serialize();
            var url = form.attr('action');

            console.log('form', form);
            console.log('url', url);

            $.ajax({
                url: '{{ url('add/comment/') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })

    </script>
@endsection
