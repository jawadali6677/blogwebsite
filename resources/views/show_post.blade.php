@extends('layout.app')
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
                    @foreach($related_posts as $r_post)
                    <div class="col-md-6 col-lg-4">
                        <div class="card mb-5">
                            <div class="card-header p-0">
                                <div class="blog-media">
                                    <img src="{{ Storage::url($r_post->thumbnail) }}" alt="" class="w-100">
                                    <a href="#" class="badge badge-primary">{{ $r_post->category->name }}</a>
                                </div>
                            </div>
                            <div class="card-body px-0">
                                <h6 class="card-title mb-2"><a href="#" class="text-dark">{{ $r_post->name }}</a></h6>
                                <small class="small text-muted">{{ $r_post->created_at->format('M-Y-d') }}
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-muted">34 Comments</a>
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
                @foreach($post->tags as $tag)
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
    $(".btnSubmit").click(function(e){
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
