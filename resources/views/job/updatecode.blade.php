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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_job_code')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("job/updatecode/{$job->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
                                                  @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.job_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "job_code"  placeholder="{{ __('app.enter_job_code') }}" class="form-control form-control-success" type="text" value="{{$job->job_code}}">
																															 </div>
																													 </div>

																									 <button type="submit" class="btn btn-primary">{{ __('app.update_job_code') }}</button>
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
