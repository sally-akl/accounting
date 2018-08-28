@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">

                                      @lang('app.balance_sheet')
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																															<div class="col-xl-6">

                                                                </div>




                                                            </div>
                                                            <div class="row dataTables">
                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>

                                                                        </th>
                                                                        <th>
                                                                          @lang('app.bank_name')
                                                                        </th>

																																				<th>
                                                                          @lang('app.balance')
                                                                        </th>


                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>

                                                                        @foreach ($accounts as $key => $account)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>
																																								{{$account->bank_name}}
																																						</td>

																																						<td>
                                                                              <?php

                                                                                $income_amount =   $account->transactions->where("transfer_type","income")->sum("transfer_amount");
																																								$expense_amount =   $account->transactions->where("transfer_type","expense")->sum("transfer_amount");
                                                                                $transfer_amount =   $account->transactions->where("transfer_type","transfer")->sum("transfer_amount");


																																								$total = ($account->open_balance + $income_amount + $transfer_amount) - $expense_amount;
																																								echo $total;

																																							 ?>
																																						</td>


																																						<td>

																																							<a href='{{url("transactions/{$account->id}/balanceDetails")}}'>Details</a>

																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

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
												@lang('app.balance_sheet')
											</h3>
											<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
												<li class="m-nav__item m-nav__item--home">
													<a href="#" class="m-nav__link m-nav__link--icon">
														<i class="m-nav__link-icon la la-home"></i>
													</a>
												</li>

											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
