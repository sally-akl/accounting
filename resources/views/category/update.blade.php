@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.update_category')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action='{{url("category/{$category->id}")}}'>
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">


																																	<div class="form-group m-form__group">
																																<label for="exampleInputEmail1">
																																@lang('app.category_parent')  :
																																</label>
																																<select class="form-control m-input" name="parent">
																																		<option value="0">No Parent</option>
																																		@foreach ($categories as $key => $cat)
																																			<option value="{{$cat->id}}"  {{$cat->id == $category->parent_id ?"selected":""}}>{{$cat->title}}</option>
																																		@endforeach
																																</select>

																																</div>



																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.category_name')  :
																																		</label>
																																		<input type="text"  name= "title" class="form-control m-input" placeholder="{{ __('app.enter_category_name') }}" value="{{$category->title}}">

																																</div>









                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.update_category') }}">


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
												@lang('app.list_of_categories')
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
															@lang('app.category')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("category/{$category->id}/edit")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.update_category')
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
