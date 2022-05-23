@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('pubs.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Cập nhật danh sách hàng hoá') }}</h4>
            </div>
            <div class="form-bottom">
                <form action="{{ route('pubs.update',$pubs->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên hàng :') }}</label>
                        <input class="input" type="text" id="fname" name="product_name" value="{{ $pubs->product_name }}" placeholder="Nhập tên" required>
                        @error('product_name')
                            <div class="invalid-form">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <label for="lname">{{ __('Số lượng :') }}</label>
                        <input class="input" type="number" id="lname" name="amount" value="{{ $pubs->amount }}" placeholder="Nhập số lượng" required>
                        @error('amount')
                            <div class="invalid-form">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-content">
                        <label for="lname">{{ __('Giá :') }}</label>
                        <input class="input" type="number" id="lname" name="price" value="{{ $pubs->price }}" placeholder="Nhập giá" required>
                        @error('price')
                            <div class="invalid-form">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <label for="lname">{{ __('Thành viên :') }}</label>
                        <select name="user_id" disabled>
                            <option value="">Chọn thành viên nhập</option>
                            @foreach ($users as $user)
                                <option {{ $user->id == $pubs->user_id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-form">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <label for="lname">{{ __('Thành viên sử dụng :') }}</label>
                    <select name="pubs_users[]" multiple>
                        @foreach ($users as $user)
                            <option {{ in_array($user->id,$array_pubs_users) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <p>Nhấn và giữ nút Ctrl (windows) hoặc Command (Mac) để chọn nhiều tùy chọn.</p>
                    <label for="lname">{{ __('Hình ảnh') }}</label>
                    <div class="input-group hdtuto control-group lst increment" >
                        <div class="list-input-hidden-upload">
                            <input type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+Add</button>
                        </div>
                    </div>
                    @error('images')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="list-images">
                        @if (isset($pubs->images) && !empty($pubs->images))
                            @foreach (json_decode($pubs->images) as $key => $img)
                                <div class="box-image">
                                    <input type="hidden" name="images_uploaded[]" value="{{ $img }}" id="img-{{ $key }}">
                                    <img src="{{ asset('files_pubs/'.$img) }}" class="picture-box">
                                    <div class="wrap-btn-delete"><span data-id="img-{{ $key }}" class="btn-delete-image">x</span></div>
                                </div>
                            @endforeach
                            <input type="hidden" name="images_uploaded_origin" value="{{ $pubs->images }}">
                            <input type="hidden" name="id" value="{{ $pubs->id }}">
                        @endif
                    </div>
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

