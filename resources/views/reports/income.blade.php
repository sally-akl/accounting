@extends('layouts.master')

@section('content')
<section id="statistcs-invoice">
				 <div class="container-fluid">
					 <div class="row cart-top has-shadow">


						 <div class="col-lg-4">
							 <div class="row red3">
								 <div class="col-2 col-lg-2">
									 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-long-arrow-alt-up"></i>
								 </div>
								 <div class="col-10 col-lg-10">
									 <h1>{{$total}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</h1>
									 <br>
									 <p>@lang('app.Total')</p>
								 </div>


							 </div>
						 </div>
						 <div class="col-lg-4">
							 <div class="row green3">
								 <div class="col-2 col-lg-2">
									 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-long-arrow-alt-up"></i>
								 </div>
								 <div class="col-10 col-lg-10">
									 <h1>{{$total_week}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</h1>
									 <br>
									 <p>@lang('app.Total_this_week')</p>
								 </div>


							 </div>
						 </div>
						 <div class="col-lg-4">
							 <div class="row blue3">
								 <div class="col-2 col-lg-2">
									 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-long-arrow-alt-up"></i>
								 </div>
								 <div class="col-10 col-lg-10">
									 <h1>{{$total_month}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</h1>
									 <br>
									 <p>@lang('app.Total_this_month')</p>
								 </div>


							 </div>
						 </div>

					 </div>
				 </div>
			 </section>

			 <section id="add-table">
				 <div class="container-fluid">
					 <div class="row align-items-center justify-content-center">
						 <div class="card col-lg-12 custyle">
							 <div class="row">
								 <div class="col-lg-12 mg-top25">
									 <label class="form-control-label">
										                 @if($trans_type == "income")
																				@lang('app.list_of_income')
																			@elseif($trans_type == "expense")
																				@lang('app.list_of_expense')
                                       @endif
																		 </label>
								 </div>
							 </div>
							 <table class="table table-striped custab">
								 <thead>
									 <tr>
										 <th>@lang('app.transfer_code')</th>
										 <th>@lang('app.Date')</th>

										 <th>@lang('app.Description')</th>
										 <th scope="col">
											 @lang('app.submit_user_name')
										</th>
										 <th>@lang('app.Amount')</th>
                      <th scope="col">@lang('app.amount_after_trans')</th>
									 </tr>
								 </thead>
								 <tbody>
									    @php $total_amount = 0 ;  @endphp
									   @foreach ($transfers as $key => $trans)
									 <tr>
										 <td data-label="@lang('app.transfer_code')">	{{clean($trans->transfer_code_num)}}</td>
										 <td data-label="@lang('app.Date')">	{{$trans->transfer_date}}</td>

										  <td data-label="@lang('app.Description')">{{clean($trans->transfer_desc)}}</td>
											<td data-label="@lang('app.submit_user_name')">	{{$trans->users != null ?$trans->users->name:""	}}

											</td>
											<td data-label="@lang('app.Amount')">	{{clean($trans->transfer_amount)}} {{\App\classes\Common::getCurrencyText($trans->currancy)}}</td>
                      <td data-label="@lang('app.amount_after_trans')">	{{clean($trans->converted_transfer_amount)}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</td>
									 </tr>
									   @php $total_amount += $trans->converted_transfer_amount ;  @endphp
									   @endforeach

										 <tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
                        <td></td>
												<td>@lang('app.Total') : {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}} {{$total_amount}} </td>
										 </tr>

								 </tbody>
							 </table>

							 {{$transfers->links('vendor.pagination.default')}}
						 </div>
					 </div>
				 </div>
			 </section>
			 <section id="chart2">

					 <div class="col-lg-12">
						 <div class="line-chart-month card">
                <div class="card-body">
									<div style="height: 337px;">
							        <div id="incomeExpenseChart" style="width: 100%;height: 100%; background-color: #FFFFFF;" ></div>
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
