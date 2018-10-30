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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_bouns')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("bouns/{$bouns->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
                                                     @csrf


																										<div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">    @lang('app.date')</label>
																																<div class="col-sm-9">
																																		 <input id="inputHorizontalSuccess" name= "bdate"  placeholder="{{ __('app.enter_date') }}" class="form-control form-control-success" type="date" disabled value="{{date('Y-m-d',strtotime($bouns->bonus_date))}}">
																																</div>
																										</div>



																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">	@lang('app.employee_major')</label>
																										<div class="col-sm-9">
																												<select name="emp_m_id" class="form-control" disabled>
																													@foreach ($employee_major as $key => $empmaj)
																																							<option value="{{$empmaj->id}}"  {{$empmaj->id == $bouns->emp_major_id?"selected":"" }}  >	{{App\employee::find($empmaj->emplyee_id)->employee_name}} - {{App\major::find($empmaj->major_id)->title}}</option>
																																						@endforeach

																												</select>

																										</div>
																								</div>


																								<input type="hidden" name="m_emp" value="{{ $bouns->emp_major_id}}" />
																								<div class="form-group row">
																								 <label class="col-sm-3 form-control-label label-sm">	@lang('app.sal_manage_extra_slary')</label>
																								 <div class="col-sm-9">
																										 <select name="sal_min_extra" class="form-control" >

																											 @foreach ($salary_settings as $key => $sett)
																																				 <option value="{{$sett->id}}"  {{$sett->id == $bouns->extra_minus_id?"selected":"" }}  >	{{$sett->title}} ( {{$sett->percentage}}% ) </option>
																																			 @endforeach

																										 </select>

																								 </div>
																						 </div>


                                                   <input type="hidden" name="action_after" value="bouns" />

																									 <button type="submit" class="btn btn-primary">{{ __('app.update_bouns') }} </button>
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
