@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="container-fluid min-vh-100">

<div class="row min-vh-100">

        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
        LOGO
        </div>

        {{-- KANAN : FORM LOGIN --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center"
            style="background:#B9B4FF;">

            <div class="bg-white p-4"
                 style="width:360px; border-radius:12px;">

                <h4 class="text-center mb-4"><strong>LOGIN</strong></h4>

                <form>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="btn btn-sm"
                                style="background:#9B8CFF;color:white;">
                            Login
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>
@endsection
