@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <form id="UPDATE_PROFILE">
                        @csrf

                        @if ($errors->all())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif

                        @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <span>{{ session('success') }}</span>
                        </div>
                        @endif

                        <div class="d-flex justify-content-center">
                            <img src="{{ url('storage/files/'.$user->thumbnail) }}" height="200" class="rounded-circle" alt="...">
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">Email</label>
                            <input type="text" class="form-control" value="{{$user->email}}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">Username</label>
                            <input type="text" class="form-control" name="username" value="{{$user->username}}" required>

                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">First name</label>
                            <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" required>


                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">Last name</label>
                            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" required>


                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">Address</label>
                            <input type="text" class="form-control" name="address" value="{{$user->address}}" required>


                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" value="{{$user->birthdate}}" required>


                        </div>

                        <div class="mb-3">
                            <label class="col-md-4 col-form-label ">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{$user->phone}}" required>


                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#UPDATE_PROFILE').on('submit', function(e) {
            e.preventDefault(e);

            let first_name = $('input[name=first_name]').val();
            let last_name = $('input[name=last_name]').val();
            let address = $('input[name=address]').val();
            let birthdate = $('input[name=birthdate]').val();
            let phone = $('input[name=phone]').val();
            let username = $('input[name=username]').val();
            let data = new FormData(this)

            $.ajax({
                url: "{{ route('profile.update') }}",
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,

                success: function(response) {
                },

                error: function(error) {
                    console.log(error)
                }
            });
        })
    });
</script>
@endsection