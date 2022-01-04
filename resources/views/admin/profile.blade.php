@extends('layouts.admin')

@section('content')
<div class="row mx-2">
    <div class="col-8">
        <div class="card card-primary card-outline">
            <div class="card-title pt-4 pl-4">
                <label for="RideStat" class="card-text text-md text-black text-lg">{{__('Edit Profile')}}</label>
                <!-- <button>{{__('Add Rider')}}</button> -->
            </div>

            <div class="card-body">
                <form role="form" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" id="profileForm">
                    @csrf
                    @method('PUT')
                    @if (session('success'))
                    <div class="alert alert-success fade-message" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="username">{{__('Username')}}</label>
                            <input type="hidden" name="auth_id" value="{{Auth::user()->id}}">
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{Auth::user()->username}}" placeholder="Username">

                        </div>
                        <div class="col-8">
                            <label for="email">{{__('Email')}}</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{Auth::user()->email}}" placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <label for="name">{{__('Full Name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}"
                                placeholder="Full Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="Password">
                        </div>
                        <div class="col-6">
                            <label for="confirm_password">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" name="confirm_password"
                                placeholder="Confirm Password">
                            <span class="p-0 col-sm-6"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="text-center col-12 pt-4">
                            <button type="submit" class="btn btn-info 
                            text-white font-weight-normal">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://imgur.com/lKpEXsK.gif"
                        alt="User profile picture">
                    <h4 class="title py-2">{{Auth::user()->name}}<br><a
                            href="#"><small>@</small><small>{{Auth::user()->username}}</small></a></h4>
                </div>
                <hr>
                <div>
                    <p class="description text-center">
                        <span class="font-italic">{{Auth::user()->email}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<script src="http://cntp.test:8080/socket.io/socket.io.js"></script>
<script>
    $(function () {
        setTimeout(function () {
            $('.fade-message').fadeOut();
        }, 3000);
    });
</script>
<script>
    $('#profileForm').validate({
        rules: {
            username: {
                required: true,
            },
            email: {
                required: true,
            },
            name: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
        },
        messages: {
            username: {
                required: "Please provide a username",
            },
            email: {
                required: "Please provide email address",
            },
            name: {
                required: "Please enter your full name",
            },
            password: {
                required: "Please enter a password",
                minlength: "Minimum length is 6",
            },
            confirm_password: {
                required: "Confirm your password",
                minlength: "Minimum length is 6",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback col-sm-6 ');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

</script>
@endpush