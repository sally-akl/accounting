@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.add_new_account')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('account/store') }}">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">
                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.bank_name')  :
                                                                    </label>
                                                                    <input type="text"  name= "bankname" class="form-control m-input" placeholder="{{ __('app.enter_bank_name') }}">

                                                                </div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.account_num')  :
																																		</label>
																																		<input type="text"  name= "number" class="form-control m-input" placeholder="{{ __('app.enter_account_num') }}">

																																</div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.location')  :
																																		</label>
																																		<input type="text"  name= "location" class="form-control m-input" placeholder="{{ __('app.enter_location') }}">

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.city')  :
																																		</label>
																																		<input type="text"  name= "city" class="form-control m-input" placeholder="{{ __('app.enter_city') }}">

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.account_open_balance')  :
																																		</label>
																																		<input type="text"  name= "balance" class="form-control m-input" placeholder="{{ __('app.enter_open_balance') }}">

																																</div>



                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.add_new_account') }}">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                         <input type="hidden" name="where_from" value="{{$where_from}}" />
                                                          </form>



														</div>
														<!--end::Portlet-->


@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.add_new_account')
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
												<li class="m-nav__item">
													<a href='{{url("/account")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.account')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("/account/create")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.add_new_account')
														</span>
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
