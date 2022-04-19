@extends('admin.index')
@section('content')
<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Đặt lại mật khẩu') }}</h4>
            </div>
            <div class="form-bottom">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    @if (session('status'))
                        <div class="invalid-form-success"  role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <label for="fname">{{ __('Email') }}</label>
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <div class="invalid-form" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <input class="input button-form" type="submit" value="Gửi liên kết đặt lại mật khẩu">
                </form>
            </div>
          </div>
    </div>
</section>
@endsection
