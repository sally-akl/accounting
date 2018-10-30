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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.new_branch')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("branch/{$branch->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
                                                  @csrf


																									<div class="form-group row">
																													<label class="col-sm-3 form-control-label label-sm">   @lang('app.branch_name') </label>
																													<div class="col-sm-9">
																															<input id="inputHorizontalSuccess" name= "btitle" value="{{$branch->branch_title}}"  placeholder="{{ __('app.branch_name') }}" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} form-control-success" type="text">
																													</div>
																											</div>

																											<div class="form-group row">
																															<label class="col-sm-3 form-control-label label-sm">   @lang('app.email') </label>
																															<div class="col-sm-9">
																																	<input id="inputHorizontalSuccess" name= "email" value="{{$branch->email}}" placeholder="{{ __('app.enter_email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} form-control-success" type="text">
																															</div>
																													</div>


																													<div class="form-group row">
																																	<label class="col-sm-3 form-control-label label-sm">   @lang('app.phone') </label>
																																	<div class="col-sm-9">
																																			<input id="inputHorizontalSuccess" name= "phone" value="{{$branch->phone}}"  placeholder="{{ __('app.phone') }}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }} form-control-success" type="text">
																																	</div>
																															</div>

																															<div class="form-group row">
																																			<label class="col-sm-3 form-control-label label-sm">@lang('app.address') </label>
																																			<div class="col-sm-9">
																																				<textarea rows="10" cols="70"  name="address" >{{$branch->address}}</textarea>


																																	     </div>
																														   </div>

																															<div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">	@lang('app.city_name')</label>
																															 <div class="col-sm-9">
																																	 <select name="city" class="form-control city_name">
																																		 @foreach ($cities as $key => $city)
																																			 <option value="{{$city->id}}" {{$branch->city_id == $city->id ?"selected":""}}>{{$city->title}}</option>
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

@section('footerjscontent')

<script type="text/javascript">
							 $(".country_name").on("change",function(){

								 var val = $(this).val();
								 var url_cities = '{{url("city/country")}}'+"/"+val+'/{{app()->getLocale()}}'
													$.ajax({url: url_cities , success: function(result){

															 result = JSON.parse(result);
															 $(".city_name").html(result.cities);

														}});

								 })



						</script>

@endsection
