@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.update_system_template')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action='{{url("templates/{$template->id}")}}'>
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.template_name')  :
																																		</label>
																																		<input type="text"  name= "title" class="form-control m-input" placeholder="{{ __('app.enter_category_name') }}" value="{{$template->title}}">

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.template_body')  :
																																		</label>
																																		<textarea rows="30" cols="60" class="template_body"  name="body">{{$template->content}}</textarea>

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
														<script type="text/javascript">

														ClassicEditor.create( document.querySelector( '.template_body' ) )
																			.catch( error => {
																					console.error( error );
																				});
														</script>


@endsection



@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.list_of_system_template')
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
													<a href='{{url("/templates")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.Templates')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("templates/{$template->id}/edit")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.update_system_template')
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
