@extends('master')

@section('content')
    <main id="content">
        <!-- banner1 -->
        <section class="banner-1">
            <div class="container" style=" color: white; text-align: justify">
                <h1 class="text-title">{{ $gioithieu->tieude }}</h1>
                <p class="text-body">{!! html_entity_decode($gioithieu->noidung) !!}</p>
                <button type=" button" class="btn btn-danger btn-1" style="background-color: #ff4367;">Browse
                    Ads</button>
                <button type="button" class="btn btn-light btn-1">Post an Ad</button>
                <div class="search">
                    <div class="row mb-3" style="margin: 0; padding: 0;">
                        <div class="col-md-3 input">
                            <div class="input-group mt-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" style="background-color: white;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </label>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" style="border-left: none;">
                                    <option selected>Location...</option>
                                    <option value="1">Hà Nội</option>
                                    <option value="2">Đà Nẵng</option>
                                    <option value="3">TP Hồ Chí Minh</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 input">
                            <div class="input-group mt-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" style="background-color: white;">
                                        <i class="fas fa-th-list"></i>
                                    </label>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" style="border-left: none;">
                                    <option selected>Catelogy...</option>
                                    @foreach ($danhmuc5 as $danhmuc)
                                        @if (isset($danhmuc->deleted_at))
                                        @else
                                            <option value="{{ $danhmuc->id }}">{{ $danhmuc->ten }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 input">
                            <div class="input-group mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                        style="background-color: white;">
                                        <i class="fab fa-acquisitions-incorporated"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" aria-label="Small"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="Type Your Word"
                                    style="border-left: none;">
                            </div>
                        </div>
                        <div class="col-md-2 sub">
                            <button type="button" class="btn btn-danger mt-4 btn-sub"
                                style="background-color: #ff4367;">Subscribe</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="keywords">
                                <li><b>Trendings Keywords:</b> </li>
                                @foreach ($danhmucs as $danhmuc)
                                    @if (isset($danhmuc->deleted_at))
                                    @else
                                        <li><a href="">{{ $danhmuc->ten }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end banner1 -->

        <!-- catelogy -->
        <section class="catelogy mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 style="float: left;">Popular <br> Catelogies</h1>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger btn-popu" style="background-color: #ff4367;">View
                            All
                            Catelogies</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="list text-center">
                            @foreach ($danhmucs as $danhmuc)
                                @if (isset($danhmuc->deleted_at))
                                @else
                                    <li data-aos="flip-down">
                                        <div class="card">
                                            <img id="catelogy" src="{{ asset('danhmuc_anh/' . $danhmuc->anh) }}" alt="">
                                            <div class="card-body">
                                                <p class="card-text" style="text-transform: uppercase;">
                                                    {{ $danhmuc->ten }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- end catelogy -->

        <!-- why choose us -->
        <section class="banner-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="title">Why Choose Us</p>
                        <p style="text-align: justify;">
                            Probably the most useful English application that uses machine learning. People can now
                            practice their pronunciation at
                            home and receive detailed feedback on what they need to improve..
                        </p>
                        <p>
                            <i class="fas fa-check-square" style="color: #453be4;"></i> {{ $gioithieu->tieuchi1 }}
                        </p>
                        <p>
                            <i class="fas fa-check-square" style="color: #ff4367;"></i> {{ $gioithieu->tieuchi2 }}
                        </p>
                        <p>
                            <i class="fas fa-check-square" style="color: aqua;"></i> {{ $gioithieu->tieuchi3 }}
                        </p>
                        <button type="button" class="btn btn-danger" style="float: left; background-color: #ff4367;">Read
                            More</button>
                    </div>
                    <div class="col-md-6">
                        <img src="https://photo-cms-nghenhinvietnam.zadn.vn/w700/Uploaded/2021/divxpwvo/2016_06_01/sony/nghehinvietnam_vn_vucattuong_42_glvm.jpg"
                            alt="" class="img">
                    </div>
                </div>
            </div>
        </section>
        <!-- end why choose us -->

        <!-- The Location -->
        <section class="catelogy mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 style="float: left;">Explore <br> The Locations</h1>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger btn-location" style="background-color: #ff4367;">Xem Tất
                            Cả</button>
                    </div>
                </div>
                <div class="row mt-4 location">
                    @foreach ($sanpham3 as $sanpham)
                        @if (isset($sanpham->deleted_at))
                        @else
                            <div class="col-md-4" data-aos="flip-left">
                                <div class="card card-location">
                                    <div class="sale">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <img class="card-img-top img-location"
                                        src="{{ asset('sanpham_anh/' . $sanpham->anh) }}" alt="Card image cap">
                                    <div class="card-body">
                                        <p style="height: 70px;text-transform: uppercase;" class="card-text"><a
                                                href=""><b>
                                                    {{ $sanpham->ten }}
                                                </b></a>
                                        </p>
                                        <div class="row">
                                            <div class="col col-lg-7">
                                                <span style="float: left">
                                                    <b>
                                                        <h5>Giá: {{ $sanpham->gia }}&#8363</h5>
                                                    </b>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $sanpham->soluongban }}%; background-color: #453be4"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small>Đã bán: {{ $sanpham->soluongban }} sản phẩm</small>
                                                </span>
                                            </div>
                                            <div class="col col-lg-5">
                                                <a href="#">
                                                    <span
                                                        style="float: right; background-color: #ff4367; color: white; padding: 10px 15px;">Mua
                                                        Ngay
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end The Location -->

        <!-- banner-3 -->
        <section class="banner-3 mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-9" data-aos="flip-left">
                        <div class="content">
                            <div class="row">
                                <div class="col-4 text-3">
                                    <i class="fas fa-toolbox fa-3x icon"></i><span class="number">
                                        <b class="icon">5000+</b></span>
                                    <p>Published Ads Here</p>
                                </div>
                                <div class="col-4 text-3">
                                    <i class="fas fa-user-tag fa-3x icon"></i><span class="number">
                                        <b class="icon">300+</b></span>
                                    <p>Register User Using</p>
                                </div>
                                <div class="col-4 text-3">
                                    <i class="fas fa-user-shield fa-3x icon"></i><span class="number">
                                        <b class="icon">1000+</b></span>
                                    <p>Verified User Using</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end banner-3 -->

        <!-- Recently -->
        <section class="catelogy mt-5 mb-5 recently">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 style="float: left;">Recently <br> Published Ads</h1>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger btn-recen" style="background-color: #ff4367;">View
                            all
                            Ads</button>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($sanphams as $sanpham)
                        @if (isset($sanpham->deleted_at))
                        @else
                            @if ($sanpham->danhmuc)
                                <div class="col-md-3" data-aos="flip-left">
                                    <div class="card" style="width: 100%; margin-top: 10px">
                                        <div class="card-body text">
                                            <span class="title">{{ $sanpham->danhmuc->ten }}</span> <span
                                                style="float: right;"><i class="far fa-heart"></i></span>
                                            <hr>
                                            <a href="">
                                                <p class="card-text" style="color: #453be4; height: 80px;">
                                                    {{ $sanpham->ten }}</p>
                                            </a>
                                            <small><i class="fas fa-cart-arrow-down"></i> Số lượng đã bán:
                                                {{ $sanpham->soluongban }}</small>
                                            <br>
                                            <br>
                                            <span
                                                style="color: #ff4367; font-size: 20px; font-weight: bolder;">{{ $sanpham->gia }}&#8363
                                            </span>
                                            <small
                                                style="float: right; margin-top: 7px;"><i>{{ $sanpham->ngaydang }}</i></small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end Recently -->

        <!-- ClassiFied Here For You -->
        <section class="catelogy mt-5 mb-5 classified">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">ClassiFied <br> Here For You</h1>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($blog6 as $blog)
                        @if (isset($blog->deleted_at))
                        @else
                            <div class="col-md-4 mt-3" data-aos="zoom-in">
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <i class="fab fa-sellcast fa-4x icon" style="color: #ff4367;"></i>
                                            </div>
                                            <div class="col-sm-9">
                                                <h4>{{ $blog->tieude }}</h4>

                                                {!! html_entity_decode($blog->noidung) !!}

                                                <a href="">
                                                    Read More <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end ClassiFIed here For You -->

        <!-- Find a Plan  -->
        <section class="plan">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <h1>Find a Plan <br> That's Right For You</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 around text-center" data-aos="flip-right"
                        style="box-shadow: -5px 5px 5px #666;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        -moz-box-shadow: -5px -5px -5px #666;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        -webkit-box-shadow: -5px -5px -5px #666;">
                        <i class="fas fa-award fa-4x icon" style="margin-top: 30px; color: #453be4;"></i> <br>
                        <b class="title">Beginners</b>
                        @if (isset($blog0->deleted_at))
                        @else
                            <span class="text-plan">{!! html_entity_decode($blog0->noidung) !!}</span>
                            <h3>{{ $blog0->ngaydang }}</h3>
                        @endif
                        <button type="button" class="btn btn-danger"
                            style="margin-left: auto; margin-right: auto; display: block; background-color: #ff4367; color: white;">View
                            all
                            Post</button>
                    </div>
                    <div class="col-md-4 center text-center" data-aos="flip-right">
                        <i class="fab fa-buffer fa-4x icon" style="margin-top: 80px;"></i> <br>
                        <b class="title">Standard</b>
                        @if (isset($blog1->deleted_at))
                        @else
                            <span class="text-plan">{!! html_entity_decode($blog1->noidung) !!}</span>
                            <h3>{{ $blog1->ngaydang }}</h3>
                        @endif
                        <button type="button" class="btn btn-danger"
                            style="margin-left: auto; margin-right: auto; display: block; background-color: white; color: #ff4367;">View
                            all
                            Post</button>
                    </div>
                    <div class="col-md-4 around text-center" data-aos="flip-right"
                        style="box-shadow: 5px 5px 5px #666;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        -moz-box-shadow: 5px 5px 5px #666;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        -webkit-box-shadow: 5px 5px 5px #666;">
                        <i class="fab fa-asymmetrik fa-4x icon" style="margin-top: 30px; color: #453be4;"></i> <br>
                        <b class="title">Premium</b>
                        @if (isset($blog2->deleted_at))
                        @else
                            <span class="text-plan">{!! html_entity_decode($blog2->noidung) !!}</span>
                            <h3>{{ $blog2->ngaydang }}</h3>
                        @endif
                        <button type="button" class="btn btn-danger"
                            style="margin-left: auto; margin-right: auto; display: block; background-color: #ff4367; color: white;">View
                            all
                            Post</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Find the Plan  -->

        <!-- Latest From the Blog  -->
        <section class="catelogy mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">Latest <br> From The Blogs</h1>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($blog3 as $blog)
                        @if (isset($blog->deleted_at))
                        @else
                            <div class="col-md-4" data-aos="flip-left">
                                <div class="card card-location" style="width: 100%;">
                                    <img class="card-img-top img-blog" src="{{ asset('blogs_anh/' . $blog->anh) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <a href="">
                                            <p class="card-text"
                                                style="color: #453be4; font-weight: bold;height: 60px;text-transform: uppercase;">
                                                {{ $blog->tieude }}
                                            </p>
                                        </a>
                                        <ul class="blog">
                                            <li>
                                                <i class="far fa-clock"></i>
                                                <small>{{ $blog->ngaydang }}</small>
                                            </li>
                                            <li>
                                                <i class="far fa-comment"></i>
                                                <small>{{ $blog->sobinhluan }} comments</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger"
                            style="width: 200px; margin-left: auto; margin-right: auto; display: block; margin-top: 50px; background-color: #ff4367;">View
                            all
                            Post</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Latest From the Blog -->

        <!-- Subscribe -->
        <section class="banner-4 mt-5 mb-5">
            <div class="container">
                <div class="row content-4">
                    <div class="col-md-5">
                        <h3><b>Subscribe For Update</b></h3>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group" style="width: 100%;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg" style="background-color: white;">
                                    <i class="far fa-envelope"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Small"
                                aria-describedby="inputGroup-sizing-lg" placeholder="Type Your Word"
                                style="border-left: none;">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger"
                            style="width: 100%; background-color: #ff4367;">Subscribe</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Subscribe -->
    </main>
@endsection
