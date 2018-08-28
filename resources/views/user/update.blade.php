@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.update_user')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action='{{url("user/{$user->id}")}}'>
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

																																	<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																				{{ __('Name') }}  :
																																			</label>
																																			<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}  m-input" name="name" value="{{ $user->name }}" required autofocus>

																																			@if ($errors->has('name'))
																																					<span class="invalid-feedback" role="alert">
																																							<strong>{{ $errors->first('name') }}</strong>
																																					</span>
																																			@endif

																																	</div>

																																	<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																			{{ __('E-Mail Address') }}  :
																																			</label>
																																				<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} m-input" name="email" value="{{$user->email}}" required>

																																				@if ($errors->has('email'))
																																						<span class="invalid-feedback" role="alert">
																																								<strong>{{ $errors->first('email') }}</strong>
																																						</span>
																																				@endif

																																	</div>


                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.update_user') }}">


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
												@lang('app.update_user')
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
													<a href='{{url("/user")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.user')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("user/{$user->id}/edit")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.update_user')
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
