@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																			@if($trans_type == "income")
																				@lang('app.list_of_income')
																			@elseif($trans_type == "expense")
																				@lang('app.list_of_expense')
                                       @endif

																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																															<div class="col-xl-6">


                                                              </div>

																																<div class="row advancedSearch">

																										         	  </div>

                                                             <div class="row">
																																<div class="col-xl-3" style="margin-left: 81px;">

																																	<div class="row {{$trans_type=='expense'?'expnesesStat':'incomesStat'}}   statDashboard2 mx-auto">
													                                            <div class="col-xl-2 iconStat">

													                                            </div>
													                                            <div class="col-xl-10">
													                                                <h2>{{$total}}</h2>
													                                                <p>Total</p>
													                                            </div>
													                                        </div>

                                                                </div>

																																<div class="col-xl-3">
																																	<div class="row {{$trans_type=='expense'?'expnesesStat':'incomesStat'}}   statDashboard2 mx-auto">
																																			<div class="col-xl-2 iconStat">

																																			</div>
																																			<div class="col-xl-10">
																																					<h2>{{$total_week}}</h2>
																																					<p>Total  this week</p>
																																			</div>
																																	</div>


                                                                </div>

																																<div class="col-xl-3">
																																	<div class="row {{$trans_type=='expense'?'expnesesStat':'incomesStat'}}   statDashboard2 mx-auto">
																																			<div class="col-xl-2 iconStat">

																																			</div>
																																			<div class="col-xl-10">
																																					<h2>{{$total_month}}</h2>
																																					<p>Total  this month</p>
																																			</div>
																																	</div>

                                                                </div>
                                                              </div>



                                                            </div>
                                                            <div class="row dataTables">
                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>

                                                                        </th>
																																				<th>@lang('app.transfer_code')</th>
																																				<th>@lang('app.Date')</th>
																																				<th>@lang('app.Amount')</th>
																																				<th>@lang('app.Description')</th>


                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>

                                                                        @foreach ($transfers as $key => $trans)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>
																																								{{$trans->transfer_code_num}}
																																						</td>

																																						<td>
																																								{{$trans->transfer_date}}
																																						</td>

																																						<td>
																																							{{$trans->transfer_amount}}
																																						</td>

																																						<td>
																																						{{$trans->transfer_desc}}
																																						</td>


																																						<td>

																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>

                                                      {{$transfers->links('vendor.pagination.default')}}


                                                      <div style="height: 337px;">
																												<div id="incomeExpenseChart" style="width: 100%;height: 100%; background-color: #FFFFFF;" ></div>
																											</div>


														</div>
														<!--end::Portlet-->


@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@if($trans_type == "income")
													@lang('app.list_of_income')
												@elseif($trans_type == "expense")
													@lang('app.list_of_expense')
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
					"dataProvider": {!! $transaction_by_month_graphic !!},
					"export": {
						"enabled": true
					}
				}
			);
		</script>
@endsection
