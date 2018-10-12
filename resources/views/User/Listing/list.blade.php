@extends('Front_end.layouts.basic')
@section('content')
    <!-- Blog posts -->
    <section class="main-content page-listing-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="flat-select clearfix">
                        <div class="float-left width50 clearfix">
                            <div class="one-three showing">
                                <p><span>{{ $places->total() }}</span> Found Listings</p>
                            </div>
                            <form novalidate="" class="filter-form clearfix" id="filter-form" method="get" action="{{ route('list-listing') }}">

                            <div class="one-three more-filter">
                                <ul class="unstyled">
                                    <li class="current"><a href="#" class="title">Services 
                                        <i class="fa fa-angle-right"></i></a>
                                        <ul class="unstyled">

                                        <?php //kiem tra checked
                                            if(isset($_GET['getService']))
                                            {
                                                $getService = $_GET['getService'];
                                                $checked = explode(",",$getService);
                                            }
                                            else
                                            {
                                                $checked = [];
                                            }
                                         ?>

                                            @foreach($services as $service)
                                            <li class="en">
                                                <input type="checkbox" value="{{ $service->id }}" 
                                                id="{{ $service->name }}"
                                                @if(in_array($service->id, $checked))
                                                checked
                                                @endif
                                                >
                                                <label for="{{ $service->name }}">{{ $service->name }}</label>
                                            </li>
                                            @endforeach
                                        </ul>
                                     </li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                    <div class="listing-list">
                        @if($places->count()>0)
                        @foreach($places as $place)
                        <div class="flat-product clearfix">
                            <div class="featured-product">
                                <?php $path = 'uploads/place/'.$place->images()->first()->url; ?>
                                <img style="width: 290px; height: 182px;" src="{{ asset($path) }}" alt="image">
                                {!! OpenOrClose::open($place->open, $place->close) !!}
                            </div>
                            <div class="rate-product">
                                    <div class="link-review clearfix">
                                        <div class="button-product float-left">
                                            <button type="button" class="flat-button" onclick="location.href='#'">
                                                {{ $place->category()->get()->first()->name }}
                                            </button>
                                        </div>
                                        <div class="start-review">
                                            <span class="flat-start">
                                               {!! StarRating::rate(App\Models\Place::getRatePlace($place->id)) !!}
                                            </span>
                                            <a href="#" class="review">( {{ $place->countReview() }} reviewers )</a>
                                        </div>
                                    </div>
                                    <div class="info-product">
                                        <h6 class="title"><a href="{{ route('listing.detail', ['id' => $place->id]) }}">{{ $place->name }}</a></h6>
                                        <p>{{ $place->district }}, {{ $place->city }}</p>
                                        <a href="#" class="heart">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="blog-pagination style2 text-center">
                       
                       {{ $places->links() }}

                    </div><!-- /.blog-pagination -->                  
                </div><!-- /.col-lg-9 -->    
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class=" widget widget-form style2">
                            <h5 class="widget-title">
                                Search Box
                            </h5>
                            <!-- <form novalidate="" class="filter-form clearfix" id="filter-form" method="get" action="{{ route('listing.search') }}"> -->
                                <p class="book-notes">                                      
                                    <input
                                    style="color: black;"
                                     type="text" placeholder="Search by Name" name="name" required=""

                                    @if(isset($_GET['name']))
                                        value= {{ $_GET['name'] }} 
                                    @endif
                                    >
                                </p>
                                <p class="book-form-select icon">            
                                    <select name="category" class=" dropdown_sort">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if(isset($_GET['category']))
                                                    @if($category->id == $_GET['category'])
                                                    selected
                                                    @endif
                                                @endif

                                                >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </p> 
                               
                                <p class="location">Location <i class="ion-location float-right"></i></p>
                                <p id="distance" class="input-location form-filter">
                                    <span class="filter">
                                        <input id="ex8" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="10"
                                         name = "distance"
                                         data-slider-step="1" 
                                         @if(isset($_GET['distance']))
                                            data-slider-value= '{{ $_GET['distance'] }}'
                                         @else 
                                            data-slider-value="5"
                                         @endif
                                         />
                                    </span>
                                </p>


                                 <input id="getService" type="hidden" value="" name='getService' >  
                                  <input id="lat" type="hidden" value="" name='lat' > 
                                   <input id="lng" type="hidden" value="" name='lng' >  

                                <p class="form-submit text-center">
                                    <button type="submit" class="flat-button">Search <i class="ion-ios-search-strong"></i></button>
                                </p>
                            </form>
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
    <script src="{{ asset('javascript/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('javascript/gmap3.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUIc2-TTbn2IGJ4W0_0ePkv3xBvA_2sCM&region=GB"></script>
    <script src="{{ asset('javascript/jquery-countTo.js') }}"></script>  
    <script src="{{ asset('javascript/jquery.cookie.js') }}"></script>
    <script src="{{ asset('javascript/parallax.js') }}"></script>
    <script src="{{ asset('javascript/smoothscroll.js') }}"></script>   

    <script src="{{ asset('javascript/main.js') }}"></script>
@endsection


@section('js')
<!-- get Services đc checked -->
<script>
    $(':checkbox').change(function(){
           var arr = [];
            $('input:checkbox:checked').each(function() {
                arr.push($(this).val());
            });
            $('#getService').val(arr);
            console.log(arr);
    });
</script>

<!-- lay dia diem cua user -->
<script>
  $(document).ready(function(){
            //checked lai check box roi` dua vao` input getService
            var arr = [];
            $('input:checkbox:checked').each(function() {
                arr.push($(this).val());
            });
            $('#getService').val(arr);

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

