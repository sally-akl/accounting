@extends('layouts.master')

@section('content')

						<!--Begin::Section-->
						<div class="row">
                            <div class="m--full-height col-md-6">
                                <div class="m-portlet m-portlet--tab">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
											    	@lang('app.latest_icome_expense')
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
								        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th scope="col">#</th>
                                              <th scope="col">@lang('app.Amount')</th>
                                              <th scope="col">@lang('app.Type')</th>
                                              <th scope="col">@lang('app.Date')</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                               @foreach ($latest_tranation as $key => $trans)

                                               <tr>
                                                 <th scope="row">{{$key+1}}</th>
                                                 <td>{{$trans->transfer_amount}}</td>
                                                 <td>{{$trans->transfer_type}}</td>
                                                 <td>{{$trans->transfer_date}}</td>
                                               </tr>
                                               @endforeach

                                        </tbody>
                                        </table>
									</div>
								</div>
                            </div>
                            <div class="col-md-6">
								<!--begin::Portlet-->
								<div class="m-portlet m-portlet--tab">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Chart Income &amp; Expense
												</h3>
											</div>
										</div>
									</div>
									<!-- amCharts javascript code -->

									<div class="m-portlet__body p-0">
											<div style="height: 337px;">
												<div id="incomeExpenseChart" style="width: 100%;height: 100%; background-color: #FFFFFF;" ></div>
											</div>
									</div>

								</div>

								<!--end::Portlet-->

                            </div>
							<div class="col-xl-5">
                                <div class="m-portlet m-portlet--tab">



										<!--end:: Widgets/Profit Share-->
										<div class="m-portlet__head">
												<div class="m-portlet__head-caption">
													<div class="m-portlet__head-title">
														<span class="m-portlet__head-icon m--hide">
															<i class="la la-gear"></i>
														</span>
														<h3 class="m-portlet__head-text">
															Chart title
														</h3>
													</div>
												</div>
											</div>
										<div id="chart2" style="height: 232px;" class="mx-auto">

										</div>
                                </div>
							</div>
							<div class="col-xl-7">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="row expnesesStat statDashboard mx-auto">
                                            <div class="col-xl-2 iconStat">
                                                <i class="la la-arrow-up"></i>
                                            </div>
                                            <div class="col-xl-10">
                                                <h2>{{$total_expense}}</h2>
                                                <p>@lang('app.total_expense')</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row incomesStat statDashboard mx-auto">
                                            <div class="col-xl-2">
                                                <i class="la la-arrow-down"></i>
                                            </div>
                                            <div class="col-xl-10">
                                                <h2>{{$total_income}}</h2>
                                                <p>@lang('app.total_income')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="row usersStat statDashboard mx-auto">
                                            <div class="col-xl-2">
                                                <i class="la la-user"></i>
                                            </div>
                                            <div class="col-xl-10">
                                                <h2>{{$total_users}}</h2>
                                                <p>@lang('app.total_users')</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row invoicesStat statDashboard mx-auto">
                                            <div class="col-xl-2">
                                                <i class="la la-file-text-o"></i>
                                            </div>
                                            <div class="col-xl-10 ">
                                                <h2>{{$total_invoices}}</h2>
                                                <p>	@lang('app.total_invoice')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>

						<!--End::Section-->


            <!--Begin::Section-->
                            <div class="row">
                                    <!-- Begin Latest Income -->

                             <div class="m--full-height col-md-6">
                                <div class="m-portlet m-portlet--tab latestIncomm">
									<div class="m-portlet__head__latest">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text m--align-center">
													@lang('app.latest_icome')
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
								        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th scope="col">#</th>
                                              <th scope="col">@lang('app.Date')</th>
                                              <th scope="col">@lang('app.Amount')</th>
                                              <th scope="col">@lang('app.Description')</th>
                                            </tr>
                                          </thead>
                                          <tbody>

                                            @foreach ($latest_income as $key => $trans)

                                            <tr>
                                              <th scope="row">{{$key+1}}</th>
                                              <td>{{$trans->transfer_date}}</td>
                                              <td>{{$trans->transfer_amount}}</td>
                                              <td>{{$trans->transfer_desc}}</td>
                                            </tr>
                                            @endforeach



                                        </tbody>
                                        </table>
									</div>
								</div>
                            </div>

                             <!-- End Latest Income -->

                                <div class="m--full-height col-md-6">
                                <div class="m-portlet m-portlet--tab latestIncomm">
									<div class="m-portlet__head__expense">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text m--align-center">
												@lang('app.latest_expense')
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
								        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th scope="col">#</th>
                                              <th scope="col">@lang('app.Date')</th>
                                              <th scope="col">@lang('app.Amount')</th>
                                              <th scope="col">@lang('app.Description')</th>
                                            </tr>
                                          </thead>
                                          <tbody>

                                            @foreach ($latest_outcome as $key => $trans)
                                              <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$trans->transfer_date}}</td>
                                                <td>{{$trans->transfer_amount}}</td>
                                                <td>{{$trans->transfer_desc}}</td>
                                              </tr>
                                            @endforeach

                                        </tbody>
                                        </table>
									</div>
								</div>
                            </div>

                                    <!-- End Latest Expense -->

						</div>

						<div class="row">

							<div class="m--full-height col-md-12">
							<div class="m-portlet m-portlet--tab latestIncomm">
<div class="m-portlet__head__expense">
	<div class="m-portlet__head-caption">
		<div class="m-portlet__head-title">
			<span class="m-portlet__head-icon m--hide">
				<i class="la la-gear"></i>
			</span>
			<h3 class="m-portlet__head-text m--align-center">
			@lang('app.invoices_must_paid_today')
			</h3>
		</div>
	</div>
</div>
<div class="m-portlet__body">
			<table class="table table-bordered">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col">@lang('app.customer_name')</th>
														<th scope="col">@lang('app.customer_amount')</th>
														<th scope="col">@lang('app.customer_invoice_date')</th>
														<th scope="col">  @lang('app.invoice_status')</th>
													</tr>
												</thead>
												<tbody>

													@foreach ($invoices_due_to_today as $key => $invoice)
														<tr>
															<th scope="row">{{$key+1}}</th>
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

														</tr>
													@endforeach

											</tbody>
											</table>
</div>
</div>
					</div>



						</div>

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
						},
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 1,
							"fillColors": "#34BFA3",
							"id": "AmGraph-2",
							"lineColor": "#34BFA3",
							"title": "Expense",
							"type": "column",
							"valueField": "Expense"
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
					"dataProvider": [
						{
							"category": "01-07-2018",
							"Income": 8,
							"Expense": 5
						},
						{
							"category": "02-07-2018",
							"Income": 6,
							"Expense": 7
						},
						{
							"category": "03-07-2018",
							"Income": 2,
							"Expense": 3
						},
						{
							"category": "04-07-2018",
							"Income": "4",
							"Expense": "6"
						},
						{
							"category": "05-07-2018",
							"Income": "8",
							"Expense": "4"
						}



					],
					"export": {
						"enabled": true
					}
				}
			);
		</script>

		<script>
  		Morris.Donut({
  			element: 'chart2',
  			resize:true,
  			data: [
  				{label: "Type1", value: 50},
  				{label: "Type2", value: 50},

  			],
  			colors: [
  				'#00c5dc',
  				'#716aca',

  			],
  			formatter: function (x) { return x + "%"}

  			});
		</script>
@endsection

@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.ibtekar_dashboard')
											</h3>

										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
