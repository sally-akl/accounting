@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.update_salary')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action='{{url("employeemajor/{$employee_major->id}")}}'>
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

																																	<div class="form-group m-form__group">
 																																		 <label for="exampleInputEmail1">
 																																			 @lang('app.employee_name')  :
 																																		 </label>
 																																		 <select class="form-control m-input" name="employee_val" disabled>

 																																					 @foreach ($employees as $key => $emp)
 																																						 <option value="{{$emp->id}}"  {{$emp->id == $employee_major->emplyee_id?"selected":"" }}>{{$emp->employee_name}}</option>
 																																					 @endforeach
 																																		 </select>

 																																	 </div>


 																																	 <div class="form-group m-form__group">
 																																			 <label for="exampleInputEmail1">
 																																				 @lang('app.major_name')  :
 																																			 </label>
 																																			 <select class="form-control m-input" name="major_val" disabled>

 																																						 @foreach ($majors as $key => $maj)
 																																							 <option value="{{$maj->id}}"  {{$maj->id == $employee_major->major_id?"selected":"" }}>{{$maj->title}}</option>
 																																						 @endforeach
 																																			 </select>

 																																		 </div>


 																																		 <div class="form-group m-form__group">
 																																				 <label for="exampleInputEmail1">
 																																					 @lang('app.employee_join_data')  :
 																																				 </label>

 																																				 <input type="text"  name= "join_date" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_employee_join_date') }}" value="{{$employee_major->join_date}}" disabled>

 																																		 </div>

 																															 <div class="form-group m-form__group">
 																																	 <label for="exampleInputEmail1">
 																																		 @lang('app.employee_salary')  :
 																																	 </label>
 																																	 <input type="text"  name= "salary" class="form-control m-input" placeholder="{{ __('app.enter_emp_salary') }}" value="{{$employee_major->current_salary}}">

 																															 </div>


 																															 <div class="form-group m-form__group">
 																																	 <label for="exampleInputEmail1">
 																																		 @lang('app.employee_current')  :
 																																	 </label>
 																																	 <input type="checkbox"  name= "is_current" {{$employee_major->is_current == 1?"checked":"" }}>

 																															 </div>






                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.update_salary') }}">


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
													<a href='{{url("employeemajor/{$employee_major->id}/edit")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.update_salary')
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
