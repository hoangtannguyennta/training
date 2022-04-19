@extends('admin.index')
@section('content')
<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Đặt lại mật khẩu') }}</h4>
            </div>
            <div class="form-bottom">
                <form method="POST"  action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <label for="fname">{{ __('Email') }}</label>
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                    <label for="fname">{{ __('Nhập lại mật khẩu') }}</label>
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                    <input class="input button-form" type="submit" value="Gửi liên kết đặt lại mật khẩu">
                </form>
            </div>
          </div>
    </div>
</section>
@endsection
