@extends('layouts.frontend')

@section('content')

    <main class="main_wrapper body_overlay overflow_hidden">

      <!-- breadcrumb__start -->
      <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__title">
                        <h1>Login</h1>
                        <ul>
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li class="color__blue">
                                Login
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- breadcrumb__end -->


 <!-- login_section_start -->
    <div class="loginarea  sp_bottom_80 sp_top_80">
     <div class="container">
        <div class="row">
            <div class="tab-content tab_content_wrapper" id="myTabContent">

                <div class="tab-pane fade active show" id="projects_one" role="tabpanel" aria-labelledby="projects_one">
                    <div class="col-xl-8 offset-md-2 loginarea__col">
                        <div class="loginarea__wraper">
                            <div class="loginarea__heading">
                                <h5 class="login__title">Login</h5>
                                <p class="login__description">Don't have an account yet? <a href="{{ route('register') }}" >Sign up for free</a></p>
                            </div>



                            <form method="POST" action="{{route ('login')}}">
                                @csrf

                                <div class="loginarea__form">
                                    <label class="form__label">Username or email</label>
                                    <input id="email" class="common_login_input @error('email') is-invalid @enderror" type="email" placeholder="Your username or email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="loginarea__form">
                                    <label class="form__label">Password</label>
                                    <input id="password" class="common_login_input @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required autocomplete="current-password">

                                     @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="loginarea__form d-flex justify-content-between flex-wrap gap-2">
                                    <div class="form__check">
                                        <input type="checkbox" id="login__privacy" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="login__privacy">Remember Me</label>
                                    </div>
                                    <div class="text-end login_form_link">
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                </div>
                                <div class="loginarea__button text-center">
                                    <button type="submit" class="default__button">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>

    </div>
    </div>

    </main>


</body>
@endsection