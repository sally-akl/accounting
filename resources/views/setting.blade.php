@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.update_setting')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action='{{url("settings/{$setting->id}")}}' enctype="multipart/form-data">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">


																															<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.company_logo')  :
																																		</label>
																																	<input  name="logo" type="file" id="imageInput">
																																	<img src="{{ url('/') }}/images/{{$setting->company_logo}}" width="150" height="150"/>

																																</div>


																																<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																				@lang('app.company_name')  :
																																			</label>
																																			<input type="text"  name= "name" class="form-control m-input"  value="{{$setting->company_name}}">

																																	</div>

																																	<div class="form-group m-form__group">
	 																																			<label for="exampleInputEmail1">
	 																																				@lang('app.email')  :
	 																																			</label>
	 																																			<input type="text"  name= "email" class="form-control m-input"  value="{{$setting->company_email}}">

	 																																	</div>

																																	<div class="form-group m-form__group">
																																				<label for="exampleInputEmail1">
																																					@lang('app.company_address')  :
																																				</label>
																																				<textarea rows="10" cols="70"  name="address" >{{$setting->company_address}}</textarea>

																																		</div>









                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.save') }}">


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
												 @lang('app.update_setting')
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
