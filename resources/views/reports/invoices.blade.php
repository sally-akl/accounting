@extends('layouts.master')

@section('content')
<section id="add-form">
				 <div class="container-fluid">
					 <div class="row">
						 <div class="card col-lg-8 " style="padding: 13px;">
							 <div class="row">
								 <div class="col-lg-3 mg-top25">
									 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i>@lang('app.Search')</label>
								 </div>
							 </div>
							 <div class="row">
								 <div class="col-lg-12 mg-top30">

									 @include("reports.invoice_search")
								 </div>
							 </div>

						 </div>
						 <div class="col-lg-4">



							 <div class="col-lg-12">
								 <div class="row blue2">
									 <div class="col-2 col-xl-2">
										 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-long-arrow-alt-up"></i>
									 </div>
									 <div class="col-10 col-xl-10">
										 <h1>{{$invoice_num}}</h1>
										 <br>
										 <p>@lang('app.Total')</p>
									 </div>
								 </div>


							 </div>

							 <div class="col-lg-12">

								 <div class="row green2">
									 <div class="col-2 col-xl-2">
										 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-long-arrow-alt-up"></i>
									 </div>
									 <div class="col-10 col-xl-10">
										 <h1>{{$total_paid}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</h1>
										 <br>
										 <p>@lang('app.Total_paid_amount')</p>
									 </div>

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
									 <label class="form-control-label"> @lang('app.list_of_invoices')</label>
								 </div>
							 </div>
							 <table class="table table-striped custab">
								 <thead>
									 <tr>
										 <th>
																																				 @lang('app.customer_name')
																																			 </th>



																																			 <th>
																																				 @lang('app.customer_invoice_date')
																																			 </th>

																																			 <th>
																																				 @lang('app.invoice_status')
																																			 </th>

																																			 <th scope="col">
																																				 @lang('app.submit_user_name')
																																			</th>

																																			 <th>
																																				@lang('app.customer_amount_invoice')
																																			</th>


									 </tr>
								 </thead>
								 <tbody>
									   @foreach ($invoices as $key => $invoice)
									 <tr>
										 <td data-label="@lang('app.customer_name')">	{{clean($invoice->CustomerData->full_name)}}</td>

										 <td data-label="@lang('app.customer_invoice_date')">	{{ date("Y-m-d",strtotime($invoice->invoice_date))}}</td>
										 <td data-label="@lang('app.invoice_status')">  {{clean($invoice->invoice_status)}}</td>
										 <td data-label="@lang('app.submit_user_name')">	{{$invoice->users != null ?$invoice->users->name:""	}}

										 </td>

										 <td data-label="@lang('app.customer_amount_invoice')"> <?php
                                                                                        $price = 0 ;

                                                                                      //  print_r($invoice->services);
                                                                                       foreach ($invoice->services as $key => $service)
                                                                                         {
                                                                                            if($service->pivot->invoice_type == $invoice->invoice_item_type)
                                                                                               $price += clean($service->pivot->qty) * clean($service->pivot->price);

                                                                                         }

                                                                                         $discount_value = clean($invoice->discount_amount);
                                                                                         if($invoice->discount_type != "amount")
																																												 {
																																													    $discount_value = ($price * clean($invoice->discount_amount)) /100;
																																												 }
																																												 $price =  $price - $discount_value;
																																												 $cu = \App\classes\Common::getCurrencyText($invoice->currancy);

                                                                                         echo $price." ".$cu;
                                                                                 ?>

                                                  </td>



									 </tr>
									   @endforeach

								 </tbody>
							 </table>

							   {{$invoices->links('vendor.pagination.default')}}
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
					"dataProvider": {!! $invoice_by_month_graphic !!},
					"export": {
						"enabled": true
					}
				}
			);
		</script>
@endsection
