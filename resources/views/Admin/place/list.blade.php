@extends('Admin.layouts.app')
@section('title', 'Danh sách địa điểm')
@section('header')
@include('Admin.includes.header', ['function' => 'Danh sách Địa điểm'])
@endsection

@section('content')
<div class="col-md-12">
                           
                            </div>
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">assignment</i>
                                </div>

                                <div class="card-content">
                                    <h4 class="card-title">List Places</h4>
                                    
                                                 @if (session('update'))
                                                    <div class="alert alert-success">
                                                        {{ session('update') }}
                                                    </div>
                                                 @endif

                                                 @if (session('delete'))
                                                    <div class="alert alert-success">
                                                        {{ session('update') }}
                                                    </div>
                                                 @endif
                                                 
                                                <div class='row'>
                                                    <label class="col-sm-2 label-on-left">Number of rows: </label>
                                                    <div class="col-sm-7">
	                                                    <select
	                                                    id = "limit"
	                                                     data-style="select-with-transition" title="Numbers result" data-size="7">
	                                                        
	                                                        <option value="1" selected="">1</option>
	                                                        <option value="2">2</option>
	                                                        <option value="3">3</option>
	                                                    </select>
                                                	</div>
                                                </div>
                                                <br>
                                                 <div class='row'>
                                                    <label class="col-sm-2 label-on-left">Danh mục: </label>
                                                    <div class="col-sm-7">
	                                                    <select
	                                                     id = "cate"	
	                                                     name="category" class=" dropdown_sort">
						                                        <option value="0">All Categories</option>
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
                                                	</div>
                                                </div>
                                                <br>
                                                <div class='row'>
                                                    <label class="col-sm-2 label-on-left">Sắp xếp theo views: </label>
                                                    <div class="col-sm-7">
	                                                    <select
	                                                    id = "sort"
	                                                     data-style="select-with-transition" title="Numbers result" data-size="7">
	                                                        <option value="0">Tăng dần</option>
	                                                        <option value="1">Giảm dần</option>
	                                                    </select>
                                                	</div>
                                                </div>
                                                <br>
                                                <div class='row'>
                                                    <label class="col-sm-2 label-on-left">Trạng thái: </label>
                                                    <div class="col-sm-7">
	                                                    <select
	                                                    id = "status"
	                                                     data-style="select-with-transition" title="Numbers result" data-size="7">
	                                                        <option value="0">Đã kích hoạt</option>
	                                                        <option value="1">Chưa kích hoạt</option>
	                                                    </select>
                                                	</div>
                                                </div>
                                                <br>

                                      

                                    <div id="result" class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Tên</th>
                                                    <th>Danh mục</th>
                                                    <th>Thành phố</th>
                                                    <th>Tỉnh</th>
                                                    <th>Điện thoại</th>
                                                    <th>Website</th>
                                                    <th>Mở Cửa</th>
                                                    <th>Đóng cửa</th>
                                                    <th>Lượt view</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	   @foreach($places as $place)
                                                    <tr>
                                                        <td class="text-center">{{ $place->id }}</td>
                                                        <td>{{ $place->name }}</td>
                                                        <td>{{ $place->category()->first()->name }}</td>
                                                        <td>{{ $place->city }}</td>
                                                        <td>{{ $place->district }}</td>
                                                        <td>{{ $place->phone }}</td>
                                                        <td>{{ $place->website }}</td>
                                                        <td>{{ $place->open }}</td>
                                                        <td>{{ $place->close }}</td>
                                                        <td>{{ $place->count_views }}</td>

                                                        <td class="td-actions text-right">
              
                                                        <a type="button" rel="tooltip" 
                                                        href= {{ route('admin.user.edit', ['id'=> $place->id]) }} 
                                                        class="btn btn-success" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <button 
                                                            onclick = "changeDeleteUrl({{ $place['id'] }})"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            type="button" rel="tooltip" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                         {{ $places->appends(request()->input())->links('Admin.layouts.pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection