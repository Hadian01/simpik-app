@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="row min-vh-100 no-gutters">

        {{-- KIRI : LOGO --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <div class="rounded-circle border d-flex align-items-center justify-content-center"
                 style="width:220px;height:220px;">
                <h3 class="m-0">LOGO</h3>
            </div>
        </div>

        {{-- KANAN : FORM REGISTER --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center"
             style="background:#B9B4FF;">

            <div class="bg-white p-4"
                 style="width:360px; border-radius:12px;">

                <h4 class="text-center mb-4"><strong>Register</strong></h4>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <select name="type" class="form-control">
                            <option value="">Pilih Type</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Email">
                    </div>

                    <div class="form-group">
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Password">
                    </div>

                    <div class="form-group">
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Password Confirmation">
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="btn btn-sm"
                                style="background:#9B8CFF;color:white;">
                            Register
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>
@endsection
