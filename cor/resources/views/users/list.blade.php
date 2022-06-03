@extends('admin.index')
@section('content')

<section class="banner banner-table">
    <div class="container">
        <h1>{{ __('Danh sách người dùng') }}</h1>
        <a href="{{ route('users.create') }}" class="button"><i class="fa fa-plus"></i></a>
        <table>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Tên') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Mật khẩu') }}</th>
                <th>{{ __('Ngày khởi tạo') }}</th>
                <th>{{ __('Chức năng') }}</th>
            </tr>
            @if(count($users) === 0)
                <tr>
                    <td>KCDL</td>
                </tr>
            @else
            @foreach ($users as $k => $item)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>***</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <div class="action">
                            <a class="button" href="{{ route('users.edit',$item->id) }}"><i class="fa fa-edit"></i></a>
                            <a class="button modal-success" data-email="{{ $item->email }}" data-created_at="{{ $item->created_at }}" data-name="{{ $item->name }}"><i class="fa fa-eye"></i></a>
                            <a class="button modal-pubs-delete" data-href="{{ route('users.delete',$item->id) }}"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
        </table>
    </div>
</section>

@include('modal.modal_delete');

<div class="modal">
    <div class="modal-content">
        <span class="modal-close button">&times;</span>
        <h2>{{ __('Thông tin chi tiết người dùng') }}</h2>
        <h3>{{ __('Tên :') }}</h3>
        <p class="user-name"></p>
        <h3>{{ __('Email :') }}</h3>
        <p class="user-email"></p>
        <h3>{{ __('Mật khẩu :') }}</h3>
        <p class="user-password">***</p>
        <h3>{{ __('Ngày khởi tạo') }}</h3>
        <p class="user-created_at"></p>
    </div>
</div>

@endsection
