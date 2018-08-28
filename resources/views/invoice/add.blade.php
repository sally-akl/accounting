@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.add_new_invoices')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('invoice/store') }}">
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
                                                                              <option value="{{$customer->id}}">{{$customer->full_name}}</option>
                                                                            @endforeach
                                                                      </select>

                                                                  </div>

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.address')  :
                                                                      </label>
                                                                      <textarea rows="10" cols="70" disabled name="customer_address" id="customer_address"></textarea>

                                                                  </div>


                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.invoices_status')  :
                                                                    </label>
                                                                    <select class="form-control m-input" name="invoice_status">
                                                                          <option value="">Choose Status</option>
                                                                          <option value="paid">Paid</option>
                                                                          <option value="unpaid">UnPaid</option>
                                                                          <option value="pending">Pending</option>
                                                                          <option value="stoped">Stoped</option>

                                                                    </select>

                                                                </div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.invoices_date')  :
																																		</label>
                                                                    <input type="text"  name= "invoices_date" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_invoices_date') }}">
																																</div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.invoices_payment_term')  :
																																		</label>
                                                               <select class="form-control m-input" name="invoice_payment_term">
                                                                    <option value="">Choose payment term</option>
                                                                    <option value="due_on_receipt" selected="">Due On Receipt</option>
                                                                     <option value="+3">+3 days</option>
                                                                     <option value="+5">+5 days</option>
                                                                     <option value="+7">+7 days</option>
                                                                     <option value="+10">+10 days</option>
                                                                     <option value="+15">+15 days</option>
                                                                     <option value="+30">+30 days</option>
                                                                     <option value="+45">+45 days</option>
                                                                     <option value="+60">+60 days</option>
                                                                  </select>

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.discount_value')  :
																																		</label>
																																		<input type="text"  name= "invoices_discount" class="form-control m-input" placeholder="{{ __('app.enter_invoices_discount') }}" value="0">

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.discount_type')  :
																																		</label>

                                                                    <select class="form-control m-input" name="invoices_discount_type">

                                                                          <option value="percentage" selected="">Percentage</option>
                                                                          <option value="amount">Fix</option>

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
												@lang('app.add_new_invoices')
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
													<a href='{{url("/invoice/create")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.add_new_invoices')
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
