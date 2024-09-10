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
                            <a href="#" class="text-muted">32 Comments</a>
                        </small>
                    </div>
                    <div class="card-body border-top">

                        <div>{!! markdown_to_html($post->content) !!}</div>
                    </div>

                    <div class="card-footer">
                        <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Comments 4</a></h6>
                        <hr>
                        <div class="media">
                            <img src="{{ asset('assets/imgs/avatar-1.jpg')}}" class="mr-3 thumb-sm rounded-circle" alt="...">
                            <div class="media-body">
                                <h6 class="mt-0">Janice Wilder</h6>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin.</p>
                                <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i>
                                    Replay</a>
                                <div class="media mt-5">
                                    <a class="mr-3" href="#">
                                        <img src="{{ asset('assets/imgs/avatar.jpg') }}" class="thumb-sm rounded-circle" alt="...">
                                    </a>
                                    <div class="media-body align-items-center">
                                        <h6 class="mt-0">Joe Mitchell</h6>
                                        <p>Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in
                                            faucibus</p>
                                        <a href="#" class="text-dark small font-weight-bold"><i
                                                class="ti-back-right"></i> Replay</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media mt-5">
                            <img src="{{ asset('assets/imgs/avatar-2.jpg')}}" class="mr-3 thumb-sm rounded-circle" alt="...">
                            <div class="media-body">
                                <h6 class="mt-0">Crosby Meadows</h6>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin.</p>
                                <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i>
                                    Replay</a>
                            </div>
                        </div>
                        <div class="media mt-4">
                            <img src="{{ asset('assets/imgs/avatar-3.jpg')}}" class="mr-3 thumb-sm rounded-circle" alt="...">
                            <div class="media-body">
                                <h6 class="mt-0">Jean Wiley</h6>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin.</p>
                                <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i>
                                    Replay</a>
                            </div>
                        </div>

                        
                        @guest 
                        <div class="mt-4">
                            <a href="{{ route('login') }}" style="color:#22b08f">Login to post comment</a>
                        </div>
                        @endguest

                        @auth
                        <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Write Your Comment</a></h6>
                        <hr>
                        <form action="{{ url('add/comment') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-12 form-group">
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                        placeholder="Enter Your Comment Here"></textarea>
                                </div>
                                {{-- <div class="col-sm-4 form-group">
                                    <input type="text" class="form-control" name="name" value="">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input type="url" class="form-control" name="website" placeholder="Website">
                                </div> --}}
                                <div class="form-group col-12">
                                    <button class="btn btn-primary btn-block btnSubmit">Post Comment</button>
                                </div>
                            </div>
                        </form>
                        @endauth
                    </div>
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
