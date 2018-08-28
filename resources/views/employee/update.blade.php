@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.update_employee')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action='{{url("employee/{$employee->id}")}}'>
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">
																																	<div class="form-group m-form__group">
	                                                                    <label for="exampleInputEmail1">
	                                                                      @lang('app.employee_name')  :
	                                                                    </label>
	                                                                    <input type="text"  name= "name" class="form-control m-input" placeholder="{{ __('app.enter_employee_name') }}" value="{{$employee->employee_name}}">

	                                                                </div>

																																	<div class="form-group m-form__group">
	                                                                    <label for="exampleInputEmail1">
	                                                                      @lang('app.employee_email')  :
	                                                                    </label>
	                                                                    <input type="text"  name= "employee_email" class="form-control m-input" placeholder="{{ __('app.enter_employee_email') }}" value="{{$employee->employee_email}}">

	                                                                </div>

																																	<div class="form-group m-form__group">
	                                                                    <label for="exampleInputEmail1">
	                                                                      @lang('app.employee_address')  :
	                                                                    </label>
	                                                                    <input type="text"  name= "address" class="form-control m-input" placeholder="{{ __('app.enter_employee_address') }}" value="{{$employee->employee_address}}">

	                                                                </div>

																																	<div class="form-group m-form__group">
	                                                                    <label for="exampleInputEmail1">
	                                                                      @lang('app.employee_phone')  :
	                                                                    </label>
	                                                                    <input type="text"  name= "phone" class="form-control m-input" placeholder="{{ __('app.enter_employee_phone') }}" value="{{$employee->employee_phone}}">

	                                                                </div>


																																	<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																				@lang('app.employee_status')  :
																																			</label>
																																			<select class="form-control m-input" name="status">
																																						<option value="1" {{$employee->employee_status == 1 ?"selected":""}}>Active</option>
																																						<option value="2" {{$employee->employee_status == 2 ?"selected":""}}>Not active</option>
																																			</select>

																																	</div>

																																	<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																				@lang('app.employee_join_data')  :
																																			</label>

																																			<input type="text"  name= "join_date" class="form-control m-input" value="{{date('Y-m-d',strtotime($employee->employee_join_date))}}" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_employee_join_date') }}">

																																	</div>


																																	<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																				@lang('app.employee_details')  :
																																			</label>
																																		   <textarea rows="10" cols="70" name="details">{{$employee->employee_details}}</textarea>
																																	</div>
                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.update_employee') }}">


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
												@lang('app.list_of_employee')
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
													<a href='{{url("/employee")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.employee')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("employee/{$employee->id}/edit")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.update_employee')
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
