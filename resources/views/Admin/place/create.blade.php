@extends('Admin.layouts.app')
@section('title', 'Thêm mới')

@section('header')
@include('Admin.includes.header', ['function' => 'Thêm mới'])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">room</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Thêm mới địa điểm</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form method="post" action="{{ route('admin.place.save') }}" 
                            class="form-horizontal" enctype="multipart/form-data">
                                @csrf 
                                <div class="card-content">
                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Tên</label>
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label>
                                                  <input 
                                                     class="form-control"
                                                     style="color:black;"
                                                     value="{{ old('name') }}" type="text" 
                                                     name="name" required>
                                                <span class="help-block">Text your name of place.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Thành Phố</label>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select class="form-control" id="city" onchange="getDistrict()" name="city">
                                                    <option value="0">Chọn Thành Phố</option>
                                                    @foreach ($cities as $city)
                                                     <option value="{{ $city->name }}"
                                                        {{ (old("city") == $city->name ? "selected":"") }}>
                                                        {{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('city'))
                                                        <p style="color: red">
                                                            <strong>{{ $errors->first('city') }}</strong>
                                                        </p> <br>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                 <select class="form-control" name="district" id="district">
                                                    <option value="">Chọn Huyện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Địa Chỉ</label>
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label>
                                                <input type="text" class="form-control" value>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Chọn Lớp Cha</label>
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label>
                                                <select class="form-control" name='category_id'>
                                                    <option value="-1">Chọn loại hình</option>
                                                    @foreach ($cats as $cat)
                                                    <optgroup label="{{ $cat->name }}">
                                                        @php
                                                            $subcats = $cat->children()->get();
                                                        @endphp

                                                        @foreach ($subcats as $subcat)
                                                        <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                                  @if ($errors->has('category_id'))
                                                        <p style="color: red">
                                                            <strong>{{ $errors->first('category_id') }}</strong>
                                                        </p> <br>
                                                  @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Mô tả</label>
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label>
                                                <textarea style="color:black;"
                                                    class="form-control" name="description" required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Điện Thoại</label>
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label>
                                                 <input  style="color:black;"
                                                    class="form-control"
                                                    value="{{ old('phone') }}"
                                                     type="text" name="phone" placeholder="Phone" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Website</label>
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label>
                                                 <input
                                                   class="form-control"
                                                   style="color:black;"   type="text" 
                                                   value="{{ old('website') }}"
                                                   name="website" placeholder="Website" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Giờ mở cửa</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control timepicker" value="14:00" />
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <label class="col-sm-2 label-on-left">Giờ đóng cửa</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control timepicker" value="15:00" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-2 label-on-left">Dịch vụ</label>
                                        <div class="col-sm-10">
                                           <!--  <div class="checkbox checkbox-inline">
                                                <label>
                                                    <input type="checkbox" name="optionsCheckboxes">aasdasd
                                                </label>
                                            </div> -->
                                            @foreach($services as $service)
                                                    <div class="checkbox checkbox-inline">
                                                        <label style="color:#555;">
                                                                <input type="checkbox" id="{{ $service->name }}" name="service[]"
                                                                value="{{ $service->id }}" 
                                                                >{{ $service->name }}
                                                        </label>
                                                    </div>
                                            @endforeach 
                                             @if ($errors->has('service'))
                                                        <br/>
                                                        <p style="color: red">
                                                            <strong>{{ $errors->first('service') }}</strong>
                                                        </p>
                                            @endif   <br/>
                                            
                                        </div>
                                    </div>



                                      <div class="row">
                                        <label class="col-sm-2 label-on-left">Ảnh</label>
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label> <br>
                                                <input type="file" name="image[]" id="image" multiple />
                                            </div>
                                                @if ($errors->has('image'))
                                                        <p style="color: red">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </p> <br>
                                                 @endif
                                             <div id="preview"></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="lng" id="lng">
                                <input type="hidden" name="lat" id="lat">
                                <button type="submit" class="btn btn-fill btn-rose">Lưu<div class="ripple-container"></div></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="card">
                            <div class="card-content">
                                <input id="pac-input" class="controls" type="text" placeholder="Tìm kiếm">
                                <div id="customSkinMap" class="map" onclick="getMap();"></div>
                            </div>
                             @if ($errors->has('lat'))
                                    <p style="color: red">
                                        <strong>{{ $errors->first('lat') }}</strong>
                                    </p>
                             @endif   <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<style>
    body {
      height: 100%;
    }
    
    #map {
        height: 100%;
    }
    #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
  </style>
<script type="text/javascript">
    $(document).ready(function() {
        //demo.initSmallGoogleMaps();
        initMap();
    });
</script>
<script>

      // The following example creates a marker in Stockholm, Sweden using a DROP
      // animation. Clicking on the marker will toggle the animation between a BOUNCE
      // animation and no animation.

var marker;

function initMap() {
    var map = new google.maps.Map(document.getElementById('customSkinMap'), {
        zoom: 13,
        center: {lat: 20.9996604, lng: 105.7806581}
    });

    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {lat: 20.9996604, lng: 105.7806581}
    });
    marker.addListener('click', toggleBounce);

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
        //console.log('this is' + map.getBounds().getCenter())
        
    });

    var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function(tmp_marker) {
            tmp_marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        //console.log('this is' + bounds.getCenter().lat());
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
                marker.setPosition(place.geometry.viewport.getCenter());
                getMap();
            } else {
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
                getMap();
            }
        });
        map.fitBounds(bounds);
    });
}

function toggleBounce() {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function getMap() {
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();
    $('#lat').val(lat);
    $('#lng').val(lng);
    console.log(lat+" ----"+lng);
}
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });
</script>

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

//preview image 
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
