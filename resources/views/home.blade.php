@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Home - {{$user->username}}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="container">
                        <form id="TWEET_">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="col-12">
                                        <span class="p-4">
                                            Welcome <b>{{$user->first_name }} {{$user->last_name}}</b>
                                        </span>
                                    </div>

                                    <img src="{{ url('storage/files/'.$user->thumbnail) }}" height="200" class="rounded-circle" alt="...">
                                </div>

                                <div class="col-md mb-3">
                                    <textarea class="form-control" id="tweet" name="tweet" maxlength="255" rows="10" rows="3"></textarea>

                                    <span id="count">Characters left: 255</span>

                                    <div class="mb-3">
                                        <label class="col-md-4 col-form-label ">Thumbnail</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="is_public" value="public">
                                        Public
                                        <label class="form-check-label" for="radio2"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="is_public" value="private"> Private
                                        <label class="form-check-label"></label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr />
                <div class="mt-2 card-body">
                    @foreach ($tweets as $tweet)
                    <div class="row m-3" id="tweeetlist-{{$tweet->id}}">
                        <div class="col-auto">
                            <img src="{{ url('storage/tweet_img/'.$tweet->image) }}" height="100">
                        </div>
                        <div class="tweet-div col">
                            <span id="retrieve_tweet">{{$tweet->tweet}}</span><br />
                            <span id="date">{{$tweet->created_at}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#tweet").change(function() {
        $("#count").text("Characters left: " + (255 - $(this).val().length));
    });

    //LOAD

    $(document).ready(function() {
        //SUBMIT

        $('#TWEET_').on('submit', function(e) {
           
            // tresSec()
            let is_public = $(`input[name=is_public]`).val();
            let image = $(`input[name=image]`).val();
            let tweet = $(`#tweet`).val();
            let data = new FormData(this);

            $.ajax({
                url: "{{ route('home.tweet.store') }}",
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,

                success: function(response) {},

                error: function(error) {
                    console.log(error)
                }
            });
        });

    });
</script>
@endsection