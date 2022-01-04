@extends('layouts.blank')

@section('content')
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>{{ __('CNTP') }}</b></a>
        </div>

        <div class="card-body">
            <p class="login-box-msg">Register a new user</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group mb-3">
                    <input input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" required autocomplete="off" autofocus
                        placeholder="Username">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="off" autofocus
                        placeholder="Full name">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- role -->
                <div class="input-group mb-3">
                    <select class="form-select form-select" aria-label=".form-select-sm example" id="role" name="role"
                        onChange="checkRole()">
                        <option value="0" disabled="" selected="">Choose Role</option>
                        <option value="1">SuperAdmin</option>
                        <option value="2">Municipal</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <select class="form-select form-select" aria-label=".form-select-sm example" id="municipality"
                        name="municipality">
                        <option value="all" disabled="" selected="">Choose</option>
                        <option value="Basud">Basud</option>
                        <option value="Capalonga">Capalonga</option>
                        <option value="Daet">Daet</option>
                        <option value="Jose Panganiban">Jose Panganiban</option>
                        <option value="Labo">Labo</option>
                        <option value="Mercedes">Mercedes</option>
                        <option value="Paracale">Paracale</option>
                        <option value="San Lorenzo Ruiz">San Lorenzo Ruiz</option>
                        <option value="San Vicente">San Vicente</option>
                        <option value="Santa Elena">Santa Elena</option>
                        <option value="Talisay">Talisay</option>
                        <option value="Vinzons">Vinzons</option>
                    </select>
                    <!-- <div class="input-group-append" id="icon_municipality">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            @error('municipality')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> -->
                </div>

                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="off" placeholder="Password">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="off" placeholder="Confirm password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
            <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById("municipality").style.display = "none";

    const checkRole = () => {
        let dropdown = document.getElementById("role");
        let current_value = dropdown.options[dropdown.selectedIndex].value;

        if (current_value == "Municipal" || current_value == 2) {
            document.getElementById("municipality").style.display = "block";
            // document.getElementById("icon_municipality").style.display = "block";
        }
        else if (current_value == "SuperAdmin" || current_value == 1) {
            $('#municipality').prop('selectedIndex',0);
            document.getElementById("municipality").style.display = "none";
            // document.getElementById("icon_municipality").style.display = "none";
        }
    }

</script>
@endpush