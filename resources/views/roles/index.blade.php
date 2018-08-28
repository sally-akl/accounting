@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">

                                      @lang('app.list_of_roles')
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																															<div class="col-xl-6">

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
                                                                        <a href="{{ url('roles/create') }}">
                                                                            <button type="button" class="btnNew"><i class="fa fa-plus"></i>@lang('app.new_role')</button>
                                                                        </a>
                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">

																										         	</div>


                                                            </div>
                                                            <div class="row dataTables">
                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>

                                                                        </th>
                                                                        <th>
                                                                          @lang('app.title')
                                                                        </th>

                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>

                                                                        @foreach ($roles as $key => $role)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>
																																								{{$role->title}}
																																						</td>

																																						<td>

																																						</td>
																																						<td>
																																							<a href="#" class="deleted_btn" data-title="{{$role->id}}">	<i class="la la-trash"></i> </a>

																																							<a href='{{url("roles/{$role->id}/edit")}}'>	<i class="la la-edit"></i></a>
																																							<a href='{{url("roles/{$role->id}/show")}}'>	<i class="la la-eye" data-toggle="modal" data-target="#m_modal_6"></i></a>
                                                                              <a href='{{url("roles/user/{$role->id}")}}'>	@lang('app.user_roles')</a>
																																							<a href='{{url("roles/permissions/{$role->id}")}}'>	@lang('app.role_permissions_txt')</a>


																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>

                                                      {{$roles->links('vendor.pagination.default')}}


														</div>
														<!--end::Portlet-->


														<script type="text/javascript">
															 $(".deleted_btn").on("click",function(){

																 var id = $(this).attr("data-title");
																 var url_delete = '{{url("roles/index")}}'+"/"+id
																					$.ajax({url: url_delete , success: function(result){

																						   result = JSON.parse(result);
																						   console.log(result);
																							 if(result.sucess)
																							 {
																								   window.location.href = '{{url("/roles")}}';
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
												@lang('app.list_of_roles')
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
													<a href='{{url("/category")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.roles')
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
