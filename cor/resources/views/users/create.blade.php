@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('users.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Tạo danh sách người dùng') }}</h4>
            </div>
            <div class="form-bottom">
                <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <label for="fname">{{ __('Tên') }}</label>
                    <input class="input" type="text" id="fname" name="name" value="{{ Request::old('name') }}" placeholder="Nhập tên" required>
                    @error('name')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="lname">{{ __('Email') }}</label>
                    <input class="input" type="email" id="lname" name="email" value="{{ Request::old('email') }}" placeholder="Nhập email" required>
                    @error('email')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="fname">{{ __('Mật khẩu') }}</label>
                    <input class="input" type="password" id="fname" name="password" value="{{ Request::old('password') }}" placeholder="Nhập mật khẩu" required>
                    @error('password')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="lname">{{ __('Nhập lại mật khẩu') }}</label>
                    <input class="input" type="password" id="lname" name="password_confirmation" value="{{ Request::old('password_confirmation') }}" placeholder="Nhâp lại mật khẩu" required>
                    @error('password')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <input type="submit" class="input button-form" value="Thêm">
                </form>
            </div>
          </div>
    </div>
</section>

@include('modal.success')

@endsection
