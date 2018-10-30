@extends('layouts.master')

@section('content')

<section id="manage-incom">
									 <div class="container-fluid">
											 <div class="row">
													 <div class="col-lg-12">
															 <div class="card">
																	 <div class="card col-lg-12 padding20">
																			 <div class="row">
																					 <div class=" mg-top25">
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.new_role')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action="{{ url('roles/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
																                  @csrf

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">  @lang('app.title') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "title" value="{{ old('title') }}"  placeholder="{{ __('app.enter_role_title') }}" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} form-control-success" type="text">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">	@lang('app.parent')</label>
																														<div class="col-sm-9">
																																<select name="parent" class="form-control">

																																	<option value="0">No Parent</option>
																																						@foreach ($roles as $key => $role)
																																							<option value="{{$role->id}}" {{old('parent') == $role->id ?"selected":""}}>{{$role->title}}</option>
																																						@endforeach

																																</select>

																														</div>
																												</div>

																									 	<button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
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
