        <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="/assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    CT
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Reviews
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="/assets/img/faces/avatar.jpg" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>
                                {{ $username }}
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#">
                                        <span class="sidebar-mini"> MP </span>
                                        <span class="sidebar-normal"> My Profile </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="sidebar-mini"> EP </span>
                                        <span class="sidebar-normal"> Edit Profile </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="sidebar-mini"> S </span>
                                        <span class="sidebar-normal"> Settings </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                     <li{{ strpos(Route::currentRouteName(), 'place') ? ' class=active' : '' }}>
                        <a data-toggle="collapse" href="#place">
                            <i class="material-icons">image</i>
                            <p> Địa điểm
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="place">
                            <ul class="nav">
                                <li{{ (Route::is('admin.place.create')) ? ' class=active' : '' }}>
                                    <a href="{{ route('admin.place.create') }}">
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> Tạo mới </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li{{ strpos(Route::currentRouteName(), 'user') ? ' class=active' : '' }}>
                        <a data-toggle="collapse" href="#place">
                             <i class="material-icons">account_box</i>
                            <p> Quản lý tài khoản
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="place">
                            <ul class="nav">
                                <li {{ (Route::is('admin.user.list')) ? ' class=active' : '' }}>
                                    <a href="{{ route('admin.user.list') }}">
                                        <span class="sidebar-mini"> List </span>
                                        <span class="sidebar-normal"> Danh sách </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li{{ strpos(Route::currentRouteName(), 'category') ? ' class=active' : '' }}>
                        <a data-toggle="collapse" href="#category">
                            <i class="material-icons">image</i>
                            <p> Category
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="category">
                            <ul class="nav">
                                <li{{ (Route::is('admin.category.create')) ? ' class=active' : '' }}>
                                    <a href="{{ route('admin.category.create') }}">
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> Tạo mới </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>