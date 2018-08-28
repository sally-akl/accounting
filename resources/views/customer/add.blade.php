@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.add_new_customer')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('customer/store') }}">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">
                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.customer_name')  :
                                                                    </label>
                                                                    <input type="text"  name= "fullname" class="form-control m-input" placeholder="{{ __('app.enter_full_name') }}">

                                                                </div>

																																<div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.customer_email')  :
                                                                    </label>
                                                                    <input type="text"  name= "email" class="form-control m-input" placeholder="{{ __('app.enter_customer_email') }}">

                                                                </div>

																																<div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.employee_address')  :
                                                                    </label>
                                                                    <input type="text"  name= "address" class="form-control m-input" placeholder="{{ __('app.enter_customer_address') }}">

                                                                </div>

																																<div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.employee_phone')  :
                                                                    </label>
                                                                    <input type="text"  name= "phone" class="form-control m-input" placeholder="{{ __('app.enter_customer_phone') }}">

                                                                </div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.customer_city')  :
																																		</label>

																																		<select class="form-control m-input" name="city_val" >

																																					@foreach ($citites as $key => $city)
																																						<option value="{{$city->id}}">{{$city->title}}</option>
																																					@endforeach
																																		</select>

																																</div>



                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.add_new_customer') }}">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>

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
												@lang('app.list_of_customer')
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
													<a href='{{url("/customer")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.customer')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("/customer/create")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.add_new_customer')
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
