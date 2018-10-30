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
																							 <label class=" form-control-label"> <i class="far fa-edit"></i> @lang('app.update_user')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("user/{$user->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																                     @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">  {{ __('Name') }} </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name="name" value="{{ $user->name }}" required autofocus   class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " type="text">
																																	 @if ($errors->has('name'))
																																			<span class="invalid-feedback" role="alert">
																																					<strong>{{ $errors->first('name') }}</strong>
																																			</span>
																																	@endif
																															 </div>
																													 </div>


																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   {{ __('E-Mail Address') }}</label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name="email" value="{{$user->email}}" required  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} " type="text">
																																			 @if ($errors->has('email'))
																																				 <span class="invalid-feedback" role="alert">
																																						 <strong>{{ $errors->first('email') }}</strong>
																																				 </span>
																																		 @endif
																																	 </div>
																															 </div>


																															 <div class="form-group row">
																																<label class="col-sm-3 form-control-label label-sm">	@lang('app.branch_name')</label>
																																<div class="col-sm-9">
																																		<select name="branch_name" class="form-control {{ $errors->has('branch_name') ? ' is-invalid' : '' }}">


																																								@foreach ($branches as $key => $branch)
																																									<option value="{{$branch->id}}" {{$user->branch_id == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
																																								@endforeach

																																		</select>

																																</div>
																														</div>



																									 <button type="submit" class="btn btn-primary">{{ __('update_user') }} </button>
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
