@extends('layouts.master')

@section('content')


                  <section id="add-table">
                    <div class="container-fluid">
                      <div class="row align-items-center justify-content-center">
                          <div class="card col-lg-12 custyle">
                            <div class="row">
                              <div class="col-lg-12 mg-top25">
                                <label class="form-control-label"><i class="fas fa-cog"></i>  @lang('app.balance_sheet')</label>
                              </div>
                            </div>
														  @include("utility.sucess_message")
                              <table class="table table-striped custab">
                              <thead>

                                  <tr style="text-align: center;">
                                      <th>@lang('app.bank_name')</th>
                                      <th class="text-center">  @lang('app.balance')</th>
																			  <th></th>
                                  </tr>
                              </thead>
															       @foreach ($accounts as $key => $account)
                                      <tr style="text-align: center;">
                                          <td data-label="@lang('app.bank_name')">	{{$account->bank_name}}</td>
                                          <td data-label=" @lang('app.balance')">  <?php

                                                                                $income_amount =   $account->transactions->where("transfer_type","income")->sum("transfer_amount");
																																								$expense_amount =   $account->transactions->where("transfer_type","expense")->sum("transfer_amount");
                                                                                $transfer_amount =   $account->transactions->where("transfer_type","transfer")->sum("transfer_amount");


																																								$total = ($account->open_balance + $income_amount + $transfer_amount) - $expense_amount;
																																								echo $total;

																																							 ?></td>
																					  <td>	<a href='{{url("transactions/{$account->id}/balanceDetails")}}/{{app()->getLocale()}}'>@lang('app.Details')</a></td>
                                      </tr>
																			  @endforeach

                              </table>

                              </div>
                      </div>
                    </div>
                  </section>

@endsection
