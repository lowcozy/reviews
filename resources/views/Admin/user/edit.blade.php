@extends('Admin.layouts.app')
@section('title', 'Chỉnh sửa tài khoản')
@section('header')
@include('Admin.includes.header', ['function' => 'Chỉnh sửa tài khoản'])
@endsection

@section('content')
						<div class="col-md-12">
                            <div class="card">
                                <form id="TypeValidation" class="form-horizontal" 
                                	 action= {{ route('admin.user.update', ['id'=> $user->id]) }} 
                                	 method="post" novalidate="novalidate">
                                	 @csrf
                                    <div class="card-header card-header-text" data-background-color="rose">
                                        <h4 class="card-title">Thông tin tài khoản</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">First Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating {{ $errors->has('first_name') ? 'has-error' : 'is-empty' }}">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="first_name" required="true" aria-required="true"
                                                     value="{{ old('first_name', $user->first_name) }}" 
                                                    >
                                                <span class="material-input">
                                                	 @if ($errors->has('first_name'))
					                                        {{ $errors->first('first_name') }}
					                                @endif
                                                </span></div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <label class="col-sm-2 label-on-left">Last Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating {{ $errors->has('last_name') ? 'has-error' : 'is-empty' }}">
                                                    <label class="control-label"></label>
                                                    <input 
                                                    value="{{ old('last_name', $user->last_name) }}" 
                                                    class="form-control" type="text" name="last_name" required="true" aria-required="true">
                                                <span class="material-input">
                                                	@if ($errors->has('last_name'))
					                                        {{ $errors->first('last_name') }}
					                                @endif
                                                </span></div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Role</label>
                                            <div class="col-sm-7">
                                                 <select
                                                    id = "selectRole" name = "selectRole"
                                                     class="selectpicker" data-style="select-with-transition" title="Choose Role" data-size="7">
                                                        <option value="Admin" @if($user->name == 'Admin') selected @endif > Admin</option>
                                                        <option value="Collab" {{ $user->name == 'Collab' ? ' selected' : '' }}> Collab</option>
                                                        <option value="Member" {{ $user->name == 'Member' ? ' selected' : '' }}>Member</option>
                                                    </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-rose btn-fill">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
@endsection