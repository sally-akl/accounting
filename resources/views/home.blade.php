@extends('layouts.master')

@section('content')

<!-- Dashboard Header Section    -->
<section class="dashboard-header">
	<div class="container-fluid">
		<div class="row">

			<!-- Line Chart   -->

			<div class="chart col-lg-6 col-12">
				<!-- Bar Chart   -->
				<div class="bar-chart left-cart has-shadow bg-white">


					<div class="card">

						<div class="card-header d-flex align-items-center">
							<h3 class="h4">	@lang('app.latest_icome_expense')</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
										  <th>@lang('app.customer_amount')</th>
											<th>@lang('app.Type')</th>
											<th>@lang('app.Date')</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($latest_tranation as $key => $trans)

											<tr>
														<th scope="row">{{$key+1}}</th>
														<td>{{$trans->transfer_amount}} {{\App\classes\Common::getCurrencyText($trans->currancy)}} </td>
														<td>{{$trans->transfer_type}}</td>
														<td>{{date("Y-m-d",strtotime($trans->transfer_date))}}</td>
											</tr>
												@endforeach


									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
				<!-- Numbers-->

			</div>
			<div class="col-lg-6 card " style="height: auto;">
				<h3 class="chart-title">	@lang('app.income_expense_chart') of month {{date('m')}}</h3>
				<div class="bar-chart-example ">
					<div class="card-body">

						<div style="height: 271px;">
							<div id="incomeExpenseChart" style="width: 100%;height: 100%; background-color: #FFFFFF;" ></div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Projects Section-->
<section class="client no-padding-top">
	<div class="container-fluid">
		<div class="row">
			<!-- Work Amount  -->
			<div class="col-lg-5">
				<div class="work-amount card">

					<div class="card-body">
						<h3>@lang('app.income_expernse_total')</h3>

						<div class="chart text-center">

											<div id="chart2" style="height: 232px;"  class="mx-auto">
					 					</div>
                    </div>

               </div>

				</div>
			</div>
			<div class="col-lg-7 cart-right has-shadow">

				<div class="row f-child">
					<div class="col-12 col-lg-6">

						<div class="row red">
							<div class="col-4 col-xl-4">
								<i style="color: #dedede66;font-size: 50px;line-height: 1.5;" class="far fa-money-bill-alt"></i>
							</div>
							<div class="col-8 col-xl-8">
								<h1>{{$total_expense}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</h1>
								<br>
								<p>@lang('app.total_expense')</p>
							</div>


						</div>

					</div>

					<div class="col-12 col-lg-6">

                    <div class="row blue">
                        <div class="col-4 col-xl-4">
                            <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-long-arrow-alt-up"></i>
                          </div>
                          <div class="col-8 col-xl-8">
                            <h1>{{$total_income}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</h1>
                            <br>
                            <p>@lang('app.total_income')</p>
                          </div>

                    </div>


                  </div>


				</div>

				<div class="row">
					<div class="col-12 col-lg-6">

						<div class="row green">
								<div class="col-4 col-xl-4">
									<i style="color: #dedede66;font-size: 55px;line-height: 1.6;" class="fas fa-file-invoice"></i>
								</div>
									<div class="col-8 col-xl-8">
										<h1>{{$total_users}}</h1>
										<br>
										<p>@lang('app.total_users')</p>
									</div>


						</div>


					</div>
					<div class="col-12 col-lg-6">

						<div class="row orange">
								<div class="col-4 col-xl-4">
									<i style="color: #dedede66;font-size: 50px;line-height: 1.7;" class="fas fa-sort-amount-up"></i>
								</div>
									<div class="col-8 col-xl-8">
										<h1>{{$total_invoices}}</h1>
										<br>
										<p>@lang('app.total_invoice')</p>
									</div>


						</div>


					</div>

				</div>


			</div>



		</div>
	</div>
</section>







        <!-- table Section-->
        <section class="tables">
          <div class="container-fluid">
            <div class="row">

              <div class="col-lg-6">
                <div class="card">

                  <div class="card-header d-flex align-items-center">
                    <h3 class="h4">@lang('app.latest_icome')</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
														<th>#</th>
																						<th>@lang('app.Date')</th>
																						<th>@lang('app.customer_amount')</th>

                          </tr>
                        </thead>
                        <tbody>
													@foreach ($latest_income as $key => $trans)

																				 <tr>
																					 <th scope="row">{{$key+1}}</th>
																					 <td>{{date("Y-m-d",strtotime($trans->transfer_date))}}</td>
																					 <td>{{$trans->transfer_amount}} {{\App\classes\Common::getCurrencyText($trans->currancy)}}</td>

																				 </tr>
																				 @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">

                  <div class="card-header d-flex align-items-center">
                    <h3 class="h4">@lang('app.latest_expense')</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
													<tr>
                                              <th>#</th>
                                              <th>@lang('app.Date')</th>
                                              <th>@lang('app.customer_amount')</th>

                                            </tr>
                        </thead>
                        <tbody>
													@foreach ($latest_outcome as $key => $trans)
																						<tr>
																							<th scope="row">{{$key+1}}</th>
																							<td>{{date("Y-m-d",strtotime($trans->transfer_date))}}</td>
																							<td>{{$trans->transfer_amount}}{{\App\classes\Common::getCurrencyText($trans->currancy)}}</td>

																						</tr>
																					@endforeach


                        </tbody>
                      </table>
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
							"fillColors": "#34BFA3",
							"id": "AmGraph-1",
							"lineColor": "#34BFA3",
							"title": "Income",
							"type": "column",
							"valueField": "Income"
						},
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 1,
							"fillColors": "#F4516C",
							"id": "AmGraph-2",
							"lineColor": "#F4516C",
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
					"dataProvider": {!! $expense_income_chart !!},
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
  			data: {!! $expense_income_circle !!},
  			colors: [
  				'#00c5dc',
  				'#716aca',

  			],
  			formatter: function (x) { return x }

  			});
		</script>
@endsection
