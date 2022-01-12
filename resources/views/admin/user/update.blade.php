@extends('admin.masterlayout.masteradmin')

@section('title', 'Cập nhật người dùng')


@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding-top: 20px;" class="text-center"><i class="fas fa-tasks"></i> Cập Nhật Người Dùng</h1>
                <div class="container">
                    <div class="row py-5 mt-4 align-items-center">
                        <!-- For Demo Purpose -->
                        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                            <img src="https://lifeveda.com.my/wp-content/themes/lifeveda-theme/static/img/edit-user.png"
                                width="300px" alt="" class="img-fluid mb-3 d-none d-md-block">
                        </div>
                        <!-- Registeration Form -->
                        <div class="col-md-7 col-lg-6 ml-auto">
                            <ul class="alert text-danger">
                                @foreach ($errors->all() as $error)
                                    <li style="color: red;font-family:monospace">{{ $error }}</li>
                                @endforeach
                            </ul>
                            <form action="{{ route('user.update', [$user->id]) }}" method="post">
                                @csrf
                                {{ method_field('put') }}
                                <div class="row">
                                    <label class="control-label"><b>Email</b></label>
                                    <div class="input-group col-lg-12 mb-4">
                                        <input value="{{ $user->email }}" type="email" name="email"
                                            class="form-control bg-white border-left-0 border-md" readonly>
                                    </div>
                                    <label class="control-label"><b>Tên Người Dùng</b></label>
                                    <div class="input-group col-lg-6 mb-4">
                                        <input value="{{ $user->name }}" required="" type="text" name="name"
                                            class="form-control bg-white border-left-0 border-md">
                                    </div>
                                    <label class="control-label"><b>Phân Quyền</b></label>
                                    <div class="input-group col-lg-12 mb-4">
                                        <select name="role" required="" class="form-control browser-default custom-select">
                                            <option value="1" {{ $user->role === '1' ? 'Selected' : '' }}>Admin</option>
                                            <option value="0" {{ $user->role === '0' ? 'Selected' : '' }}>Người Dùng
                                            </option>
                                        </select>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="row" style="display: block; margin: 0 auto">
                                        <a class="btn btn-outline-info"
                                            style="float: left; width: 150px; display: block; margin-right: 30px"
                                            href="{{ route('user.doi-mat-khau-form', $user->id) }}">Đổi Mật Khẩu</a>
                                        <button class="btn btn-primary" type="submit" style="width: 100px">Xong</button>
                                    </div>
                                    <!-- Already Registered -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
