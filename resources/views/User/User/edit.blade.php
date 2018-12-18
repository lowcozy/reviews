 @extends('Front_end.layouts.basic')
 @section('content')
 <!-- Page title -->
    <div class="page-title parallax parallax1">
        <div class="section-overlay">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="page-title-heading">
                        <h1 class="title">{{ $user->first_name }}{{ $user->last_name }}</h1>
                    </div><!-- /.page-title-captions -->
                    <div class="breadcrumbs">
                        <ul>
                            
                        </ul>                   
                    </div><!-- /.breadcrumbs -->   
                </div><!-- /.col-md-12 -->  
            </div><!-- /.row -->  
        </div><!-- /.container -->                      
    </div><!-- /.page-title -->

    <section class="flat-row page-profile bg-theme">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="flat-user profile">
                        <a href="{{ route('user.listing', ['id'=>$user->id]) }}" class="edit" title="">Quay lại bài đăng <i class="fa fa-backward"></i></a>
                        <ul class="info">
                            <li><a title=""><i class="fa fa-user"></i>Thông tin cá nhân</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="flat-tabs style2" data-effect="fadeIn">
                    <div class="content-tab listing-user profile">
                        <div class="content-inner active">
                            <div class="basic-info">
                                <h5>Thông tin</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        
                                        <div class="upload-img">
                                            @if($user->avatar == null)
                                                <img style="width: 250px; height: 240px;" id='avatar' src= {{ asset('images/services/noavatar.png') }}>
                                            @else
                                                <?php $path = 'uploads/avatar/'.$user->avatar ?> 
                                                <img style="width: 250px; height: 240px;" id='avatar' src= {{ asset($path) }} >
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <form  method="post" action="{{ route('user.update', ['id' => $user->id]) }}" class="form-profile" enctype="multipart/form-data">
                                            @csrf
                                            <p class="input-info">
                                                <label>Your First Name*</label>
                                                <input type="text" name="first_name" id="name" 
                                                 value="{{ old('first_name', $user->first_name) }}" 
                                                required>
                                            </p>
                                            
                                             <p class="input-info">
                                                <label>Your Last Name*</label>
                                                <input type="text" name="last_name" id="name" 
                                                 value="{{ old('last_name', $user->last_name) }}" 
                                                required >
                                            </p>

                                            <p class="input-info">
                                                <label>Thay ảnh đại diện*</label>
                                                <input type="file" name="avatar" id="uploadImg">
                                            </p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="on-web">
                                <div class="row">
                                    <div class="col-md-8">
                                        <ul class="add-section">
                                            <li class="face"><i class="fa fa-facebook-square face"></i><span>Facebook</span><a href="https://www.facebook.com/" title="">{{ $user->email }}</a><i class="fa fa-minus-circle float-right"></i></li>
                                        </ul>

                                        <p class="input-info">
                                                <label>Thay đổi email (nếu muốn)*</label>
                                                <input type="email" name="email" id="name">
                                            </p>
                                    </div>
                                </div>
                            </div>
                            <div class="update-button text-center">
                                <button type="submit" class="flat-button">Cập nhật</button>
                            </form>
                            </div>
                        </div>
                    </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_lib')
    <script src="{{ asset('javascript/jquery.min.js') }}"></script>
    <script src="{{ asset('javascript/tether.min.js') }}"></script>
    <script src="{{ asset('javascript/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('javascript/jquery.easing.js') }}"></script>    
    <script src="{{ asset('javascript/jquery-waypoints.js') }}"></script>  
    <script src="{{ asset('javascript/jquery.cookie.js') }}"></script>
    <script src="{{ asset('javascript/parallax.js') }}"></script>
    <script src="{{ asset('javascript/smoothscroll.js') }}"></script>  
    <script src="{{ asset('javascript/main.js') }}"></script>
@endsection

@section('js')
<!-- Priview hinh` anh avatar -->
    <script>
        function readURL(input) {

          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#uploadImg").change(function() {
          readURL(this);
        });
    </script>
@endsection