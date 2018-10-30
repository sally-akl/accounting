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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_quotes')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action="{{ url('quote/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
                                                     @csrf

																										 <div class="form-group row">
																											 <label class="col-sm-3 form-control-label label-sm">@lang('app.cur_currency')</label>
																											 <div class="col-sm-9">
																													<select name="currency" class="form-control  {{ $errors->has('currency') ? ' is-invalid' : '' }}">
																															<option value="SAR" >@lang('app.sar_currency')</option>
																															<option value="EGP" >@lang('app.egp_currency')</option>
																															<option value="USD" >@lang('app.usd_currency')</option>
																													</select>


																											 </div>
																										 </div>


																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">  @lang('app.customer_name')</label>
																										<div class="col-sm-9">
																												<select name="customer_name" class="form-control {{ $errors->has('customer_name') ? ' is-invalid' : '' }}">

																													<option value="0">Choose customer</option>
                                                                            @foreach ($customers as $key => $customer)
                                                                              <option value="{{$customer->id}}" {{old('customer_name') == $customer->id ?"selected":""}}>{{$customer->full_name}}</option>
                                                                            @endforeach

																												</select>

																										</div>
																								</div>

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">@lang('app.subject') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "subject" value="{{ old('subject') }}"  placeholder="{{ __('app.enter_subject') }}" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }} form-control-success" type="text">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">  @lang('app.quote_status')</label>
																														<div class="col-sm-9">
																																<select name="quote_status" class="form-control {{ $errors->has('quote_status') ? ' is-invalid' : '' }}">
																																	<option value="" {{old('quote_status') == "" ?"selected":""}}>Choose Status</option>
																											            <option value="pending" {{old('quote_status') == "pending" ?"selected":""}}>Pending</option>

																																</select>

																														</div>
																												</div>

																												<div class="form-group row">
																																<label class="col-sm-3 form-control-label label-sm">@lang('app.quote_date') </label>
																																<div class="col-sm-9">
																																		<input id="inputHorizontalSuccess" name= "quote_date"  value="{{ old('quote_date') }}" placeholder="{{ __('app.enter_quote_date') }}" class="form-control {{ $errors->has('quote_date') ? ' is-invalid' : '' }} form-control-success" type="date">
																																</div>
																														</div>

																														<div class="form-group row">
																																		<label class="col-sm-3 form-control-label label-sm">@lang('app.quote_expire_date') </label>
																																		<div class="col-sm-9">
																																				<input id="inputHorizontalSuccess" name= "expire_date" value="{{ old('expire_date') }}" placeholder="{{ __('app.enter_quote_expire_date') }}" class="form-control {{ $errors->has('expire_date') ? ' is-invalid' : '' }} form-control-success" type="date">
																																		</div>
																																</div>

																																<div class="form-group row">
																																				<label class="col-sm-3 form-control-label label-sm">@lang('app.discount_value') </label>
																																				<div class="col-sm-9">
																																						<input id="inputHorizontalSuccess" name= "quote_discount" value="0" placeholder="{{ __('app.enter_quote_discount') }}" class="form-control  {{ $errors->has('quote_discount') ? ' is-invalid' : '' }} form-control-success" type="text">
																																				</div>
																																		</div>

																																		<div class="form-group row">
																																		 <label class="col-sm-3 form-control-label label-sm">  @lang('app.discount_type')</label>
																																		 <div class="col-sm-9">
																																				 <select name="quote_discount_type" class="form-control {{ $errors->has('quote_discount_type') ? ' is-invalid' : '' }}">
																																					 <option value="percentage" selected="">Percentage</option>
                                                                            <option value="amount">Fix</option>

																																				 </select>

																																		 </div>
																																 </div>

																																 <div class="form-group row">
																																				 <label class="col-sm-3 form-control-label label-sm">@lang('app.quote_txt') </label>
																																				 <div class="col-sm-9">
																																				    <textarea rows="10" cols="70"  name="quote_txt">{{ old('quote_txt') }}</textarea>
																																				 </div>
																																		 </div>

																																		 <div class="form-group row">
																																						 <label class="col-sm-3 form-control-label label-sm">@lang('app.quote_customer') </label>
																																						 <div class="col-sm-9">
																																						    <textarea rows="10" cols="70"  name="quote_customer">{{ old('quote_customer') }}</textarea>
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
