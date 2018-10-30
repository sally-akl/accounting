@extends('layouts.master')

@section('content')
<section id="add-form">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-center">
                                <div class="card col-lg-12 padding20">
                                  <div class="row">
                                  <div class="col-lg-8 mg-top25">
                                      <label class=" form-control-label">

                                        @lang('app.expense_by_category')

																		</label>
                                      </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-12 mg-top30">
																					<form method="get" action="{{ url('reports/category/search') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" >
                                                       @csrf


                                                       <div class="form-group row">
                                                           <label class="col-sm-3 form-control-label label-sm">{{ __('app.category') }}</label>
                                                            <div class="col-sm-9">

                                                              <select name="expense_val" class="form-control">

                                                                     @foreach ($expense_type as $key => $exp)
                                                                      <option value="{{$exp->id}}">{{$exp->title}}</option>
                                                                     @endforeach

                                                              </select>


                                                             </div>
                                                         </div>


                                                        <div class="form-group row">
                                                            <label class="col-sm-3 form-control-label label-sm">{{ __('app.date_from') }}</label>
                                                             <div class="col-sm-9">
                                                                  <input id="inputHorizontalSuccess" placeholder="{{ __('app.enter_date_from') }}" name= "transfer_from" class="form-control form-control-success" type="date">
                                                              </div>
                                                          </div>


        																									<div class="form-group row">
        																										 <label class="col-sm-3 form-control-label label-sm">{{ __('app.date_to') }}</label>
        																											<div class="col-sm-9">
        																													 <input id="inputHorizontalSuccess" placeholder="{{ __('app.enter_date_to') }}" name= "transfer_to" class="form-control form-control-success" type="date">
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

                                  @php $total_amount += $trans->converted_transfer_amount ;  @endphp

                                </tr>
																  @endforeach
                                  <tr>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td>@lang('app.Total') : {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}} {{$total_amount}}</td>
                                  </tr>


                              </tbody>
                            </table>

                            {{$transfers->links('vendor.pagination.default')}}
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
@endsection
