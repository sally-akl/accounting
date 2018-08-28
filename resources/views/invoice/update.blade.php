@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.update_invoices')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action='{{url("invoice/{$invoice->id}")}}'>
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.customer_name')  :
                                                                      </label>
                                                                      <select class="form-control m-input customer_name" name="customer_name">
                                                                            <option value="0">Choose customer</option>
                                                                            @foreach ($customers as $key => $customer)
                                                                              <option value="{{$customer->id}}"  {{$invoice->customer_id == $customer->id?"selected":"" }}  >{{$customer->full_name}}</option>
                                                                            @endforeach
                                                                      </select>

                                                                  </div>

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.address')  :
                                                                      </label>
                                                                      <textarea rows="10" cols="70" disabled name="customer_address" id="customer_address">{{$address}}</textarea>

                                                                  </div>


                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.invoices_status')  :
                                                                    </label>
                                                                    <select class="form-control m-input" name="invoice_status">
                                                                          <option value="">Choose Status</option>
                                                                          <option value="paid" {{$invoice->invoice_status == 'paid'?"selected":"" }}>Paid</option>
                                                                          <option value="unpaid" {{$invoice->invoice_status == 'unpaid'?"selected":"" }}>UnPaid</option>
                                                                          <option value="pending" {{$invoice->invoice_status == 'pending'?"selected":"" }}>Pending</option>
                                                                          <option value="stoped" {{$invoice->invoice_status == 'stoped'?"selected":"" }}>Stoped</option>

                                                                    </select>

                                                                </div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.invoices_date')  :
																																		</label>
                                                                    <input type="text"  name= "invoices_date" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_invoices_date') }}" value="{{$invoice->invoice_date}}">
																																</div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.invoices_payment_term')  :
																																		</label>
                                                               <select class="form-control m-input" name="invoice_payment_term">
                                                                    <option value="">Choose payment term</option>
                                                                    <option value="due_on_receipt" {{$invoice->invoice_payment_term == 'due_on_receipt'?"selected":"" }}>Due On Receipt</option>
                                                                     <option value="+3" {{$invoice->invoice_payment_term == '+3'?"selected":"" }}>+3 days</option>
                                                                     <option value="+5" {{$invoice->invoice_payment_term == '+5'?"selected":"" }}>+5 days</option>
                                                                     <option value="+7" {{$invoice->invoice_payment_term == '+7'?"selected":"" }}>+7 days</option>
                                                                     <option value="+10" {{$invoice->invoice_payment_term == '+10'?"selected":"" }}>+10 days</option>
                                                                     <option value="+15" {{$invoice->invoice_payment_term == '+15'?"selected":"" }}>+15 days</option>
                                                                     <option value="+30"{{$invoice->invoice_payment_term == '+30'?"selected":"" }} >+30 days</option>
                                                                     <option value="+45" {{$invoice->invoice_payment_term == '+45'?"selected":"" }}>+45 days</option>
                                                                     <option value="+60" {{$invoice->invoice_payment_term == '+60'?"selected":"" }}>+60 days</option>
                                                                  </select>

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.discount_value')  :
																																		</label>
																																		<input type="text"  name= "invoices_discount" class="form-control m-input" placeholder="{{ __('app.enter_invoices_discount') }}" value="{{$invoice->discount_amount}}">

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.discount_type')  :
																																		</label>

                                                                    <select class="form-control m-input" name="invoices_discount_type">

                                                                          <option value="percentage" {{$invoice->discount_type == 'percentage'?"selected":"" }}>Percentage</option>
                                                                          <option value="amount" {{$invoice->discount_type == 'amount'?"selected":"" }}>Fix</option>

                                                                       </select>

																																</div>



                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.save') }}">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>

                                                          </form>



														</div>
														<!--end::Portlet-->



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


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.update_invoices')
											</h3>
											<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
												<li class="m-nav__item m-nav__item--home">
													<a href="#" class="m-nav__link m-nav__link--icon">
														<i class="m-nav__link-icon la la-home"></i>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("/invoice")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.invoice')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("invoice/{$invoice->id}/edit")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.update_invoices')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>

											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
