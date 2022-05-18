@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('users.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Cập nhật danh sách người dùng') }}</h4>
            </div>
            <div class="form-bottom">
                <form action="{{ route('users.update',$users->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <label for="fname">{{ __('Tên') }}</label>
                    <input type="text" class="input" id="fname" name="name" value="{{ $users->name }}" placeholder="Nhập tên" required>
                    @error('name')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="lname">{{ __('Email') }}</label>
                    <input type="email" class="input" id="lname" name="email" value="{{ $users->email  }}" placeholder="Nhập email" required>
                    @error('email')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="fname">{{ __('Mật khẩu') }}</label>
                    <input type="password" class="input" id="fname" name="password"  placeholder="********">
                    @error('password')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <label for="lname">{{ __('Nhập lại mật khẩu') }}</label>
                    <input type="password"class="input"  id="lname" name="password_confirmation"  placeholder="********">
                    @error('password')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <input type="submit" class="input button-form" value="Cập nhật">
                </form>
            </div>
          </div>
    </div>
</section>

@if(session()->has('success'))
    <script >
    $.toast({
    heading: 'Success',
    text:  'Chúc mừng bạn đã cập nhật thành công',
    bgColor: '#FF1356',
    position: 'mid-center',
    stack: false
    })
    </script>
@endif

@endsection
