@extends('Front_end.layouts.basic')

@section('header_title')
	 <!-- Page title -->
    <div class="page-title parallax parallax1">
        <div class="section-overlay">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="page-title-heading">
                        <h1 class="title">Add Listing</h1>
                    </div><!-- /.page-title-captions -->
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li> - </li>                         
                            <li><a href="index.html">Page</a></li>
                            <li> - </li>                         
                            <li>Add Listing</li>
                        </ul>                   
                    </div><!-- /.breadcrumbs -->   
                </div><!-- /.col-md-12 -->  
            </div><!-- /.row -->  
        </div><!-- /.container -->                      
    </div><!-- /.page-title -->
@endsection


@section('content')
	<section class="flat-row page-addlisting">
        <div class="container">
        	<form method="POST" action="{{ route('user.storeListing') }}" 
            enctype="multipart/form-data">
        	@csrf 
            <div class="add-filter">
                <div class="row">
                    <div class="col-lg-2">
                        <h5 class="title-list">Infor Listing</h5>
                    </div>
                    <div class="col-lg-10 widget-form">
                        <div class="filter-form form-addlist">
                            <p class="input-info">
                                <label class="nhan">Image*</label>
                                <br>
                                <input type="file" name="image[]" id="image" multiple />
                            </p>
                                <div id="preview"></div>
           
                            <br>
                            
                             @if ($errors->has('image'))
                                    <p style="color: red">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </p> <br>
                             @endif

                            <p class="input-info">
                                <label
                                style="color:black;"
                                 class="nhan">Name*</label>
                                <input value="{{ old('name') }}" type="text" name="name" id="title" required >
                            </p>
                            <p class="input-info">
                                <label class="nhan">Description*</label>
                                <textarea  style="color:black;"
                                class="" tabindex="4" name="description" required>{{ old('description') }}</textarea>
                            </p>

                            <p class="input-info">
                                	<label class="nhan">Phone*</label>
                                    <input  style="color:black;"
                                    value="{{ old('phone') }}"
                                     type="text" name="phone" placeholder="Phone" required>
                            </p>

                            <p class="input-info">
                                	<label class="nhan">Website*</label>
                                    <input
                                       style="color:black;"   type="text" value="{{ old('website') }}"
                                     name="website" placeholder="Website" required>
                            </p>

                            <p class="input-info icon">
                                <label class="nhan">Categories*</label>
                                <select  style="color:black;"  name="category_id" class=" dropdown_sort">
                                <option value="0">Select Categories</option>		
    							@foreach($parent as $item)
  								<optgroup label="{{ $item->name }}">
  									<?php $childs = App\Models\Category::getParrent($item->id) ?> 
  									@foreach($childs as $child)
  										<option value="{{ $child->id }}" 
  											{{ (old("category_id") == $child->id ? "selected":"") }}
  										>{{ $child->name }}</option>
  									@endforeach
  								</optgroup>
  								@endforeach
                                </select>
                                <i class="fa fa-angle-down"></i>
                            </p>

                          
                            @if ($errors->has('category_id'))
                                    <p style="color: red">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </p> <br>
                            @endif
                            

                             <p class="input-info icon">
                                <label class="nhan">City*</label>
                                 <select  style="color:black;" class="dropdown_sort" name="city" id="city" onchange="getDistrict()">
                                                    <option value="0">Select City</option>
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city->name }}"

                                                 {{ (old("city") == $city->name ? "selected":"") }}

                                                    >{{ $city->name }}</option>
                                                    @endforeach
                                 </select>
                                <i class="fa fa-angle-down"></i>
                            </p>

                            @if ($errors->has('city'))
                                    <p style="color: red">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </p> <br>
                            @endif
                            

                             <p class="input-info icon">
                                <label class="nhan">District*</label>
                                <select  style="color:black;" name="district" id="district" class=" dropdown_sort">
                                    <option value="">Select District</option>
                                </select>
                                <i class="fa fa-angle-down"></i>
                            </p>
                       </div>

                        <div class="more-filter">
                            <label class="nhan">Service*</label>
                            <div class="row">
                            	@foreach($services as $service)
                            		<div class="col-md-3">
	                                    <div class="flat-check">
	                                        <input type="checkbox" id="{{ $service->name }}" name="service[]"
	                                        value="{{ $service->id }}" 
	                                        >
	                                        <label for="{{ $service->name }}">{{ $service->name }}</label>
	                                    </div>
                                	</div>
                            	@endforeach 

                            	
                            
                        </div>   
                        @if ($errors->has('service'))
                                    <p style="color: red">
                                        <strong>{{ $errors->first('service') }}</strong>
                                    </p>
                        @endif   <br>

                    </div>
                </div>
            </div>
            <div class="info-contact">
                <div class="row">
                    <div class="col-lg-2">
                        
                    </div>
                    <div class="col-lg-10 profile">
                        <div class="open-hour">
                            <label class="nhan">Open Hours*</label>
                            <ul class="list-hour">
                                <li class="clearfix">
                                    <div class="day">Open</div>
                                    
	                                    <select style="width: 10%;" name="open_h" class=" dropdown_sort">
	                                    <?php $count = 24; 
	                                    for ($i=1; $i <= $count ; $i++) { ?>
	                                    	<option value="{{ $i }}">{{ $i }}</option>
	                                    <?php } ?>
		                      
	                                	</select>
	                                	Hour
	                                   <select style="width: 10%;" name="open_m" class=" dropdown_sort">
		                                    <?php $count = 60; 
	                                    for ($i=0; $i < $count ; $i++) { ?>
	                                    	@if($i <= 9)
	                                    	<option value="0{{ $i }}">0{{ $i }}</option>
	                                    	@else
	                                    	<option value="{{ $i }}">{{ $i }}</option>
	                                    	@endif
	                                    <?php } ?>
	                                	</select>
	                                	Min
                                </li>

                                <li class="clearfix">
                                    <div class="day">Close</div>
                                    
	                                    <select style="width: 10%;" name="close_h" class=" dropdown_sort">
	                                    <?php $count = 24; 
	                                    for ($i=1; $i <= $count ; $i++) { ?>
	                                    	<option value="{{ $i }}">{{ $i }}</option>
	                                    <?php } ?>
		                      
	                                	</select>
	                                	Hour
	                                   <select style="width: 10%;" name="close_m" class=" dropdown_sort">
		                                    <?php $count = 60; 
	                                    for ($i=0; $i < $count ; $i++) { ?>
	                                    	@if($i <= 9)
	                                    	<option value="0{{ $i }}">0{{ $i }}</option>
	                                    	@else
	                                    	<option value="{{ $i }}">{{ $i }}</option>
	                                    	@endif
	                                    <?php } ?>
	                                	</select>
	                                	Min
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row">
                	<input id="pac-input" style="color: white; background-color: black; width: 30%;" class="controls" type="text" placeholder="Search Box">
				    <div id="map" style="width: 100%; height:850px;"></div>
				    <script>

				      function initAutocomplete() {
				        var map = new google.maps.Map(document.getElementById('map'), {
				          center: {lat: 21.0278, lng: 105.8342},
				          zoom: 13,
				          mapTypeId: 'roadmap'
				        });

				        // Create the search box and link it to the UI element.
				        var input = document.getElementById('pac-input');
				        var searchBox = new google.maps.places.SearchBox(input);
				        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

				        // Bias the SearchBox results towards current map's viewport.
				        map.addListener('bounds_changed', function() {
				          searchBox.setBounds(map.getBounds());
				        });

				        var marker;
				        // Listen for the event fired when the user selects a prediction and retrieve
				        // more details for that place.
				        searchBox.addListener('places_changed', function() {
				          var places = searchBox.getPlaces();

				          if (places.length == 0) {
				            return;
				          }

				            if(typeof marker !== "undefined")
				            {
				              marker.setMap(null);
				              marker = null;
				            }

				          // For each place, get the icon, name and location.
				          var bounds = new google.maps.LatLngBounds();
				          places.forEach(function(place) {
				            if (!place.geometry) {
				              console.log("Returned place contains no geometry");
				              return;
				            }
				            // Create a new marker
				            marker = new google.maps.Marker({
				              map: map,
				              title: place.name,
				              position: place.geometry.location
				            });

				               //lay gia tri lat lng tu marker
				       
				              $('#lat-input').val(marker.getPosition().lat());
				              $('#lng-input').val(marker.getPosition().lng());

				            if (place.geometry.viewport) {
				              // Only geocodes have viewport.
				              bounds.union(place.geometry.viewport);
				            } else {
				              bounds.extend(place.geometry.location);
				            }
				          });
				          map.fitBounds(bounds);
				        });

				        map.addListener('click', function(event) {
				         
				         if(typeof marker !== "undefined")
				            {
				              marker.setMap(null);
				              marker = null;
				            }

				          marker = new google.maps.Marker({
				            position: event.latLng,
				            map: map
				          });

				          $('#lat-input').val(event.latLng.lat());
				          $('#lng-input').val(event.latLng.lng());

				        });


				      }

				    </script>
				    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA56R0C2n_rs_oJajhK1s_iGffr3zPjjo8&libraries=places&callback=initAutocomplete"
				         async defer></script>
				                </div>
            </div>
            		 @if ($errors->has('lat'))
                                    <p style="color: red">
                                        <strong>{{ $errors->first('lat') }}</strong>
                                    </p>
                     @endif   <br>
            		<input type="hidden" id="lat-input" name='lat'>
            		<input type="hidden" id="lng-input" name='lng'>

            		<button type="submit" class="flat-button">Add Listing</button>
    		</form>
        </div>
    </section>  
@endsection

@section('js')
    <!-- lay cac tinh thanh tu` city thanh pho -->
	<script>
    function getDistrict(){
        var city = $('#city').val();
        //alert(city)
        $('#pac-input').val(city);
        $.ajax({
           type :'POST',
           url:'{{ route('getDistrict') }}',
           data:
           { 'city': $('#city').val() , '_token' : "{{ csrf_token() }}"},
           success:function(data){
                var options = "";
                for (var i = 0; i < data.array.length; i++) {
                    options += "<option value='"+ data.array[i] +
                    "' {{ (old('district') == "+ data.array[i] +" ? 'selected': '') }}>" + data.array[i] + "</option>";
                }
                $("#district").html(options);
           },
           error: function (xhr, textStatus, errorThrown) {

              console.log('PUT error.');
            }
        });
     }
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

            $('#image').on("change", previewImages);
 </script>
@endsection

@section('js_lib')
     <!-- Javascript -->
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
    <script src="{{ asset('javascript/jquery.min.js') }}"></script>
    <script src="{{ asset('javascript/tether.min.js') }}"></script>
    <script src="{{ asset('javascript/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('javascript/jquery.easing.js') }}"></script>    
    <script src="{{ asset('javascript/jquery-waypoints.js') }}"></script> 
    <script src="{{ asset('javascript/jquery-countTo.js') }}"></script>  
    <script src="{{ asset('javascript/owl.carousel.js') }}"></script>
    <script src="{{ asset('javascript/jquery.cookie.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js') }}"></script>
    <script src="{{ asset('javascript/parallax.js') }}"></script>
    <script src="{{ asset('javascript/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('javascript/smoothscroll.js') }}"></script>   

    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script src="{{ asset('revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('revolution/js/slider.js') }}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->    
    <script src="{{ asset('revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
@endsection