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
																							 <label class=" form-control-label"> <i class="far fa-edit"></i> @lang('app.update_employee')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("employee/{$employee->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																                         @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "name"  placeholder="{{ __('app.enter_employee_name') }}" class="form-control form-control-success" type="text" value="{{$employee->employee_name}}">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_email') </label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name= "employee_email"  placeholder="{{ __('app.enter_employee_email') }}" class="form-control form-control-success" type="text" value="{{$employee->employee_email}}">
																																	 </div>
																															 </div>

																															 <div class="form-group row">
																																			 <label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_address') </label>
																																			 <div class="col-sm-9">
																																					 <input id="inputHorizontalSuccess" name= "address"  placeholder="{{ __('app.enter_employee_address') }}" class="form-control form-control-success" type="text" value="{{$employee->employee_address}}">
																																			 </div>
																																	 </div>

																																	 <div class="form-group row">
																																					 <label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_phone') </label>
																																					 <div class="col-sm-9">
																																							 <input id="inputHorizontalSuccess" name= "phone"  placeholder="{{ __('app.enter_employee_phone') }}" class="form-control form-control-success" type="text" value="{{$employee->employee_phone}}">
																																					 </div>
																																			 </div>

																																			 <div class="form-group row">
																																					 <label class="col-sm-3 form-control-label label-sm">	@lang('app.employee_status')</label>
																																					 <div class="col-sm-9">
																																							 <select name="status" class="form-control">
																																								 <option value="1" {{$employee->employee_status == 1 ?"selected":""}}>Active</option>
																																						     <option value="2" {{$employee->employee_status == 2 ?"selected":""}}>Not active</option>
																																							 </select>

																																					 </div>
																																	     </div>

																																			 <div class="form-group row">
																																							<label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_join_data') </label>
																																							<div class="col-sm-9">
																																									<input id="inputHorizontalSuccess" name= "join_date"  placeholder="{{ __('app.enter_employee_join_date') }}" class="form-control form-control-success" type="date" value="{{date('Y-m-d',strtotime($employee->employee_join_date))}}">
																																							</div>
																																					</div>

																																					<div class="form-group row">
	 																																							<label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_details') </label>
	 																																							<div class="col-sm-9">
	 																																								 <textarea rows="10" cols="70" name="details">{{$employee->employee_details}}</textarea>
	 																																					</div>
																																						</div>

																																						<div class="form-group row">
																																								<label class="col-sm-3 form-control-label label-sm">	@lang('app.job_title')</label>
																																								<div class="col-sm-9">
																																										<select name="job_title" class="form-control">
																																											@foreach($jobs as $job)
																																												<option value="{{$job->id}}" {{$employee->job_id == $job->id ?"selected":""}}>{{$job->title}}({{$job->job_code}})</option>
																																											@endforeach


																																										</select>

																																								</div>
																																						</div>


																																						@if(is_int($branches))
																																							<input type="hidden" name="branch_name" value="{{$employee->branch_id}}" />

																																							 @else

																																							 <div class="form-group row">
																																												<label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
																																												<div class="col-sm-9">
																																										<select name="branch_name" class="form-control">


																																																 @foreach ($branches as $key => $branch)
																																																	 <option value="{{$branch->id}}" {{$employee->branch_id == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
																																																 @endforeach

																																											</select>
																																											</div>
																																									</div>

																																							 @endif
																																						<input type="hidden" name="where_from"/>


																									 <button type="submit" class="btn btn-primary">{{ __('app.update_employee') }} </button>
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
