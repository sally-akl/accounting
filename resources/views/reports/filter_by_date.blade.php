@extends('layouts.master')

@section('content')
<section id="add-form">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-center">
                                <div class="card col-lg-12 padding20">
                                  <div class="row">
                                  <div class="col-lg-8 mg-top25">
                                        <label class=" form-control-label">  @if($trans_type == "bydate")
                                        @lang('app.income_expense_by_date2')
																			@elseif($trans_type == "byrange")
                                        @lang('app.income_expense_by_range')

																			@endif</label>
                                      </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-12 mg-top30">
																					<form method="get" action="{{ url('reports/search') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" >
                                                       @csrf


                                                <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">{{ __('app.date_from') }}</label>
                                                        <div class="col-sm-9">
                                                          <input id="inputHorizontalSuccess" placeholder="{{ __('app.enter_date_from') }}" name= "transfer_from" class="form-control form-control-success" type="date">
                                                        </div>
                                                      </div>

																											@if($trans_type == "byrange")

																											<div class="form-group row">
																															<label class="col-sm-3 form-control-label label-sm">{{ __('app.date_to') }}</label>
																															<div class="col-sm-9">
																																<input id="inputHorizontalSuccess" placeholder="{{ __('app.enter_date_to') }}" name= "transfer_to" class="form-control form-control-success" type="date">
																															</div>
																														</div>

																											@endif

                                                        <input type="hidden" name="transfer_type" value="{{$trans_type}}" />

                                              <div class="form-group row">
                                                  <label class="col-sm-3 form-control-label label-sm">@lang('app.total_income')</label>
                                                  <div class="col-sm-9">
                                                    {{$total_income}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">@lang('app.total_expense')</label>
                                                        <div class="col-sm-9">
                                                        {{$total_expense}}  {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}
                                                        </div>
                                                      </div>
                                                <button type="submit" class="btn btn-primary">@lang('app.Filter') </button>

                                              </form>

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
                               <button class="btn btn-primary2 hidden-print small-sc-btn "><i class="far fa-file-pdf"></i> PDF </button>
                               <button class="btn btn-primary hidden-print small-sc-btn3 print"><i class="fas fa-print"></i>@lang('app.print')  </button>
                               </div>
                            </div>
                            <table class="table table-striped custab" id="print_tb">

                              <thead>
                                <tr>
																	<th>@lang('app.transfer_code')</th>
																																			<th>@lang('app.transfer_type')</th>
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
                                  <td data-label="@lang('app.transfer_type')">	{{clean($trans->transfer_type)}}</td>
                                  <td data-label="@lang('app.Date')">	{{$trans->transfer_date}}</td>

																	<td data-label="@lang('app.Description')">{{clean($trans->transfer_desc)}}</td>
                                  <td data-label="@lang('app.submit_user_name')">	{{$trans->users != null ?$trans->users->name:""	}}

                                  </td>
                                  	<td data-label="@lang('app.Amount')">	{{clean($trans->transfer_amount)}}  {{\App\classes\Common::getCurrencyText($trans->currancy)}}</td>
                                    <td data-label="@lang('app.amount_after_trans')">	{{clean($trans->converted_transfer_amount)}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</td>

                                </tr>
                                  @php $total_amount += $trans->converted_transfer_amount ;  @endphp
																  @endforeach


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
  $(".print").on("click",function()
  {
      printJS('print_tb', 'html')
  });
</script>

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

@endsection
