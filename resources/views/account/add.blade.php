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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i>	 @lang('app.add_new_account')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																						  <form method="POST" action="{{ url('account/store') }}/{{app()->getLocale()}}">
								                                   @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.bank_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "bankname" value="{{ old('bankname') }}"   placeholder="{{ __('app.enter_bank_name') }}" class="form-control {{ $errors->has('bankname') ? ' is-invalid' : '' }} form-control-success" type="text">
																															 </div>
																													 </div>

																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   @lang('app.account_num') </label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name= "number" value="{{ old('number') }}"  placeholder="{{ __('app.enter_account_num') }}" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }} form-control-success" type="text">
																																	 </div>
																															 </div>

																															 <div class="form-group row">
																																			 <label class="col-sm-3 form-control-label label-sm">   @lang('app.location') </label>
																																			 <div class="col-sm-9">
																																					 <input id="inputHorizontalSuccess" name= "location" value="{{ old('location') }}"  placeholder="{{ __('app.enter_location') }}" class="form-control {{ $errors->has('location') ? ' is-invalid' : '' }} form-control-success" type="text">
																																			 </div>
																																	 </div>

																																	 <div class="form-group row">
																																					 <label class="col-sm-3 form-control-label label-sm">   @lang('app.city') </label>
																																					 <div class="col-sm-9">
																																							 <input id="inputHorizontalSuccess" name= "city"  value="{{ old('city') }}" placeholder="{{ __('app.enter_city') }}" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }} form-control-success" type="text">
																																					 </div>
																																			 </div>

																																			 <div class="form-group row">
																																							<label class="col-sm-3 form-control-label label-sm">   @lang('app.account_open_balance') </label>
																																							<div class="col-sm-9">
																																									<input id="inputHorizontalSuccess" name= "balance" value="{{ old('balance') }}"  placeholder="{{ __('app.enter_open_balance') }}" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }} form-control-success" type="text">
																																							</div>
																																					</div>

                                                             <input type="hidden" name="where_from" value="{{$where_from}}" />

																									 <button type="submit" class="btn btn-primary">+ {{ __('app.add_new_account') }} </button>
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
