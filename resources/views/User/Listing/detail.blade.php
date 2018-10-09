@extends('Front_end.layouts.basic')

@section('content')
	<!-- Page title -->
    <div class="page-title style2">

          <div id="map" style="width: 100%; height: 350px;" ></div>
          <?php $lat = $place->lat;  $lng = $place->lng; ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">  
                    <div class="wrap-pagetitle">
                        <div class="flat-pagetitle">
                            <div class="page-title-heading">
                                <h1 style="color: black;" class="title">{{ $place->name }}</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumbs style2">
                                <ul>
                                    <li style="color: black;"><i class="ion-ios-location-outline"></i>{{ $place->district }} / {{ $place->city }}</li>
                                </ul>                   
                            </div><!-- /.breadcrumbs --> 
                        </div>            
                    </div>
                </div><!-- /.col-md-12 -->  
            </div><!-- /.row -->  
        </div><!-- /.container -->                      
    </div><!-- /.page-title --> 


    <!-- Blog posts -->
    <section class="main-content page-listing">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="listing-wrap">
                        <div class="tf-gallery">
                            <div id="tf-slider">
                                <ul class="slides">
                                     @foreach($images as $item)
                                        <li>
                                            <?php $path = 'uploads/place/'.$item->url; ?>
                                           <img style="max-width: 100%; max-height: 100%;" 
                                           src="{{ asset($path) }}" alt="image">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                                
                            <div id="tf-carousel">
                                <ul class="slides">
                                    @foreach($images as $item)
                                        <li>
                                            <?php $path = 'uploads/place/'.$item->url; ?>
                                           <img style="height: 140px;" 
                                           src="{{ asset($path) }}" alt="image">
                                        </li>
                                    @endforeach
                                                        
                                </ul>
                            </div>
                        </div><!-- /.tf-gallery -->
                        <div class="content-listing">
                            <div class="text">
                                <h3 class="title-listing">{{ $place->name }}</h3>
                                <ul class="rating-listing">
                                    <li>
                                        <div class="start-review">
                                <span class="flat-start">{!! StarRating::rate($star) !!}</span>
                                ( <span class="like">{{ $count_review }}</span>
                                <span class="like">reviewers )</span>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="social-links">
                                            <span>Views:</span>
                                          
                                            <span>{{ $place->count_views }}</span>
                                        </a>
                                    </li>   
                                    <li>
                                        <div class="social-links">
                                            <span>Share:</span>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </div>
                                    </li>       
                                </ul>
                                <p>{{ $place->description }}</p>
                            </div>
                            <h3 class="title-listing">Service</h3>
                            <div class="wrap-list clearfix">
                                <ul class="list float-left">
                                    @foreach($services as $service)
                                    <li><span><i class="fa fa-check"></i></span>{{ $service->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                             
                             <p class="form-submit">                 
                                    <button onclick="addReview()" type="button" class="button"
                                    >Add Review</button>
                             </p><br>
                                 
                            <div class="list-comment">
                                <h3 class="title-listing">{{ $count_comment }} Comments</h3>
                                <div class="comments-area">
                                    <ol id='comments' class="comment-list">

                                    @if(count($users)>0)
                                    @foreach($users as $user)
                                        <li class="comment">
                                            <article class="comment-body clearfix">        
                                                <div class="comment-author">
                                                @if($user->avatar == null)
                                                    <img style="width: 84px; height: 84px;" 
                                                    src="{{ asset('images/services/noavatar.png') }}" alt="image">  
                                                @else 
                                                     <img style="width: 84px; height: 84px;" 
                                                     <?php $path='uploads/avatar/'.$user->avatar ?>
                                                    src="{{ asset($path) }}" alt="image"> 
                                                @endif
                                                </div><!-- .comment-author -->
                                                <div class="comment-text">
                                                    <div class="comment-metadata">
                                                        <h5><a href="#">{{ $user->first_name }} {{ $user-> last_name }}</a></h5>  
                                                        <p class="day">{!! Time::diff($user->created_at) !!}</p> 
                                                        <div class="flat-start">
                                                           
                                                           {!! StarRating::rate($user->rate) !!}
                                                        </div>             
                                                    </div><!-- .comment-metadata -->
                                                    <div class="comment-content">
                                                        <p>{{ $user->content }}</p>
                                                    </div><!-- .comment-content -->
                                                </div><!-- /.comment-text --> 
                                                <br>

                                                    <!-- Hien thi anh? cua? cmt -->
                                                    <?php $imageComments = $user->images()->get() ?>
                                                    @if(count($imageComments) > 0)
                                                     <div class="row" id="profile-grid">
                                                      @foreach($imageComments as $image)
                                                          <?php $path="../uploads/comment/".$image->url ?>
                                                         <div class="col-sm-4 col-xs-12">
                                                            <div class="panel panel-default">
                                                              <div class="panel-thumbnail">
                                                                <a href="#" title="image 1" class="thumb">
                                                                  <img  src="{{ $path }}" class="img-responsive img-rounded" data-toggle="modal" data-target=".modal-profile-lg">
                                                                </a>
                                                              </div>
                                                            </div>
                                                        </div>
                                                      @endforeach
                                                    </div>
                                                    @endif        
                                            </article><!-- .comment-body -->
                                        </li><!-- #comment-## -->
                                      <hr>
                                    @endforeach
                                    @endif
                                        
                                                                           
                                    </ol><!-- .comment-list -->
                            @if(count($users)>0)
                            <div id="remove-row">
                            <button id="btn-more" data-id='{{ $user->comment_id }}' class="nounderline btn-block mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"> Load More </button>
                            </div>
                            @endif
                            <br>
                                
                                </div><!-- /.comments-area -->
                            </div>

                        </div>
                    </div><!-- /.listing-wrap -->                   
                </div><!-- /.col-lg-9 -->    
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget_listing">
                            <h5 class="widget-title">Top Rating Listing</h5>
                            <ul>
                              @if(count($topRate)>0)
                                @foreach($topRate as $placee)
                                <li>
                                    <div class="featured">
                                      <?php $path = 'uploads/place/'.$placee->images()->get()->first()->url ?>
                                        <a href="{{ route('listing.detail', ['id' => $placee->id]) }}" class="effect"><img
                                          style="height: 60px;"
                                         src="{{ asset($path) }}" alt="image"></a>
                                    </div>
                                    <div class="info-listing">
                                        <h6><a 
                                          href="{{ route('listing.detail', ['id' => $placee->id]) }}">{{ $placee->name }}</a></h6>
                                        <div class="start-review">
                                            <span class="flat-start">
                                                 <?php if($placee->total_rate == null) $placee->total_rate = 0.0 ?>
                                                 {!! StarRating::rate($placee->total_rate) !!}
                                            </span>
                                            
                                              @if($placee->countReview() <= 1)
                                             <a href="#" class="review"> {{ $placee->countReview() }} Review</a>
                                             @else 
                                             <a href="#" class="review"> {{ $placee->countReview() }} Reviews</a>
                                             @endif
                                        </div>
                                    </div>
                                </li>
                                  @endforeach
                                @endif
                            </ul>
                        </div>
                        
                        <div class="widget widget-contact">
                            <h5 class="widget-title">Contact Us</h5>
                            <ul>
                               <li class="adress">{{ $place->district }}, {{ $place->city }}</li>
                               <li class="phone">{{ $place->phone }}</li>
                               <li class="email">{{ $place->email }}</li>
                               <li class="time">
                                   <span>Open</span>  {!! Time::timer($place->open) !!}<br>
                                   <span>Close</span> {!! Time::timer($place->close) !!}<br>
                               </li>
                           </ul> 
                        </div>       
                    </div><!-- /.sidebar -->
                </div><!-- /.col-md-3 -->            
            </div><!-- /.row -->           
        </div><!-- /.container -->   
    </section> 
@endsection

@section('js_lib')
     <!-- Javascript -->
    <script src="{{ asset('javascript/jquery.min.js') }}"></script>
    <script src="{{ asset('javascript/tether.min.js') }}"></script>
    <script src="{{ asset('javascript/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('javascript/jquery.easing.js') }}"></script>    
    <script src="{{ asset('javascript/jquery-waypoints.js') }}"></script> 
    <script src="{{ asset('javascript/jquery-countTo.js') }}"></script>  
    <script src="{{ asset('javascript/gmap3.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNHxKOU7potiYY9ayE1rkAwwR6xlBtxFA&region=GB&callback=initMap"></script>
    <script src="{{ asset('javascript/jquery.cookie.js') }}"></script>
     <script src="{{ asset('javascript/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('javascript/bootstrap-datetimepicker.fr.js') }}"></script>
    <script  src="{{ asset('javascript/jquery.flexslider-min.js') }}"></script>

    <script src="{{ asset('javascript/parallax.js') }}"></script>
    <script src="{{ asset('javascript/smoothscroll.js') }}"></script>   

    <script src="{{ asset('javascript/main.js') }}"></script>
@endsection


@section('js')
<!-- Hien thi map dia diem -->
 <script>
              var map;
              var myLatLng = {lat: <?php echo $lat ?> , lng: <?php echo $lng ?>};
              function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                  center: myLatLng,
                  zoom: 13,
                  mapTypeId: 'roadmap'
                });

                 var marker = new google.maps.Marker({
                          position: myLatLng,
                          map: map,
                         
                });
              }
</script>

<!-- Event  star rating -->

<script>
     $(".my-rating-9").starRating({
    initialRating: 0,
    disableAfterRate: false,
    ratedColor: 'orange',
    onHover: function(currentIndex, currentRating, $el){
      //console.log('index: ', currentIndex, 'currentRating: ', currentRating, ' DOM element ', $el);
      $('.live-rating').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      //console.log('index: ', currentIndex, 'currentRating: ', currentRating, ' DOM element ', $el);
      $('.live-rating').text(currentRating);
      $('#rate').val(currentRating);
      console.log($('#rate').val());
    }
  });
</script>


<!-- check login chưa nếu chưa có popup Form Login, có rồi show Modal review -->
<script type="text/javascript">
    function addReview()
    {
         $.ajax({
            url : '{{ route('checkLoginAjax') }}', 
            type : 'get', 
            dataType : 'json',
            success : function(data)
            {
               $("#errorRate").hide();
               $("#errorComment").hide();

               if(data.message == "success")
               {
                    $('#modalReview').modal('show');
               }
               else
               {
                    $('#popup_login').modal('show');
               }
            }
        });
    }
</script>
    
<!-- Modal addReview --><script>
 function review()
   {
        var rate = $('#rate').val();
        var comment = $('#comment').val();
        var place_id = <?php echo $place->id ?>;
        $('#errorComment').hide();
        $('#errorRate').hide();

        if(comment == "")
        {
           $('#errorComment').show();
        }
        else
        {
            if(rate == '')
            {
                $('#errorRate').show();
            }
            else
            {
                 $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });

                    var form_data = new FormData();
                    var ins = document.getElementById('multiFiles').files.length;
                    if(ins > 0)
                    {
                       for (var x = 0; x < ins; x++) {
                            form_data.append("files[]", document.getElementById('multiFiles').files[x]);
                        }
                    }
                   
                       form_data.append('rate', rate);
                       form_data.append('place_id', place_id);
                       form_data.append('_token', "{{ csrf_token() }}");
                       form_data.append('comment', comment);

                   

                 $.ajax({
                   contentType: false,
                   processData: false,
                   type :'POST',
                   url:'{{ route('addReview') }}',
                   data:form_data,
                   cache: false,
                    success:function(data){
                    console.log(data);
                    $('#modalReview').modal('toggle');
                    location.reload(true);
                        
                   },
                        error: function (xhr, textStatus, errorThrown) {

                      console.log('PUT error.');
                    }
                });
            }
        }
   }
</script>

<!-- Load More comment -->
<script>
   $(document).on('click','#btn-more',function(){
       var id = $(this).data('id');
       var place_id = <?php echo $place->id; ?>;
       
       $("#btn-more").html("Loading....");
       $.ajax({
           url : '{{ route("loadMore") }}',
           method : "POST",
           data : {id:id,
                   place_id : place_id ,
                    _token:"{{csrf_token()}}"},
           dataType : "text",
           success : function (data)
           {
              if(data != '') 
              {
                  $('#remove-row').remove();
                  $('#comments').append(data);
              }
              else
              {
                  $('#btn-more').html("No more comment");
              }
           }
       });
   });  
</script>

<!-- Preview Image -->
<script>
     function previewImages() {

              var $preview = $('#preview').empty();
              if (this.files) $.each(this.files, readAndPreview);

              function readAndPreview(i, file) {
                
                // if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                //   return alert(file.name +" is not an image");
                // } 
                
                var reader = new FileReader();

                $(reader).on("load", function() {
                  $preview.append($("<img/>", {src:this.result, height:200}));
                });

                reader.readAsDataURL(file);
                
              }

            }

            $('#multiFiles').on("change", previewImages);
 </script>

 <script>
  // Preview Image phan` Comments
    $(document).on('click','a.thumb',function(event){
        event.preventDefault();
        var content = $('.modal-bodyy');
        content.empty();
        var title = $(this).attr("title");
        $('.modal-title').html(title);        
        content.html($(this).html());
        $(".modal-profile").modal({show:true});
    });
    // Preview Image phan` Comments
 </script>
@endsection

@section('modal')

@endsection
