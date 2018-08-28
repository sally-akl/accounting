@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
                                       @lang('app.paid_invoices')
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																															<div class="col-xl-6">

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
                                                                                              $price += $service->pivot->price;

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

 																																							<a href='{{url("transactions/{$invoice->id}/invoicesDetails")}}'>Details</a>

 																																						</td>



																																						<td>

																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>

                                                      {{$invoices->links('vendor.pagination.default')}}


														</div>

@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
										   	@lang('app.paid_invoices')
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
