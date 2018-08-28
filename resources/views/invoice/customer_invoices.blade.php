@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
                                      @if($filter_customer == true)
                                         @lang('app.list_of_customer_invoices')
																			@else
																				  @lang('app.list_of_invoices')
																			@endif
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																															<div class="col-xl-6">
                                                                    <button type="button" class="inputSearchYellow"><i class="fa fa-search"></i> Search</button>
                                                                </div>


                                                                <div class="col-xl-6">
                                                                    <div class="btnAQ">
                                                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push toolsmenu" m-dropdown-toggle="hover" aria-expanded="true">


                                                                    </div>

																																		<?php
																																				 if(!$filter_customer)
																																				 {


																																		 ?>

																																		<a href="{{ url('invoice/create') }}">
																																				<button type="button" class="btnNew"><i class="fa fa-plus"></i>@lang('app.add_new_invoices')</button>
																																		</a>
                                                                     <?php
																																	       }
																																		  ?>
                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">
                                                                       @include("invoice.search")
																										         	  </div>


                                                            </div>

                                                            <div class="row dataTables">
                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>

                                                                        </th>
                                                                        <th>
                                                                          @lang('app.customer_name')
                                                                        </th>

																																				<th>
																																					@lang('app.customer_amount')
																																				</th>

																																				<th>
																																					@lang('app.customer_invoice_date')
																																				</th>

                                                                        <th>
                                                                          @lang('app.invoice_status')
                                                                        </th>


                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>

                                                                        @foreach ($invoices as $key => $invoice)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>
																																								{{$invoice->CustomerData->full_name}}
																																						</td>

																																						<td>
                                                                                 <?php
                                                                                        $price = 0 ;

                                                                                      //  print_r($invoice->services);
                                                                                       foreach ($invoice->services as $key => $service)
                                                                                         {
                                                                                            if($service->pivot->invoice_type == $invoice->invoice_item_type)
                                                                                              $price += $service->pivot->qty * $service->pivot->price;

                                                                                         }

                                                                                         $discount_value = $invoice->discount_amount;
                                                                                         if($invoice->discount_type != "amount")
																																												 {
																																													    $discount_value = ($price * $invoice->discount_amount) /100;
																																												 }
																																												 $price =  $price - $discount_value;

                                                                                         echo $price;
                                                                                 ?>



																																						</td>

																																						<td>
                                                                               	{{ date("Y-m-d",strtotime($invoice->invoice_date))}}

																																						</td>



                                                                            <td class="balanceColor">
                                                                               <span class="m-badge m-badge--success m-badge--wide">
                                                                                  {{$invoice->invoice_status}}
                                                                                 </span>
                                                                             </td>



																																						 <td>

																																						 </td>
																																						 <td>
																																							 <?php
                                                                                    if(!$filter_customer)
																																										{


																																							  ?>
																																							 <a href="#" class="deleted_btn" data-title="{{$invoice->id}}">	<i class="la la-trash"></i> </a>
																																							 <a href='{{url("invoice/{$invoice->id}/edit")}}'>	<i class="la la-edit"></i></a>
																																							 <a href='{{url("transactions/income/{$invoice->id}")}}'>All invoice transaction</a>
																																							 <a href='{{url("invoice/{$invoice->id}/show")}}'>Show</a>
																																							 <?php
																																						         }
																																							  ?>

																																						 </td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>

                                                      {{$invoices->links('vendor.pagination.default')}}


														</div>


														<script type="text/javascript">
															 $(".deleted_btn").on("click",function(){

																 var id = $(this).attr("data-title");
																 var url_delete = '{{url("invoice/index")}}'+"/"+id
																					$.ajax({url: url_delete , success: function(result){

																							 result = JSON.parse(result);
																							 console.log(result);
																							 if(result.sucess)
																							 {
																									 window.location.href = '{{url("/invoice/all")}}';
																							 }
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
												@if($filter_customer == true)
													 @lang('app.list_of_customer_invoices')
												@else
														@lang('app.list_of_invoices')
											  	@endif
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

											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
