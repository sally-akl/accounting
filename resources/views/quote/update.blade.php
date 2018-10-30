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
																							 <label class=" form-control-label"><i class="far fa-edit"></i>	 @lang('app.update_new_quotes')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("quote/{$quote->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
                                                     @csrf

																										 <div class="form-group row">
																											<label class="col-sm-3 form-control-label label-sm">@lang('app.cur_currency')</label>
																											<div class="col-sm-9">
																												 <select name="currency" class="form-control  {{ $errors->has('currency') ? ' is-invalid' : '' }}">
																														 <option value="SAR" {{$quote->currancy == "SAR"?"selected":""}} >@lang('app.sar_currency')</option>
																														 <option value="EGP" {{$quote->currancy == "EGP"?"selected":""}} >@lang('app.egp_currency')</option>
																														 <option value="USD" {{$quote->currancy == "USD"?"selected":""}} >@lang('app.usd_currency')</option>
																												 </select>


																											</div>
																										</div>

																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">  @lang('app.customer_name')</label>
																										<div class="col-sm-9">

																												<select name="customer_name" class="form-control">

																													<option value="0">Choose customer</option>
                                                                            @foreach ($customers as $key => $customer)
                                                                              <option value="{{$customer->id}}"  {{$quote->customer_id == $customer->id?"selected":""  }}>{{$customer->full_name}}</option>
                                                                            @endforeach

																												</select>

																										</div>
																								</div>

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">@lang('app.subject') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "subject"  placeholder="{{ __('app.enter_subject') }}" class="form-control form-control-success" type="text" value="{{$quote->quote_subject}}">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">  @lang('app.quote_status')</label>
																														<div class="col-sm-9">
																																<select name="quote_status" class="form-control">
																																	<option value="">Choose Status</option>
																																	<option value="pending" {{$quote->quote_status == "pending"?"selected":""  }}>Pending</option>
																																</select>

																														</div>
																												</div>

																												<div class="form-group row">
																																<label class="col-sm-3 form-control-label label-sm">@lang('app.quote_date') </label>
																																<div class="col-sm-9">
																																		<input id="inputHorizontalSuccess" name= "quote_date"  placeholder="{{ __('app.enter_quote_date') }}" class="form-control form-control-success" type="date" value="{{ date("Y-m-d",strtotime($quote->quote_date))}}">
																																</div>
																														</div>

																														<div class="form-group row">
																																		<label class="col-sm-3 form-control-label label-sm">@lang('app.quote_expire_date') </label>
																																		<div class="col-sm-9">
																																				<input id="inputHorizontalSuccess" name= "expire_date"  placeholder="{{ __('app.enter_quote_expire_date') }}" class="form-control form-control-success" type="date" value="{{ date("Y-m-d",strtotime($quote->quote_expire_date))}}">
																																		</div>
																																</div>

																																<div class="form-group row">
																																				<label class="col-sm-3 form-control-label label-sm">@lang('app.discount_value') </label>
																																				<div class="col-sm-9">
																																						<input id="inputHorizontalSuccess" name= "quote_discount"  placeholder="{{ __('app.enter_quote_discount') }}" class="form-control form-control-success" type="text" value="{{$quote->quote_discount_amount}}">
																																				</div>
																																		</div>

																																		<div class="form-group row">
																																		 <label class="col-sm-3 form-control-label label-sm">  @lang('app.discount_type')</label>
																																		 <div class="col-sm-9">
																																				 <select name="quote_discount_type" class="form-control">
																																					 <option value="percentage" {{$quote->quote_discount_type == "percentage"?"selected":""}}>Percentage</option>
																																					 <option value="amount" {{$quote->quote_discount_type == "amount"?"selected":""}}>Fix</option>

																																				 </select>

																																		 </div>
																																 </div>

																																 <div class="form-group row">
																																				 <label class="col-sm-3 form-control-label label-sm">@lang('app.quote_txt') </label>
																																				 <div class="col-sm-9">
																																				    <textarea rows="10" cols="70"  name="quote_txt">{{$quote->quote_txt}}</textarea>
																																				 </div>
																																		 </div>

																																		 <div class="form-group row">
																																						 <label class="col-sm-3 form-control-label label-sm">@lang('app.quote_customer') </label>
																																						 <div class="col-sm-9">
																																						    <textarea rows="10" cols="70"  name="quote_customer">{{$quote->quote_customer_txt}}</textarea>
																																						 </div>
																																				 </div>




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
