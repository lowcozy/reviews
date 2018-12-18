 <!-- Header -->            
    <header id="header" class="header clearfix">
        <div class="container">
            <div class="row">                 
                <div class="col-lg-4">
                    <div id="logo" class="logo float-left">
                        <a href="{{ route('home') }}" rel="home">
                            <img src="{{ asset('images/logo.png') }}" alt="image">
                        </a>
                    </div><!-- /.logo -->
                    <div class="btn-menu">
                        <span></span>
                    </div><!-- //mobile menu button -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-8">
                    <div class="nav-wrap">                            
                        <nav id="mainnav" class="mainnav float-left">
                            <ul class="menu"> 
                                <li class="home">
                                    <a href="{{ route('home') }}">Trang chủ</a> 
                                </li>
                                <li><a href="{{ route('list-listing') }}">Bài đăng</a>
                                </li>
                                @if(Sentinel::guest())
                                        <li>
                                            <a data-toggle="modal" href="#popup_login"><i class="fa fa-user"></i> Đăng nhập</a> 
                                        </li>
                                        <li>
                                            <a data-toggle="modal" href="#popup_register"><i class="fa fa-user-plus"></i> Đăng ký</a> 
                                        </li>          
                                @else
                                        <li class="nav-item dropdown">

                                            <a href="{{ route('user.listing', ['id' => Sentinel::getUser()->id]) }}"><i class="fa fa-user"></i> {{ Sentinel::getUser()->last_name }}</a>
                                             <ul class="submenu"> 
                                                <li><a href="{{ route('user.listing', ['id' => Sentinel::getUser()->id]) }}">Bài đăng của bạn</a>
                                                </li>
                                                <li><a href="{{ route('user.edit',['id' => Sentinel::getUser()->id]) }}">Thông tin cá nhân</a>
                                                </li>
                                                <li><a href="{{ route('user.addListing') }}">Thêm bài đăng</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Đăng xuất') }}
                                                    </a>
                                                </li>
                                            </ul><!-- /.submenu -->
                                                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                                    @csrf
                                                </form>
                                
                                        </li>
                                @endif    
                                        
                            </ul><!-- /.menu -->
                        </nav><!-- /.mainnav -->  

                        <div class="button-addlist float-right">
                            <button type="button" class="flat-button" onclick="location.href='{{ route('user.addListing') }}'">Thêm bài đăng</button>
                         </div> 
                    </div><!-- /.nav-wrap -->
                </div><!-- /.col-lg-8 -->                                    
            </div><!-- /.row -->
        </div>
    </header><!-- /.header -->

   