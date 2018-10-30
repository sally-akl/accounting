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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_account')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																						  <form method="POST" action='{{url("account/{$account->id}")}}/{{app()->getLocale()}}'>
								                                   @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.bank_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "bankname"  placeholder="{{ __('app.enter_bank_name') }}" class="form-control form-control-success" type="text" value="{{$account->bank_name}}">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   @lang('app.account_num') </label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name= "number"  placeholder="{{ __('app.enter_account_num') }}" class="form-control form-control-success" type="text" value="{{$account->account_number}}">
																																	 </div>
																															 </div>

																															 <div class="form-group row">
																																			 <label class="col-sm-3 form-control-label label-sm">   @lang('app.location') </label>
																																			 <div class="col-sm-9">
																																					 <input id="inputHorizontalSuccess" name= "location"  placeholder="{{ __('app.enter_location') }}" class="form-control form-control-success" type="text"  value="{{$account->branch_location}}">
																																			 </div>
																																	 </div>

																																	 <div class="form-group row">
																																					 <label class="col-sm-3 form-control-label label-sm">   @lang('app.city') </label>
																																					 <div class="col-sm-9">
																																							 <input id="inputHorizontalSuccess" name= "city"  placeholder="{{ __('app.enter_city') }}" class="form-control form-control-success" type="text" value="{{$account->branch_city}}">
																																					 </div>
																																			 </div>

																																			 <div class="form-group row">
																																							<label class="col-sm-3 form-control-label label-sm">   @lang('app.account_open_balance') </label>
																																							<div class="col-sm-9">
																																									<input id="inputHorizontalSuccess" name= "balance"  placeholder="{{ __('app.enter_open_balance') }}" class="form-control form-control-success" type="text" value="{{$account->open_balance}}">
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
