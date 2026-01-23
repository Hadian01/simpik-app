@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">

    <div class="row w-100" style="max-width:900px; border:1px solid #ddd;">

        {{-- KIRI : LOGO --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <div class="text-center">
                <div class="rounded-circle border d-flex align-items-center justify-content-center"
                     style="width:200px;height:200px;">
                    <h3 class="m-0">LOGO</h3>
                </div>
            </div>
        </div>

        {{-- KANAN : FORM LOGIN --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center"
             style="background:#B9B4FF;">
            <div class="bg-white p-4 w-75" style="border-radius:8px;">

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
                        <button type="button"
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
