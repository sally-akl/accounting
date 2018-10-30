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
																							 <label class=" form-control-label"> <i class="far fa-edit"></i> @lang('app.update_salary')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("employeemajor/{$employee_major->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
															                  	@csrf
																								  <input type="hidden" name="employee_val" value="{{$emp_id}}" />

																								<div class="form-group row">
																								 <label class="col-sm-3 form-control-label label-sm">@lang('app.major_name')</label>
																								 <div class="col-sm-9">
																										 <select name="major_val" class="form-control major_val" disabled>
																											 @foreach ($majors as $key => $maj)
																																						 <option value="{{$maj->id}}"  {{$maj->id == $employee_major->major_id?"selected":"" }}>{{$maj->title}}</option>
																																					 @endforeach

																										 </select>

																						 </div>
																					 </div>




																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   	@lang('app.employee_join_data')  </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "join_date"  value="{{$employee_major->join_date}}" disabled placeholder="{{ __('app.enter_employee_join_date') }}" class="form-control form-control-success" type="date">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   	@lang('app.employee_salary')  </label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name= "salary" value="{{$employee_major->current_salary}}"  placeholder="{{ __('app.enter_emp_salary') }}" class="form-control form-control-success" type="text">
																																	 </div>
																															 </div>


																															 <div class="form-group row">
																									             <label class="col-sm-3 form-control-label label-sm">@lang('app.cur_currency')</label>
																									             <div class="col-sm-9">
																									                <select name="currency" class="form-control major_val {{ $errors->has('currency') ? ' is-invalid' : '' }}">
																									                    <option value="SAR"  {{$employee_major->currancy == "SAR" ? "selected":""}} >@lang('app.sar_currency')</option>
																									                    <option value="EGP" {{$employee_major->currancy == "EGP" ? "selected":""}} >@lang('app.egp_currency')</option>
																									                    <option value="USD" {{$employee_major->currancy == "USD" ? "selected":""}} >@lang('app.usd_currency')</option>
																									                </select>


																									             </div>
																									             </div>


																															 <div class="form-group row">
																																			 <label class="col-sm-3 form-control-label label-sm">  	@lang('app.employee_current')   </label>
																																			 <div class="col-sm-9">
																																						<input type="checkbox"  name= "is_current" {{$employee_major->is_current == 1?"checked":"" }}>
																																			 </div>
																																	 </div>


																																	 @if(is_int($branches))
									 																									<input type="hidden" name="branch_name" value="{{$employee_major->branch_id}}" />

									 																									 @else

									 																									 <div class="form-group row">
									 																														<label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
									 																														<div class="col-sm-9">
									 																												<select name="branch_name" class="form-control">


									 																																		 @foreach ($branches as $key => $branch)
									 																																			 <option value="{{$branch->id}}" {{$employee_major->branch_id == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
									 																																		 @endforeach

									 																													</select>
									 																													</div>
									 																											</div>

									 																									 @endif


																									 <button type="submit" class="btn btn-primary add_emp_major">{{ __('app.update_salary') }} </button>
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
