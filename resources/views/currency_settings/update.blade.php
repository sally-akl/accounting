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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_currency_price')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																						  <form method="POST" action='{{url("currency/{$currency_setting->id}")}}/{{app()->getLocale()}}'>
								                                   @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.curr_date') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "cur_date"  placeholder="{{ __('app.curr_date') }}" class="form-control form-control-success" type="text" disabled value="{{$currency_setting->currency_date}}">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   @lang('app.cur_currency') </label>
																																	 <div class="col-sm-9">
                                                                              {{$currency_setting->current_currency}}
																																	 </div>
																															 </div>

																															 <div class="form-group row">
																																			 <label class="col-sm-3 form-control-label label-sm">   @lang('app.price_egp') </label>
																																			 <div class="col-sm-9">
																																					 <input id="inputHorizontalSuccess" name= "EGP"  placeholder="{{ __('app.price_egp') }}" class="form-control form-control-success" type="text"  value="{{$currency_setting->EGP}}">
																																			 </div>
																																	 </div>

																																	 <div class="form-group row">
																																					 <label class="col-sm-3 form-control-label label-sm">   @lang('app.price_sar') </label>
																																					 <div class="col-sm-9">
																																							 <input id="inputHorizontalSuccess" name= "SAR"  placeholder="{{ __('app.price_sar') }}" class="form-control form-control-success" type="text" value="{{$currency_setting->SAR}}">
																																					 </div>
																																			 </div>

																																			 <div class="form-group row">
																																							<label class="col-sm-3 form-control-label label-sm">   @lang('app.price_usd') </label>
																																							<div class="col-sm-9">
																																									<input id="inputHorizontalSuccess" name= "USD"  placeholder="{{ __('app.price_usd') }}" class="form-control form-control-success" type="text" value="{{$currency_setting->USD}}">
																																							</div>
																																					</div>



																									 <button type="submit" class="btn btn-primary">{{ __('app.update_account') }}</button>
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
