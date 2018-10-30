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
																							 <label class=" form-control-label"><i class="far fa-edit"></i>
																								 @if($mtype == "extra_salary")
								 																    @lang('app.sal_update_manage_extra_slary')
								 															   @elseif($mtype == "bouns")
								 																	  @lang('app.sal_update_manage_bouns')
								 															   @elseif($mtype == "discount")
								 																	  @lang('app.sal_update_manage_discount')
								 															   @endif
																							 </label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("salarysettings/{$salary_settings->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																                 @csrf
																								 <div class="form-group row">
																												 <label class="col-sm-3 form-control-label label-sm">   @lang('app.desc') </label>
																												 <div class="col-sm-9">
																														 <input id="inputHorizontalSuccess" name= "mtitle" value="{{ $salary_settings->title }}"  placeholder="{{ __('app.desc') }}" class="form-control {{ $errors->has('mtitle') ? ' is-invalid' : '' }} form-control-success" type="text">
																												 </div>
																										 </div>

																										 <div class="form-group row">
																														 <label class="col-sm-3 form-control-label label-sm">   @lang('app.percentage')</label>
																														 <div class="col-sm-9">
																																 <input id="inputHorizontalSuccess" name= "percent" value="{{ $salary_settings->percentage }}"  placeholder="{{ __('app.percentage') }}" class="form-control {{ $errors->has('percent') ? ' is-invalid' : '' }} form-control-success" type="text">
																														 </div>
																												 </div>

																												 <div class="form-group row">
																													<label class="col-sm-3 form-control-label label-sm">  @lang('app.per_type')</label>
																													<div class="col-sm-9">
																															<select name="vtype" class="form-control">
																																<option value="percentage" {{ $salary_settings->val_type == "percentage"?"selected" : ""}}>@lang('app.Percentage')</option>
																																		<option value="amount"  {{ $salary_settings->val_type == "amount"?"selected" : ""}}>@lang('app.Fix')</option>
																															</select>

																													</div>
																											</div>

																										 <input type="hidden" name="ty" value='{{$mtype}}'  />


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
