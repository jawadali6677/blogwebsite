@extends('layout.app')
@section('content')
    <section class="container">
        <div class="page-container">
            <div class="page-content">
                @foreach($posts as $post)
                <div class="card">
                    <div class="card-header pt-0">
                        <h3 class="card-title mb-4">{{ $post->title }}</h3>
                        <div class="blog-media mb-4">
                            <a href="{{ route('show_post' , ['id' => $post->id])}}">
                                <img src="{{ Storage::url($post->thumbnail) }}" alt="" class="w-100">
                                <a href="#" class="badge badge-primary">#Salupt</a>
                            </a>
                        </div>
                        <small class="small text-muted">
                            <a href="#" class="text-muted">{{ $post->author->name }}</a>
                            <span class="px-2">·</span>
                            <span>{{ $post->created_at->format('M-Y-d') }}</span>
                            <span class="px-2">·</span>
                            <a href="#comments" class="text-muted">{{ $post->comments->count() }} Comments</a>
                        </small>
                    </div>
                    {{-- <div class="card-body border-top">

                        <div>{!! markdown_to_html($post->content) !!}</div>
                    </div> --}}
                    {{-- <livewire:read-comment :postId="$post->id" /> --}}
                </div>
                @endforeach
            </div>
            <!-- Sidebar -->
            <div class="page-sidebar">
        
                <div class="ad-card d-flex text-center align-items-center justify-content-center mt-4">
                    <span href="#" class="font-weight-bold">ADS</span>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
