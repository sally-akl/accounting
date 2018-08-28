@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">

                                      @lang('app.list_of_employee')
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
                                                                        <a href="{{ url('employee/create/0') }}">
                                                                            <button type="button" class="btnNew"><i class="fa fa-plus"></i>@lang('app.new_employee')</button>
                                                                        </a>
                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">
																																	 @include("employee.search")
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
                                                                          @lang('app.employee_email')
                                                                        </th>

																																				<th>
																																					@lang('app.employee_status')
																																				</th>

																																				<th>
																																					@lang('app.employee_join_data')
																																				</th>


                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>

                                                                        @foreach ($employees as $key => $employee)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>
																																								{{$employee->employee_name}}
																																						</td>

																																						<td>
																																								{{$employee->employee_email}}
																																						</td>

                                                                            @if($employee->employee_status == 1)
																																						<td class="balanceColor">
	                                                                             <span class="m-badge m-badge--success m-badge--wide">
									 								                                                {{$status[$employee->employee_status]}}
									 							                                                 </span>
								                                                             </td>
                                                                            @else

																																						<td class="balanceColor">
																																								 <span class="m-badge m-badge--danger m-badge--wide">
																																										 {{$status[$employee->employee_status]}}
																																										</span>
																																						 </td>
																																						@endif




																																						<td>
																																								{{ date("Y-m-d",strtotime($employee->employee_join_date))}}
																																						</td>


																																						<td>

																																						</td>
																																						<td>
																																							<a href="#" class="deleted_btn" data-title="{{$employee->id}}">	<i class="la la-trash"></i> </a>

																																							<a href='{{url("employee/{$employee->id}/edit")}}'>	<i class="la la-edit"></i></a>
																																							<a href='{{url("employee/{$employee->id}/show")}}'>	<i class="la la-eye" data-toggle="modal" data-target="#m_modal_6"></i></a>



																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>

                                                      {{$employees->links('vendor.pagination.default')}}


														</div>
														<!--end::Portlet-->


														<script type="text/javascript">
															 $(".deleted_btn").on("click",function(){

																 var id = $(this).attr("data-title");
																 var url_delete = '{{url("employee/index")}}'+"/"+id
																					$.ajax({url: url_delete , success: function(result){

																						   result = JSON.parse(result);
																						   console.log(result);
																							 if(result.sucess)
																							 {
																								   window.location.href = '{{url("/employee")}}';
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

											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
