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
																							 <label class=" form-control-label"> <i class="far fa-edit"></i> @lang('app.update_customer')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("customer/{$customer->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																                   @csrf

																									<div class="form-group row">
																													<label class="col-sm-3 form-control-label label-sm">   @lang('app.customer_name') </label>
																													<div class="col-sm-9">
																															<input id="inputHorizontalSuccess" name= "fullname"  placeholder="{{ __('app.enter_full_name') }}" class="form-control form-control-success" type="text" value="{{$customer->full_name}}">
																													</div>
																											</div>

																											<div class="form-group row">
																															<label class="col-sm-3 form-control-label label-sm">   @lang('app.customer_email') </label>
																															<div class="col-sm-9">
																																	<input id="inputHorizontalSuccess" name= "email"  placeholder="{{ __('app.enter_customer_email') }}" class="form-control form-control-success" type="text" value="{{$customer->email}}">
																															</div>
																													</div>

																													<div class="form-group row">
																																	<label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_address') </label>
																																	<div class="col-sm-9">
																																			<input id="inputHorizontalSuccess" name= "address"  placeholder="{{ __('app.enter_customer_address') }}" class="form-control form-control-success" type="text" value="{{$customer->address}}">
																																	</div>
																															</div>

																															<div class="form-group row">
																																			<label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_phone') </label>
																																			<div class="col-sm-9">
																																					<input id="inputHorizontalSuccess" name= "phone"  placeholder="{{ __('app.enter_customer_phone') }}" class="form-control form-control-success" type="text" value="{{$customer->phone}}">
																																			</div>
																																	</div>

																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">	@lang('app.customer_city')</label>
																										<div class="col-sm-9">
																												<select name="city_val" class="form-control">
																													@foreach ($citites as $key => $city)
  																																						<option value="{{$city->id}}" {{$city->id == $customer->city_id ?"selected":""}}>{{$city->title}}</option>
  																																					@endforeach

																												</select>

																										</div>
																								</div>


																								@if(is_int($branches))
																									<input type="hidden" name="branch_name" value="{{$customer->branch_id}}" />

																									 @else

																									 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
																														<div class="col-sm-9">
																												<select name="branch_name" class="form-control">


																																		 @foreach ($branches as $key => $branch)
																																			 <option value="{{$branch->id}}" {{$customer->branch_id == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
																																		 @endforeach

																													</select>
																													</div>
																											</div>

																									 @endif





																									 <button type="submit" class="btn btn-primary">{{ __('app.update_customer') }} </button>
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
