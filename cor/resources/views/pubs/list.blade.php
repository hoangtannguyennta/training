@extends('admin.index')
@section('content')

<section class="banner banner-table">
    <div class="container">
        <h1>{{ __('Danh sách hàng hoá') }}</h1>
        <a href="{{ route('pubs.create') }}" class="button"><i class="fa fa-plus"></i></a>
        <a class="button excel" href="{{ route('pubs.export') }}">{{ __('Export Excel') }}</a>
        <table>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Ảnh') }}</th>
                <th>{{ __('Tên sản phẩm') }}</th>
                <th>{{ __('Số lượng') }}</th>
                <th>{{ __('Giá cả') }}</th>
                <th>{{ __('T.Tiền') }}</th>
                <th>{{ __('Ngày tạo') }}</th>
                <th>{{ __('Chức năng') }}</th>
            </tr>
            @if(count($pubs) === 0)
                <tr>
                    <td>KCDL</td>
                </tr>
            @else
            @foreach ($pubs as $k => $pub)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td class="pubs-list-img">
                        @foreach (json_decode($pub->images,true) as $image)
                            <img src="files_pubs/{{ $image }}">
                        @endforeach
                    </td>
                    <td>{{ $pub->product_name }}</td>
                    <td>{{ $pub->amount }}</td>
                    <td>{{ number_format( $pub->price )}}</td>
                    <td>{{ number_format( $pub->price * $pub->amount )}}</td>
                    <td>{{ $pub->created_at }}</td>
                    <td>
                        <div class="action">
                            <a class="button" href="{{ route('pubs.edit',$pub->id) }}"><i class="fa fa-edit"></i></a>
                            <a class="button modal-pubs-success"
                                data-product_name = "{{ $pub->product_name }}"
                                data-amount = "{{ $pub->amount }}"
                                data-price = "{{ $pub->price }}"
                                data-total = "{{ $pub->price * $pub->amount }}"
                                data-images = "{{ $pub->images }}"
                                data-user = "{{ $pub->users->name }}"
                                data-users = "{{ $pub->pubs_users->pluck('name') }}"
                                data-created_at = "{{ $pub->created_at }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{ route('pubs.delete',$pub->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('POST')
                                <button class="button" onclick="return confirm('Xoá vĩnh viễn {{ $pub->product_name }} ?')" type="submit"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
        </table>
    </div>
</section>

<div class="modal">
    <div class="modal-content">
        <span class="modal-close button">&times;</span>
        <h2>{{ __('Danh sách  chi tiết hàng hoá') }}</h2>
        <div class="modal-content-list">
            <div>
                <h3>{{ __('Tên sản phẩm :') }}</h3>
                <p class="pubs-name"></p>
                <h3>{{ __('Số lượng :') }}</h3>
                <p class="pubs-amount"></p>
                <h3>{{ __('Giá cả :') }}</h3>
                <p class="pubs-price"></p>
            </div>
            <div>
                <h3>{{ __('Tổng tiền :') }}</h3>
                <p class="pubs-total"></p>
                <h3>{{ __('Thành viên nhập :') }}</h3>
                <p class="pubs-user"></p>
                <h3>{{ __('Ngày khởi tạo') }}</h3>
                <p class="pubs-created_at"></p>
            </div>
        </div>
        <h3>{{ __('Thành viên sử dụng :') }}</h3>
        <p class="pubs-users"></p>
        <h3>{{ __('Hình ảnh') }}</h3>
        <p class="pubs-image">
        </p>
    </div>
</div>

@if(session()->has('success'))
    <script >
    $.toast({
    heading: 'Success',
    text:  'Chúc mừng bạn đã xoá thành công',
    bgColor: '#FF1356',
    position: 'mid-center',
    stack: false
    })
    </script>
@endif

@endsection
