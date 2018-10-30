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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_city')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							<form method="POST" action='{{url("city/{$city->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
								                                   @csrf

																							<!--		 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">@lang('app.country_name')</label>
																										<div class="col-sm-9">
																												<select name="country_value" class="form-control">

																													@foreach ($countries as $key => $country)
																													 <option value="{{$country->id}}" {{$country->id == $city->country_id ?"selected":""}}>{{$country->title}}</option>
																													@endforeach

																												</select>
																													<a href="{{ url('country/create/city') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>Add country</a>
																										</div>
																								</div>

																							-->

																								 <input type="hidden" name="country_value" value="{{$c}}" />

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.city_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "title"  placeholder="{{ __('app.enter_city_name') }}" class="form-control form-control-success" type="text" value="{{$city->title}}">
																															 </div>
																													 </div>

																													 <input type="hidden" name="action_after" value="city" />

																									 <button type="submit" class="btn btn-primary">{{ __('app.save') }} </button>
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
