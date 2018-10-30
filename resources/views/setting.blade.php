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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_setting')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("settings/{$setting->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' enctype="multipart/form-data">
								                                   @csrf


																									 <div class="form-group row">
																													 <label class="col-sm-3 form-control-label label-sm"> @lang('app.company_logo')  </label>
																													 <div class="col-sm-9">
																														 <input  name="logo" type="file" id="imageInput">
																														 <img src="{{ url('/') }}/images/{{$setting->company_logo}}" width="150" height="150"/>

																													 </div>
																											 </div>


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm"> 	@lang('app.company_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "name"  class="form-control form-control-success" type="text" value="{{$setting->company_name}}" >
																															 </div>
																													 </div>

																													 <div class="form-group row">
																																	<label class="col-sm-3 form-control-label label-sm"> 		@lang('app.email') </label>
																																	<div class="col-sm-9">
																																			<input id="inputHorizontalSuccess" name= "email"  class="form-control form-control-success" type="text" value="{{$setting->company_email}}">
																																	</div>
																															</div>

																															<div class="form-group row">
																																		 <label class="col-sm-3 form-control-label label-sm">	@lang('app.company_address')</label>
																																		 <div class="col-sm-9">
																																			 <textarea rows="10" cols="70"  name="address" >{{$setting->company_address}}</textarea>

																																 </div>

																																 </div>


																																<div class="form-group row">
																																				<label class="col-sm-3 form-control-label label-sm"> 	@lang('app.currency') </label>
																																				<div class="col-sm-9">
																																					<select name="currency" class="form-control"  {{$setting->currency !=""?"disabled":""}}>
																																						 <option value="USD" {{$setting->currency == "USD"?"selected":""}}>	@lang('app.usd_currency')</option>
																																						 <option value="EGP" {{$setting->currency == "EGP"?"selected":""}}>	@lang('app.egp_currency')</option>
																																						 <option value="SAR" {{$setting->currency == "SAR"?"selected":""}} >	@lang('app.sar_currency')</option>
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
