@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
                                      @if($trans_type == "bydate")
                                        @lang('app.income_expense_by_date')
																			@elseif($trans_type == "byrange")
                                        @lang('app.income_expense_by_range')

																			@endif
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")


																<div class="row">
																	<div class="col-xl-3" style="margin-left: 81px;">

																		<div class="row  incomesStat   statDashboard2 mx-auto" style="width: 290px;margin-top: 11px;">
																				<div class="col-xl-2 iconStat">

																				</div>
																				<div class="col-xl-10">
																						<h2>{{$total_income}}</h2>
																						<p>@lang('app.total_income')</p>
																				</div>
																		</div>

																	 </div>


																	 <div class="col-xl-3" style="margin-left: 81px;">

																		 <div class="row expnesesStat   statDashboard2 mx-auto" style="width: 290px;margin-top: 11px;">
																				 <div class="col-xl-2 iconStat">

																				 </div>
																				 <div class="col-xl-10">
																						 <h2>{{$total_expense}}</h2>
																						 <p>@lang('app.total_expense')</p>
																				 </div>
																		 </div>

																		</div>


																</div>

                                                            <div class="row toolss">

																															<div class="col-xl-6">

                                                                        <button type="button" class="inputSearchYellow"><i class="fa fa-search"></i> Search</button>


                                                                </div>


                                                                <div class="col-xl-6">
                                                                    <div class="btnAQ">
                                                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push toolsmenu" m-dropdown-toggle="hover" aria-expanded="true">
                                                                      <!--  <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" id="delett">
                                                                            <i class="la la-plus m--hide"></i>
                                                                            <i class="la la-ellipsis-h"></i>
                                                                        </a>
																																			-->
                                                                        <div class="m-dropdown__wrapper ">
                                                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                                            <div class="m-dropdown__inner deleteAllItem">
                                                                                <div class="m-dropdown__body deletebody">
                                                                                    <div class="m-dropdown__content">
                                                                                        <ul class="m-nav">
                                                                                            <li class="m-nav__section m-nav__section--first m--hide">
                                                                                                <span class="m-nav__section-text">
                                                                                                    Quick Actions
                                                                                                </span>
                                                                                            </li>
                                                                                            <li class="m-nav__item">
                                                                                                <a href="" class="m-nav__link">
                                                                                                    <span class="m-nav__link-text">
                                                                                                        <i class="la la-trash"></i> Delete All
                                                                                                    </span>
                                                                                                </a>
                                                                                            </li>

                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>





                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">

																																      @include("reports.search")

																										         	</div>


                                                            </div>


                                                            <div class="row dataTables">
                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>

                                                                        </th>
																																				<th>@lang('app.transfer_code')</th>
																																				<th>@lang('app.transfer_type')</th>
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
																																								{{$trans->transfer_type}}
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


														</div>
														<!--end::Portlet-->




@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@if($trans_type == "bydate")
													@lang('app.income_expense_by_date')
												@elseif($trans_type == "byrange")
													@lang('app.income_expense_by_range')
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
