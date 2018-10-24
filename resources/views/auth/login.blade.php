@extends('layouts.main-login')

@section('content')
    <div class="container-login100 bg-body">
        <div class="wrap-login100 fadeIn animated">
            <div class="login100-form-title"
                 style="background-image: url({{ asset('css/login/images/fri.jpg') }});background-position:center !important;">
					<span class="login100-form-title-1">
						<style media="screen">
							/* .crop{
								height:100px !important;
								overflow: hidden !important;
								margin-bottom: 0 !important;
							}
							.crop img{
								display: block !important;
								height: 100% !important;
								margin-bottom: -80% !important;
							} */
                            figure {
                                width: 90px; /*container-width*/
                                overflow: hidden; /*hide bounds of image */
                                margin-bottom: 0 !important; /*reset margin of figure tag*/
                                background-position: top;
                            }

                            figure img {
                                display: block; /*remove inline-block spaces*/
                                width: 100%; /*make image streatch*/
                                margin-bottom: -20% !important;
                            }
						</style>
						{{--<center>--}}
							{{--<figure>--}}
								{{--<img src="{{ asset('css/login/images/logo-01.png') }}" class="crop" alt="logo bppip">--}}
							{{--</figure>--}}
						{{--</center>--}}
						{{--<h4>BP2IP BAROMBONG</h4>--}}
					</span>
            </div>

            <style media="screen">
                .lgn-btn {
                    background-color: #3c8dbc;
                }

                .lgn-btn:hover {
                    background-color: #275b7a;
                    /* color: #3c8dbc; */
                }

                .input-style:focus {
                    color: #000;
                }
            </style>
            <form class="login100-form validate-form" method="post" action="{{ route('login') }}">
                @csrf
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="email" name="email" placeholder="Masukkan email">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100 input-style" type="password" name="password" placeholder="Masukkan password">
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-b-30">
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" name="masuk" class="login100-form-btn lgn-btn">
                        Login
                    </button>
                </div>
                <div class="form-group row">
                    {{--<div class="col-md-6 offset-md-4">--}}
                        <a href="{{ url('/auth/google') }}" class="btn btn-github"><i class="fa fa-github"></i> Google</a>
                        <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                    {{--</div>--}}
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    @if($errors->any())
        <script>
            swal('Oops !', 'Akun yang anda masukan salah atau Sudah tidak aktif', 'error')
        </script>
    @endif
@endpush
