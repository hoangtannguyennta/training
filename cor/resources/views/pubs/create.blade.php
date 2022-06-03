@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('pubs.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Tạo danh sách hàng hoá') }}</h4>
            </div>
            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('pubs.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên hàng :') }}</label>
                        <input class="input" type="text" id="fname" name="product_name" value="{{ Request::old('product_name') }}" placeholder="Nhập tên" required>
                        <label for="lname">{{ __('Số lượng :') }}</label>
                        <input class="input" type="number" id="lname" name="amount" value="{{ Request::old('amount') }}" placeholder="Nhập số lượng" required>
                    </div>
                    <div class="form-content">
                        <label for="lname">{{ __('Giá :') }}</label>
                        <input class="input input-price" type="number" id="lname" name="price" value="{{ Request::old('price') }}" placeholder="Nhập giá" required>
                        <label for="lname">{{ __('Thành viên :') }}</label>
                        <select class="select" name="user_id">
                            <option value="">Chọn thành viên nhập</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select-multil">
                        <label for="lname">{{ __('Thành viên sử dụng :') }}</label>
                        <select class="select" name="pubs_users[]" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="lname">{{ __('Hình ảnh') }}</label>
                    <div class="input-group hdtuto control-group lst increment" >
                        <div class="list-input-hidden-upload">
                            <input type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+ ADD</button>
                        </div>
                    </div>
                    <div class="list-images">
                    </div>
                    <input type="submit" class="input button-form" value="Thêm">
                </form>
            </div>
          </div>
    </div>
</section>

@if(session()->has('success'))
    <script >
    $.toast({
    heading: 'Success',
    text:  'Chúc mừng bạn đã thêm thành công',
    bgColor: '#FF1356',
    position: 'mid-center',
    stack: false
    })
    </script>
@endif

@endsection
