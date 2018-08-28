@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.add_new_discount')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('discount/store') }}">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">
                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.date')  :
                                                                    </label>
                                                                    <input type="text"  name= "bdate" class="form-control m-input" placeholder="{{ __('app.enter_date') }}" id="m_datepicker_1">

                                                                </div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.extra_salary_amount')  :
																																		</label>
																																		<input type="text"  name= "amount" class="form-control m-input" placeholder="{{ __('app.enter_amount') }}">

																																</div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.employee_major')  :
																																		</label>


																																		<div class="row">
																																				<div class="col-xl-9">
																																					<select class="form-control m-input" name="emp_m_id" >

																																								@foreach ($employee_major as $key => $empmaj)
																																									<option value="{{$empmaj->id}}">	{{App\employee::find($empmaj->emplyee_id)->employee_name}} - {{App\major::find($empmaj->major_id)->title}}</option>
																																								@endforeach
																																					</select>

																																				</div>

																																				<div class="col-xl-3" style="padding:11px;">
																																					<a href="{{ url('employeemajor/create/discount') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>New Employee Salary</a>
																																				</div>
																																		</div>

																																	</div>

                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.add_new_discount') }}">


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
												@lang('app.list_of_discount')
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
													<a href='{{url("/discount")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.discount')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("/discount/create")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.add_new_discount')
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
