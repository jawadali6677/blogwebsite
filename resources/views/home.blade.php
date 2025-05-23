@extends('layout.app')
@section('content')
    <div class="container">
        <section>
            <div class="feature-posts">
                <a href="{{ route('featured_posts') }}" class="feature-post-item">
                    <span>Featured Posts</span>
                </a>
                @foreach ($featured_posts as $post)
                    <a href="{{ route('show_post', ['id' => $post->id]) }}" class="feature-post-item">
                        <img src="{{ Storage::url($post->thumbnail) }}" class="w-100 h-100" alt="">
                        <div class="feature-post-caption">{{ $post->title }}</div>
                    </a>
                @endforeach
                {{-- <a href="single-post.html" class="feature-post-item">
                <img src="assets/imgs/img-2.jpg" class="w-100" alt="">
                <div class="feature-post-caption">Culpa Ducimus</div>
            </a>
            <a href="single-post.html" class="feature-post-item">
                <img src="assets/imgs/img-3.jpg" class="w-100" alt="">
                <div class="feature-post-caption">Temporibus Simile</div>
            </a>
            <a href="single-post.html" class="feature-post-item">
                <img src="assets/imgs/img-4.jpg" class="w-100" alt="">
                <div class="feature-post-caption">Adipisicing</div>
            </a> --}}
            </div>
        </section>
        <hr>
        <div class="page-container">
            <div class="page-content">
                @if(isset($latest_posts[0]))
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title">{{ isset($latest_posts[0])?$latest_posts[0]->title : ''; }}</h5>
                        <small class="small text-muted">{{ isset($latest_posts[0])?$latest_posts[0]->created_at->format('d M,Y'): '' }}
                            <span class="px-2">-</span>
                            <a href="#" class="text-muted">{{ isset($latest_posts[0])?$latest_posts[0]->comments->count(): 0 }} comments</a>
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="blog-media">
                            <img src="{{ Storage::url(isset($latest_posts[0])?$latest_posts[0]->thumbnail:'') }}" alt="" class="w-100">
                            <a href="#" class="badge badge-primary">#Salupt</a>
                        </div>
                        @php
                            $words = explode(' ', isset($latest_posts[0])?$latest_posts[0]->content:'');
                            $limited_content = implode(' ', array_slice($words, 0, 30));
                        @endphp
                        <p class="my-3">{{ $limited_content }}...</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center flex-basis-0">
                        <button class="btn btn-primary circle-35 mr-4"><i class="ti-back-right"></i></button>
                        <a href="{{ route('show_post', ['id' => isset($latest_posts[0])?$latest_posts[0]->id:0]) }}" class="btn btn-outline-dark btn-sm">READ MORE</a>
                        <a href="#" class="text-dark small text-muted">By : {{ isset($latest_posts[0])?$latest_posts[0]->author->name:''; }}</a>
                    </div>
                </div>
                @endif
                <hr>
                <div class="row">
                    @foreach($latest_posts as $post)
                    @if($loop->iteration == 1)
                    @php continue; @endphp
                    @endif
                        <div class="col-lg-6">
                            <div class="card text-center mb-5">
                                <div class="card-header p-0">
                                    <div class="blog-media">
                                        <img src="{{ Storage::url( $post->thumbnail) }}" alt="" class="w-100">
                                        <a href="#" class="badge badge-primary">#Placeat</a>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title mb-2">{{ $post->title }}</h5>
                                    <small class="small text-muted">{{ $post->created_at->format('d M,Y') }}
                                        <span class="px-2">-</span>
                                        <a href="#" class="text-muted">{{ $post->comments->count() }} comments</a>
                                    </small>
                                    @php
                                    $words = explode(' ', $post->content);
                                    $limited_content = implode(' ', array_slice($words, 0, 30));
                                    @endphp
                                    <p class="my-2">{{ $limited_content }}...</p>
                                </div>

                                <div class="card-footer p-0 text-center">
                                    <a href="{{ route('show_post', ['id' => $post->id]) }}" class="btn btn-outline-dark btn-sm">READ MORE</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <button class="btn btn-primary btn-block my-4">Load More Posts</button> --}}
            </div>

            <!-- Sidebar -->
            <div class="page-sidebar text-center">
                <h6 class="sidebar-title section-title mb-4 mt-3">About</h6>
                <img src="{{ auth()->user()?Storage::url( auth()->user()->image ):Storage::url('image/admin.jpeg') }}" alt="Profile" class="circle-100 mb-3">
                <div class="socials mb-3 mt-2">
                    <a href="javascript:void(0)"><i class="ti-facebook"></i></a>
                    <a href="javascript:void(0)"><i class="ti-twitter"></i></a>
                    <a href="javascript:void(0)"><i class="ti-pinterest-alt"></i></a>
                    <a href="javascript:void(0)"><i class="ti-instagram"></i></a>
                    <a href="javascript:void(0)"><i class="ti-youtube"></i></a>
                </div>
                <p>Consectetur adipisicing elit Possimus tempore facilis dolorum veniam impedit nobis. Quia, soluta incidunt
                    nesciunt dolorem reiciendis iusto.</p>


                <h6 class="sidebar-title mt-5 mb-4">Newsletter</h6>
                <form action="">
                    <div class="subscribe-wrapper">
                        <input type="email" class="form-control" placeholder="Email Address">
                        <button type="submit" class="btn btn-primary"><i class="ti-location-arrow"></i></button>
                    </div>
                </form>

                <h6 class="sidebar-title mt-5 mb-4">Tags</h6>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#iusto</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#quibusdam</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#officia</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#animi</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#mollitia</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#quod</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#ipsa at</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#dolor</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#incidunt</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#possimus</a>

                <!-- <h6 class="sidebar-title mt-5 mb-4">Instagram</h6>
                <div class="row px-3">
                    <div class="col-4 p-1 figure">
                        <a href="#" class="figure-img">
                            <img src="assets/imgs/insta-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="col-4 p-1 figure">
                        <a href="#" class="figure-img">
                            <img src="assets/imgs/insta-2.jpg" alt="" class="w-100 m-0">
                        </a>
                    </div>
                    <div class="col-4 p-1 figure">
                        <a href="#" class="figure-img">
                            <img src="assets/imgs/insta-3.jpg" alt="" class="w-100">
                        </a>
                    </div>
                    <div class="col-4 p-1 figure">
                        <a href="#" class="figure-img">
                            <img src="assets/imgs/insta-4.jpg" alt="" class="w-100 m-0">
                        </a>
                    </div>
                    <div class="col-4 p-1 figure">
                        <a href="#" class="figure-img">
                            <img src="assets/imgs/insta-5.jpg" alt="" class="w-100">
                        </a>
                    </div>
                    <div class="col-4 p-1 figure">
                        <a href="#" class="figure-img">
                            <img src="assets/imgs/insta-6.jpg" alt="" class="w-100 m-0">
                        </a>
                    </div>
                </div>

                <figure class="figure mt-5">
                    <a href="single-post.html" class="figure-img">
                        <img src="assets/imgs/img-4.jpg" alt="" class="w-100">
                        <figcaption class="figcaption">Laboriosam</figcaption>
                    </a>
                </figure>

                <h6 class="sidebar-title mt-5 mb-4">Popular Posts</h6>
                <div class="card mb-4">
                    <a href="single-post.html" class="overlay-link"></a>
                    <div class="card-header p-0">
                        <div class="blog-media">
                            <img src="assets/imgs/blog-6.jpg" alt="" class="w-100">
                            <a href="#" class="badge badge-primary">#Lorem</a>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <h5 class="card-title mb-2">Corporis Placeat</h5>
                        <small class="small text-muted"><i class="ti-calendar pr-1"></i> January 24 2019
                        </small>
                        <p class="my-2">consectetur adipisicing Cum veritatis minus iustorpo cupiditate voluptas ...</p>
                    </div>
                </div>

                <div class="media text-left mb-4">
                    <a href="single-post.html" class="overlay-link"></a>
                    <img class="mr-3" src="assets/imgs/blog-1.jpg" width="100px" alt="Generic placeholder image">
                    <div class="media-body">
                        <h6 class="mt-0">Nobis Mollitia</h6>
                        <p class="mb-2"> deserunt quisqua...</p>
                        <p class="text-muted small"><i class="ti-calendar pr-1"></i> January 02 2019</p>
                    </div>
                </div>
                <div class="media text-left mb-4">
                    <a href="single-post.html" class="overlay-link"></a>
                    <img class="mr-3" src="assets/imgs/blog-2.jpg" width="100px" alt="Generic placeholder image">
                    <div class="media-body">
                        <h6 class="mt-0">Officiis Laborum</6>
                            <p class="mb-2"> deserunt quisqua...</p>
                            <p class="text-muted small"><i class="ti-calendar pr-1"></i> January 10 2019</p>
                    </div>
                </div>
                <div class="media text-left mb-4">
                    <a href="single-post.html" class="overlay-link"></a>
                    <img class="mr-3" src="assets/imgs/blog-3.jpg" width="100px" alt="Generic placeholder image">
                    <div class="media-body">
                        <h6 class="mt-0">Sapiente fugit vero</h6>
                        <p class="mb-2"> deserunt ard quisqua...</p>
                        <p class="text-muted small"><i class="ti-calendar pr-1"></i> January 04 2019</p>
                    </div>
                </div> -->
                <div class="ad-card d-flex text-center align-items-center justify-content-center">
                    <span href="#" class="font-weight-bold">ADS</span>
                </div>
            </div>
        </div>
    </div>
@endsection
