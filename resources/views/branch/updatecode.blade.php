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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_branch_code')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("branch/updatecode/{$branch->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																                 @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.branch_code') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "code"  placeholder="{{ __('app.branch_code') }}" class="form-control form-control-success" type="text" value="{{$branch->branch_code}}">
																															 </div>
																													 </div>



																									 <button type="submit" class="btn btn-primary">{{ __('app.update_branch_code') }} </button>
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
