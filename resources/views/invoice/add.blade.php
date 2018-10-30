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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_invoices')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action="{{ url('invoice/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
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

                                                   @if($c == 0)
																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">  @lang('app.customer_name')</label>
																										<div class="col-sm-9">
																												<select name="customer_name" class="form-control customer_name {{ $errors->has('customer_name') ? ' is-invalid' : '' }}">

																													<option value="0"> @lang('app.Choose_customer')</option>
                                                                            @foreach ($customers as $key => $customer)
                                                                              <option value="{{$customer->id}}" {{old('customer_name') == $customer->id ?"selected":""}}>{{$customer->full_name}}</option>
                                                                            @endforeach

																												</select>

																										</div>
																								</div>
																								@else
                                                  <input type="hidden" name="customer_name" class="customer_name" value="{{$c}}" />

																								@endif


																								  <input type="hidden" name="itype" value="{{$type}}" />

                                                       @if($c == 0)
																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">@lang('app.address') </label>
																															 <div class="col-sm-9">
																																 <textarea rows="10" cols="70" disabled name="customer_address" id="customer_address"></textarea>


																													 </div>
																													  </div>
                                                          	@endif


																													 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">  @lang('app.invoices_status')</label>
																														<div class="col-sm-9">
																																<select name="invoice_status" class="form-control {{ $errors->has('invoice_status') ? ' is-invalid' : '' }}">
																																	<option value="" {{old('invoice_status') == "" ?"selected":""}}> @lang('app.Choose_Status') </option>
																											            <option value="paid" {{old('invoice_status') == "paid" ?"selected":""}}>@lang('app.Paid')</option>
																											            <option value="unpaid" {{old('invoice_status') == "unpaid" ?"selected":""}}>@lang('app.UnPaid')</option>
																											            <option value="pending" {{old('invoice_status') == "pending" ?"selected":""}}>@lang('app.Pending')</option>
																											            <option value="stoped" {{old('invoice_status') == "stoped" ?"selected":""}}>@lang('app.Stoped')</option>

																																</select>

																														</div>
																												</div>

																												<div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">@lang('app.invoices_date') </label>
																															 <div class="col-sm-9">

																																	 <input id="inputHorizontalSuccess" name= "invoices_date"  value="{{ old('invoices_date') }}"  placeholder="{{ __('app.enter_invoices_date') }}" class="form-control {{ $errors->has('invoices_date') ? ' is-invalid' : '' }} form-control-success" type="date">
																															 </div>
																													 </div>


																													 <div class="form-group row">
 																														<label class="col-sm-3 form-control-label label-sm">  @lang('app.invoices_payment_term')</label>
 																														<div class="col-sm-9">

																															 <input id="inputHorizontalSuccess" name= "invoice_payment_term"  value="0"  placeholder="{{ __('app.invoices_payment_term') }}" class="form-control {{ $errors->has('invoices_payment_term') ? ' is-invalid' : '' }} form-control-success" type="text">

 																														</div>
 																												</div>



																													 <div class="form-group row">
		 																															<label class="col-sm-3 form-control-label label-sm">@lang('app.discount_value') </label>
		 																															<div class="col-sm-9">

		 																																	<input id="inputHorizontalSuccess" name= "invoices_discount" value="0"  placeholder="{{ __('app.enter_invoices_discount') }}" class="form-control {{ $errors->has('invoices_discount') ? ' is-invalid' : '' }} form-control-success" type="text">
		 																															</div>
		 																													</div>


																															<div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">  @lang('app.discount_type')</label>
																															 <div class="col-sm-9">
																																	 <select name="invoices_discount_type" class="form-control">
																																		 <option value="percentage" selected="">@lang('app.Percentage')</option>
																																				 <option value="amount">@lang('app.Fix')</option>
																																	 </select>

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

@section('footerjscontent')

<script type="text/javascript">
							$(".customer_name").on("change",function(){

								var id = $(this).val();
								var url_get_address = '{{url("customer/address")}}'+"/"+id+"/"+'{{app()->getLocale()}}?branch={{ Request::query("branch") }}'
												 $.ajax({url: url_get_address , method:"get" , success: function(result){
															$("#customer_address").val("");
															result = JSON.parse(result);
															console.log(result);
															if(result.msg == "sucess")
																 $("#customer_address").val(result.address);

													 }});

								})



					 </script>

@endsection
