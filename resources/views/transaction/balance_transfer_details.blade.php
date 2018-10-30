@extends('layouts.master')

@section('content')

                  <section id="add-table">
                    <div class="container-fluid">
                      <div class="row align-items-center justify-content-center">
                          <div class="card col-lg-12 custyle">
                            <div class="row">
                              <div class="col-lg-12 mg-top25">
                                <label class="form-control-label">  @lang('app.Transaction_Details_of')
																			{{$account_title}}</label>
                              </div>
                            </div>
														  @include("utility.sucess_message")
                              <table class="table table-striped custab">
                              <thead>

                                  <tr>
																		<th scope="col">@lang('app.transfer_code')</th>
																		<th scope="col">@lang('app.transfer_type')</th>
																		<th scope="col">@lang('app.Date')</th>
																		<th scope="col">@lang('app.Amount')</th>
																		<th scope="col">@lang('app.Description')</th>
                                  </tr>
                              </thead>
															        @foreach ($transfers as $key => $trans)
                                      <tr>
																				<td data-label="@lang('app.transfer_code')">
																					{{clean($trans->transfer_code_num)}}
																				</td>
                                        <td data-label="@lang('app.transfer_type')">
																						{{clean($trans->transfer_type)}}
																				</td>

																				<td data-label="@lang('app.Date')">
																							{{$trans->transfer_date}}
																				</td>

																				<td data-label="@lang('app.Amount')">
																							{{clean($trans->transfer_amount)}}
																				</td>

																				<td data-label="@lang('app.Description')">
																					 	{{clean($trans->transfer_desc)}}
																				</td>

                                      </tr>
																			  @endforeach

                              </table>
															  {{$transfers->links('vendor.pagination.default')}}

                              </div>
                      </div>
                    </div>
                  </section>


@endsection
