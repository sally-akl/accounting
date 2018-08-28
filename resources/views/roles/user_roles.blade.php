@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">

                                      @lang('app.user_roles') {{$role->title}}
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")


																<form method="POST" action="{{ url('user/roles/store') }}">
																		@csrf


														   <div class="row addConntent">
			 													  <div class="col-xl-12">

																		<div class="form-group m-form__group">
																			<label for="exampleInputEmail1">
																				@lang('app.user_name')  :
																			</label>
																			<select class="form-control m-input" name="user_val[]" multiple>
																						@foreach ($users as $key => $u)
																							<option value="{{$u->id}}">{{$u->name}}</option>
																						@endforeach
																			</select>

													        	</div>
                                    <input type="hidden" name="role_name" value="<?php  echo $role->id  ?>" />
																		<div class="row btnAddn">
																				<div class="col-xl-12">
																						<input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.add_role') }}">

																				</div>
																		</div>

																	</div>
																</div>


																</form>




                                                            <div class="row toolss">

																															<div class="col-xl-6">



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

                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">

																										         	</div>


                                                            </div>
                                                            <div class="row dataTables" style="width: 100%;">
                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>

                                                                        </th>
                                                                        <th>
                                                                          @lang('app.user_name')
                                                                        </th>

																																				<th>
                                                                          @lang('app.role_title')
                                                                        </th>


                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>

                                                                        @foreach ($user_roles as $key => $r)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>
																																								{{$r->name}}
																																						</td>

																																						<td>
																																									{{$role->title}}

																																						</td>


																																						<td>

																																						</td>

																																						<td>

																																						</td>

																																				</tr>



                                                                        @endforeach



                                                                </tbody>
                                                                </table>

                                                            </div>




														</div>
														<!--end::Portlet-->
@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.user_roles')
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
