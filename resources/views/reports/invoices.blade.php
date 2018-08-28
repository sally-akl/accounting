@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">

																				 @lang('app.list_of_invoices')

																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

																<div class="row">
																	<div class="col-xl-3" style="margin-left: 81px;">

																		<div class="row incomesStat   statDashboard2 mx-auto" style="margin-top:10px;width: 266px;">
																				<div class="col-xl-2 iconStat">

																				</div>
																				<div class="col-xl-10">
																						<h2>{{$invoice_num}}</h2>
																						<p>Total</p>
																				</div>
																		</div>

																	</div>
																	<div class="col-xl-3" style="margin-left: 81px;">

																		<div class="row incomesStat   statDashboard2 mx-auto" style="margin-top:10px;width: 266px;">
																				<div class="col-xl-2 iconStat">

																				</div>
																				<div class="col-xl-10">
																						<h2>{{count($total_paid)>0 ?$total_paid[0]->price_total:0}}</h2>
																						<p>Total paid amount</p>
																				</div>
																		</div>

																	</div>



																</div>

                                                            <div class="row toolss">

																															<div class="col-xl-6">
                                                                    <button type="button" class="inputSearchYellow"><i class="fa fa-search"></i> Search</button>
                                                                </div>


                                                                <div class="col-xl-6">
                                                                    <div class="btnAQ">
                                                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push toolsmenu" m-dropdown-toggle="hover" aria-expanded="true">


                                                                    </div>

                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">
                                                                      @include("reports.invoice_search")
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

																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>

                                                      {{$invoices->links('vendor.pagination.default')}}

																											<div style="height: 337px;">
																												<div id="incomeExpenseChart" style="width: 100%;height: 100%; background-color: #FFFFFF;" ></div>
																											</div>


														</div>

@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.list_of_invoices')
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


@section('footerjscontent')

   <script type="text/javascript">
			AmCharts.makeChart("incomeExpenseChart",
				{
					"type": "serial",
					"categoryField": "category",
					"startDuration": 1,
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 1,
							"fillColors": "#F4516C",
							"id": "AmGraph-1",
							"lineColor": "#F4516C",
							"title": "Income",
							"type": "column",
							"valueField": "Income"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": ""
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true,
						"useGraphSettings": true
					},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": ""
						}
					],
					"dataProvider": {!! $invoice_by_month_graphic !!},
					"export": {
						"enabled": true
					}
				}
			);
		</script>
@endsection
