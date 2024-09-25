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
                                <textarea wire:model="description" id="commentbox" class="form-control" placeholder="What are you thinking?"></textarea>

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
</div>
    
    {{-- <div class="media mt-5">
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
    </div> --}}

</div>

@section('script')
<script>
    window.addEventListener('comment:save', event => {
        var msg = event.detail[0].message
        var text = event.detail[0].text
        var type = event.detail[0].type
        
        Swal.fire(msg , text , type , 'top-end');
    });

    $(document).on('click', '.replay', function(e) {
        e.preventDefault();
        var parent_id = $(this).data('id');
        console.log('parent_id', parent_id);
        @this.set('parent_id', parent_id);  // Make sure Livewire JS is properly included
        $("#commentbox").focus();
    });

    $("#commentbox").focus(function(){

    })
</script>
@endsection