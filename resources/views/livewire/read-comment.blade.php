
<div class="card-footer" id="comments">
    <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Comments {{ $comments->count() }}</a></h6>
    <hr>
    <div class="main">
    @foreach($comments as $comment)
        @if(!$comment->parent)
            <!-- Top-level comment -->
            
                @include('partials.comment', ['comment' => $comment])
            
        @endif
    @endforeach
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

    
    @guest 
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
                <input type="text" class="form-control" id="post_id" hidden wire:model="post_id" value="{{$post->id}}">
                <input type="text" class="form-control" id="parent_id" hidden wire:model="parent_id" value="">
            </div>
            {{-- <div class="col-sm-4 form-group">
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