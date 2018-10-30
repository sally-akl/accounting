@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 Permissions
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('roles/storepermission') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

																																	<div class="form-group m-form__group">
																															<label for="exampleInputEmail1">
																															Modules  :
																															</label>
																															<select class="form-control m-input" name="module_id">

																																		@foreach ($modules as $key => $mod)
																																			<option value="{{$mod->id}}">{{$mod->title}}</option>
																																		@endforeach
																															</select>

																													</div>



                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      Title
                                                                    </label>
                                                                    <input type="text"  name= "title" class="form-control m-input" placeholder="">

                                                                </div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			Code
																																		</label>
																																		<input type="text"  name= "code" class="form-control m-input" placeholder="">

																																</div>


                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="Add">


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
												Permissions
											</h3>
											<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
												<li class="m-nav__item m-nav__item--home">
													<a href="#" class="m-nav__link m-nav__link--icon">
														<i class="m-nav__link-icon la la-home"></i>
													</a>
												</li>

											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
