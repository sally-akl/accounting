@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">

                                      @lang('app.list_of_salaries')
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

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
                                                                        <a href="{{ url('employeemajor/create/0') }}">
                                                                            <button type="button" class="btnNew"><i class="fa fa-plus"></i>@lang('app.new_employee_salary')</button>
                                                                        </a>
                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">
																																	 @include("salaries.search")
																										         	</div>


                                                            </div>
                                                            <div class="row dataTables">
                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>

                                                                        </th>
                                                                        <th>
                                                                          @lang('app.employee_name')
                                                                        </th>

																																				<th>
                                                                          @lang('app.major_name')
                                                                        </th>

																																				<th>
                                                                          @lang('app.employee_code')
                                                                        </th>

																																				<th>
																																					@lang('app.employee_salary')
																																				</th>


                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>

                                                                        @foreach ($employee_major as $key => $emp_major)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>

																																								{{$emp_major->emplyeeData->employee_name}}
																																						</td>

																																						<td>
																																								{{$emp_major->majorData->title}}
																																						</td>

																																						<td>
																																								{{$emp_major->employee_code}}
                                                                                <a href="{{url("employeemajor/{$emp_major->id}/editcode")}}" style="margin-left: 5px;color: red;">  @lang('app.edit')</a>

																																						</td>

																																						<td>

																																								{{$emp_major->current_salary}}
																																						</td>


																																						<td>

																																						</td>
																																						<td>
																																							<a href="#" class="deleted_btn" data-title="{{$emp_major->id}}">	<i class="la la-trash"></i> </a>

																																							<a href='{{url("employeemajor/{$emp_major->id}/edit")}}'>	<i class="la la-edit"></i></a>
																																							<a href='{{url("employeemajor/{$emp_major->id}/show")}}'>	<i class="la la-eye" data-toggle="modal" data-target="#m_modal_6"></i></a>



																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>

                                                      {{$employee_major->links('vendor.pagination.default')}}


														</div>
														<!--end::Portlet-->


														<script type="text/javascript">
															 $(".deleted_btn").on("click",function(){

																 var id = $(this).attr("data-title");
																 var url_delete = '{{url("employeemajor/index")}}'+"/"+id
																					$.ajax({url: url_delete , success: function(result){

																						   result = JSON.parse(result);
																						   console.log(result);
																							 if(result.sucess)
																							 {
																								   window.location.href = '{{url("/employeemajor")}}';
																							 }
																						}});

																 })



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

											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection