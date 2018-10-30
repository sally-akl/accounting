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
																							 <label class=" form-control-label"> <i class="far fa-edit"></i> @lang('app.update_cu_complain')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("customercomplain/{$customer_requests_complain->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
								                                   @csrf
																									 <div class="form-group row">
																													 <label class="col-sm-3 form-control-label label-sm">@lang('app.date') </label>
																													 <div class="col-sm-9">

																															 <input id="inputHorizontalSuccess" name= "r_date"  value="{{  date('Y-m-d', strtotime($customer_requests_complain->m_date)) }}"  placeholder="{{ __('app.r_date') }}" class="form-control {{ $errors->has('r_date') ? ' is-invalid' : '' }} form-control-success" type="date">
																													 </div>
																											 </div>

																											 <div class="form-group row">
																								 							<label class="col-sm-3 form-control-label label-sm">@lang('app.status') </label>
																								 							<div class="col-sm-9">
																								 								<select name="status" class="form-control">
																								 									 <option value="1" {{$customer_requests_complain->status==1?"selected":""}}>@lang('app.open')</option>
																								 									 <option value="2" {{$customer_requests_complain->status==2?"selected":""}}>@lang('app.close')</option>

																								 								 </select>

																								 							</div>
																								 					</div>

																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">  @lang('app.subject') </label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name= "subject"  value="{{  $customer_requests_complain->subject}}" placeholder="{{ __('app.subject') }}" class="form-control form-control-success" type="text">
																																	 </div>
																													 </div>

																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">@lang('app.message') </label>
																																	 <div class="col-sm-9">
																																		 <textarea rows="10" cols="88"  name="message" >{{  $customer_requests_complain->message}}</textarea>


																															 </div>
																													 </div>
                                                       <input type="hidden" name="customer_val" value="{{$c}}" />
																										<button type="submit" class="btn btn-primary" style="margin-right: 2px;">+ {{ __('app.save') }} </button>
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
