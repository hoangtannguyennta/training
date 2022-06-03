@extends('admin.index')
@section('content')
<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Đăng nhập') }}</h4>
            </div>
            <div class="form-bottom">
                <form  method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="lname">{{ __('Email') }}</label>
                    <input class="input" type="email" id="lname" name="email" value="{{ Request::old('email') }}" required placeholder="Nhập email">
                    @error('email')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="fname">{{ __('Nhập mật khẩu') }}</label>
                    <input class="input" type="password" id="fname" name="password" value="{{ Request::old('password') }}" required placeholder="Nhập mật khẩu">           
                    @error('password')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="action-login">
                        <label for="remember">
                            {{ __('Ghi nhớ mật khẩu') }}
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        </label>
                        @if (Route::has('password.request'))
                            <a  href="{{ route('password.request') }}">
                                {{ __('Quên mật khẩu ?') }}
                            </a>
                        @endif  
                    </div>
                    <input class="input button-form" type="submit" value="Đăng nhập">
                </form>
            </div>
          </div>
    </div>
</section>
@endsection
