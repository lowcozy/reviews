@extends('Front_end.layouts.home')

@section('content')

 <section class="flat-row section-client">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-section text-center">
                        <h1 class="title">Danh mục</h1>
                        <div class="sub-title">

                            Bạn muốn tìm ?
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="flat-client" data-item="4" data-nav="true" data-dots="false" data-auto="false">
            
                        <div class="client">
                            <div class="featured-client">
                                <img src="images/clients/3.jpg" alt="image">
                            </div>
                            <div class="content-client clearfix">
                                <div class="icon">
                                    <img src="images/clients/icon1.png" alt="image">
                                </div>
                                <div class="text">
                                    <h6><a href="#" title="">Hotel & Travel</a></h6>
                                    <p>45 Bài đăng</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="client">
                            <div class="featured-client">
                                <img src="images/clients/9.jpg" alt="image">
                            </div>
                            <div class="content-client clearfix">
                                <div class="icon">
                                    <img src="images/clients/icon2.png" alt="image">
                                </div>
                                <div class="text">
                                    <h6><a href="#" title="">Healthy & fitness</a></h6>
                                    <p>45 Listing</p>
                                </div>
                            </div>
                        </div>
                        <div class="client">
                            <div class="featured-client">
                                <img src="images/clients/7.jpg" alt="image">
                            </div>
                            <div class="content-client clearfix">
                                <div class="icon">
                                    <img src="images/clients/icon3.png" alt="image">
                                </div>
                                <div class="text">
                                    <h6><a href="#" title="">Real Estate</a></h6>
                                    <p>45 Listing</p>
                                </div>
                            </div>
                        </div>
                        <div class="client">
                            <div class="featured-client">
                                <img src="images/clients/5.jpg" alt="image">
                            </div>
                            <div class="content-client clearfix">
                                <div class="icon">
                                    <img src="images/clients/icon4.png" alt="image">
                                </div>
                                <div class="text">
                                    <h6><a href="#" title="">Restaurant</a></h6>
                                    <p>45 Listing</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.flat-client -->  
                </div>
            </div>
        </div>
    </section>

    <section class="flat-row section-product bg-theme">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-section text-center">
                        <h1 class="title">Địa điểm</h1>
                        <div class="sub-title">
                            Địa điểm tuyệt vời bạn không nên bỏ lỡ
                        </div>
                        
                    </div>
                </div>
            </div>
<div class="row">
    <div class="col-lg-12">
                    <div class="row">
                    @foreach($places as $item)
                        <div class="col-lg-4 col-sm-6">
                            <div class="flat-product">
                                <div class="featured-product">
                                    <img style=" width: 360px; height: 237px;"
                                    <?php
                                     $path = $item->images()->get()->first()->url;
                                     $url ='/uploads/place/'.$path ?>
                                    src="{{ asset($url) }}" 
                                    alt="image">
                                       {!! OpenOrClose::open($item->open, $item->close) !!}
                                    <div class="rate-product">
                                        <div class="link-review clearfix">
                                            <div class="button-product float-left">
                                                <button type="button" class="flat-button">
                                                    {{ $item->category()->get()->first()->name }}
                                                </button>
                                            </div>
                                            <div class="start-review float-right">
                                                <span class="flat-start">
                                                    {!! StarRating::rate(App\Models\Place::getRatePlace($item->id)) !!}
                                                </span>
                                                <a href="#" class="review">( {{ \App\Models\Rate::where('place_id', $item->id)->count() }} bình luận )</a>
                                            </div>
                                        </div>
                                        <div class="info-product">
                                            <h6 class="title">
                                                <a href="{{ route('listing.detail', ['id' => $item->id]) }}">
                                                {{ $item->name }}
                                            </a></h6>
                                            <p>{{ $item->district }} , {{ $item->city }}</p>
                                            <a href="#" class="heart">
                                                <i class="ion-android-favorite-outline"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-product">
                                    <div class="tm">
                                        TM
                                    </div>
                                    <div class="text" style="height: 40px;">
                                        <p>{{ $item->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="blog-pagination style2 text-center">
                       {{ $places->links() }}
                    </div><!-- /.blog-pagination -->                  
                </div>      
</div>  
            
        </div>
    </section>

    <section class="flat-row v1 bg-theme">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title-section">
                        <h1 class="title"></h1>
                        <div class="sub-title">
                            Đăng ký ngay và nhận bản tin hàng tuần với
                        </div>
                    </div>
                    <form id="subscribe-form" class="flat-mailchimp" method="post" action=" " data-mailchimp="true">
                        <div class="field clearfix" id="subscribe-content"> 
                            <p class="wrap-input-email">
                                <input type="text" tabindex="2" id="subscribe-email" name="subscribe-email" placeholder="Nhập email của bạn">
                            </p>
                            <p class="wrap-btn">
                                <button type="button" id="subscribe-button" class=" subscribe-submit effect-button" title="Subscribe now">Theo dõi</button>
                            </p>
                        </div>
                        <div id="subscribe-msg"></div>
                    </form>
                </div>
                <div class="col-lg-2">
                    <div class="flat-counter text-center">                            
                        <div class="content-counter">
                            <div class="icon-count">
                                <i class="ion-waterdrop"></i>
                            </div>
                            <div class="name-count">Bài đăng</div>
                            <div class="numb-count" data-to="{{ $places->total() }}" data-speed="2000" data-waypoint-active="yes">{{ $places->total() }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="flat-counter text-center">                            
                        <div class="content-counter">
                            <div class="icon-count">
                                <i class="ion-pricetags"></i>
                            </div>
                            <div class="name-count">Danh mục</div>
                            <div class="numb-count" data-to="{{ App\Models\Category::getParrent(0)->count() }}" data-speed="2000" data-waypoint-active="yes">
                                {{ App\Models\Category::getParrent(0)->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="flat-counter text-center">                            
                        <div class="content-counter">
                            <div class="icon-count">
                                <i class="ion-ios-people"></i>
                            </div>
                            <div class="name-count">Người dùng</div>
                            <div class="numb-count" data-to="{{ App\User::all()->count() }}" data-speed="2000" data-waypoint-active="yes">
                                {{ App\User::all()->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>  
    <!-- End Section -->
@endsection

@section('js')
<script>
    $('.text').matchHeight({ property: 'height' });
</script>

<script>
  $(document).ready(function(){
        //lay dia diem ng dung`
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } 
    function showPosition(position) {
       $('#lat').val(position.coords.latitude);
       $('#lng').val(position.coords.longitude);
}
});
</script>
@endsection