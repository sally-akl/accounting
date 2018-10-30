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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_invoices')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("invoice/{$invoice->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
                                                   @csrf

																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">  @lang('app.customer_name')</label>
																										<div class="col-sm-9">
																												<select name="customer_name" class="form-control customer_name">

																													<option value="0">Choose customer</option>
																																					@foreach ($customers as $key => $customer)
																																						<option value="{{$customer->id}}"  {{$invoice->customer_id == $customer->id?"selected":"" }}  >{{$customer->full_name}}</option>
																																					@endforeach

																												</select>

																										</div>
																								</div>

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">@lang('app.address') </label>
																															 <div class="col-sm-9">
																																 <textarea rows="10" cols="70" disabled name="customer_address" id="customer_address">{{$address}}</textarea>


																													 </div>
																													  </div>

																													 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">  @lang('app.invoices_status')</label>
																														<div class="col-sm-9">
																																<select name="invoice_status" class="form-control">
																																	<option value=""> @lang('app.Choose_Status')</option>
                                                                          <option value="paid" {{$invoice->invoice_status == 'paid'?"selected":"" }}>@lang('app.Paid')</option>
                                                                          <option value="unpaid" {{$invoice->invoice_status == 'unpaid'?"selected":"" }}>@lang('app.UnPaid')</option>
                                                                          <option value="pending" {{$invoice->invoice_status == 'pending'?"selected":"" }}>@lang('app.Pending')</option>
                                                                          <option value="stoped" {{$invoice->invoice_status == 'stoped'?"selected":"" }}>@lang('app.Stoped')</option>

																																</select>

																														</div>
																												</div>

																												<div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">@lang('app.invoices_date') </label>
																															 <div class="col-sm-9">

																																	 <input id="inputHorizontalSuccess" name= "invoices_date"  placeholder="{{ __('app.enter_invoices_date') }}" class="form-control form-control-success" type="date" value="{{date("Y-m-d", strtotime($invoice->invoice_date))}}">
																															 </div>
																													 </div>


																													 <div class="form-group row">
 																														<label class="col-sm-3 form-control-label label-sm">  @lang('app.invoices_payment_term')</label>
 																														<div class="col-sm-9">
 																																<select name="invoice_payment_term" class="form-control">
																																	<option value="">@lang('app.invoices_payment_term')</option>
																																	<option value="due_on_receipt" {{$invoice->invoice_payment_term == 'due_on_receipt'?"selected":"" }}>@lang('app.Due_On_Receipt')</option>
                                                                     <option value="+3" {{$invoice->invoice_payment_term == '+3'?"selected":"" }}>+3 @lang('app.days')</option>
                                                                     <option value="+5" {{$invoice->invoice_payment_term == '+5'?"selected":"" }}>+5 @lang('app.days')</option>
                                                                     <option value="+7" {{$invoice->invoice_payment_term == '+7'?"selected":"" }}>+7 @lang('app.days')</option>
                                                                     <option value="+10" {{$invoice->invoice_payment_term == '+10'?"selected":"" }}>+10 @lang('app.days')</option>
                                                                     <option value="+15" {{$invoice->invoice_payment_term == '+15'?"selected":"" }}>+15 @lang('app.days')</option>
                                                                     <option value="+30"{{$invoice->invoice_payment_term == '+30'?"selected":"" }} >+30 @lang('app.days')</option>
                                                                     <option value="+45" {{$invoice->invoice_payment_term == '+45'?"selected":"" }}>+45 @lang('app.days')</option>
                                                                     <option value="+60" {{$invoice->invoice_payment_term == '+60'?"selected":"" }}>+60 @lang('app.days')</option>
 																																</select>

 																														</div>
 																												</div>



																													 <div class="form-group row">
		 																															<label class="col-sm-3 form-control-label label-sm">@lang('app.discount_value') </label>
		 																															<div class="col-sm-9">

		 																																	<input id="inputHorizontalSuccess" name= "invoices_discount"  placeholder="{{ __('app.enter_invoices_discount') }}" class="form-control form-control-success" type="text" value="{{$invoice->discount_amount}}">
		 																															</div>
		 																													</div>


																															<div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">  @lang('app.discount_type')</label>
																															 <div class="col-sm-9">
																																	 <select name="invoices_discount_type" class="form-control">

                                                                           <option value="percentage" {{$invoice->discount_type == 'percentage'?"selected":"" }}>@lang('app.Percentage')</option>
                                                                           <option value="amount" {{$invoice->discount_type == 'amount'?"selected":"" }}>@lang('app.Fix')</option>

																																	 </select>

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


@section('footerjscontent')

<script type="text/javascript">
							$(".customer_name").on("change",function(){

								var id = $(this).val();
								var url_get_address = '{{url("customer/address")}}'+"/"+id
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
