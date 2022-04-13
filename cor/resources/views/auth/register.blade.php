@extends('admin.index')
@section('content')
<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Đăng ký') }}</h4>
            </div>
            <div class="form-bottom">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <label for="fname">{{ __('Tên') }}</label>
                    <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <div class="invalid-form" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="fname">{{ __('Email') }}</label>
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <div class="invalid-form" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="fname">{{ __('Mật khẩu') }}</label>
                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <div class="invalid-form" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="fname">{{ __('Nhập mật khẩu') }}</label>
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                    @error('password')
                        <div class="invalid-form" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <input class="input button-form" type="submit" value="Đăng ký">
                </form>
            </div>
          </div>
    </div>
</section>
@endsection
