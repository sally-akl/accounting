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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_service')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action="{{ url('service/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
	                                   @csrf

																												 <div class="form-group row">
																												 <label class="col-sm-3 form-control-label label-sm">	@lang('app.category_parent')</label>
																												 <div class="col-sm-9">
																														 <select name="category" class="form-control">
																																				 @foreach ($categories as $key => $cat)
																																					 <option value="{{$cat->id}}" {{old('category') == $cat->id ?"selected":""}}>{{$cat->title}}</option>
																																				 @endforeach

																														 </select>

																												 </div>
																										 </div>

																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">	@lang('app.service_parent')</label>
																										<div class="col-sm-9">
																												<select name="parent" class="form-control">

																													<option value="0">No Parent</option>
 																																		@foreach ($services as $key => $serv)
 																																			<option value="{{$serv->id}}" {{old('parent') == $serv->id ?"selected":""}}>{{$serv->title}}</option>
 																																		@endforeach

																												</select>

																										</div>
																								</div>

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.service_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "title" value="{{ old('title') }}"  placeholder="{{ __('app.enter_service_name') }}" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} form-control-success" type="text">
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
