@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
                                      @lang('app.Transaction_Details_of')
																			{{$account_title}}
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																																<div class="row advancedSearch">

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
												@lang('app.Transaction_Details_of')
												{{$account_title}}
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
