@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.add_new_emp_salary')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('employeemajor/store') }}" class="add_emp_major_form">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

																																	<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																				@lang('app.employee_name')  :
																																			</label>

																																			<div class="row">
																																					<div class="col-xl-9">
																																						<select class="form-control m-input employee_val" name="employee_val" >

																																									@foreach ($employees as $key => $emp)
																																										<option value="{{$emp->id}}">{{$emp->employee_name}}</option>
																																									@endforeach
																																						</select>

																																					</div>

																																					<div class="col-xl-3" style="padding:11px;">
																																						<a href="{{ url('employee/create/employeemajor') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>Add Employee</a>
																																					</div>
																																			</div>


																												            </div>


																																		<div class="form-group m-form__group">
																																				<label for="exampleInputEmail1">
																																					@lang('app.major_name')  :
																																				</label>

																																				<div class="row">
																																						<div class="col-xl-9">
																																							<select class="form-control m-input major_val" name="major_val">

																																										@foreach ($majors as $key => $maj)
																																											<option value="{{$maj->id}}">{{$maj->title}}</option>
																																										@endforeach
																																							</select>



																																						</div>

																																						<div class="col-xl-3" style="padding:11px;">
																																							<a href="{{ url('major/create/employeemajor') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>Add major</a>
																																						</div>
																																				</div>

																													            </div>


																																			<div class="form-group m-form__group">
																																					<label for="exampleInputEmail1">
																																						@lang('app.employee_join_data')  :
																																					</label>

																																					<input type="text"  name= "join_date" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_employee_join_date') }}">

																																			</div>

                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.employee_salary')  :
                                                                    </label>
                                                                    <input type="text"  name= "salary" class="form-control m-input" placeholder="{{ __('app.enter_emp_salary') }}">

                                                                </div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.employee_current')  :
																																		</label>
																																		<input type="checkbox"  name= "is_current" class="is_current">

																																</div>


                                                                <input type="hidden" name="compond_emp_major" class="compond_emp_major" />
																																<input type="hidden" name="compond_emp_major_current" class="compond_emp_major_current" />

                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="button" class="btn btn-success m-btn m-btn--pill add_emp_major" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.add_new_salary') }}">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <input type="hidden" name="where_from" value="{{$where_from}}" />
                                                          </form>



														</div>
														<!--end::Portlet-->


														<script type="text/javascript">
                             $(".add_emp_major").on("click",function()
														 {
															   $(".compond_emp_major").val($(".employee_val").val()+"-"+$(".major_val").val());
                                 $(".compond_emp_major_current").val($(".employee_val").val()+"-"+$(".major_val").val()+"-"+$(".is_current").val());
																 $(".add_emp_major_form").submit();
														 });

														</script>


@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.list_of_salaries')
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
													<a href='{{url("/employeemajor")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.salaries')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("/employeemajor/create")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.add_new_emp_salary')
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
