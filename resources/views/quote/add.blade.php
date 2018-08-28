@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.add_new_quotes')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('quote/store') }}">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.customer_name')  :
                                                                      </label>
                                                                      <select class="form-control m-input customer_name" name="customer_name">
                                                                            <option value="0">Choose customer</option>
                                                                            @foreach ($customers as $key => $customer)
                                                                              <option value="{{$customer->id}}">{{$customer->full_name}}</option>
                                                                            @endforeach
                                                                      </select>

                                                                  </div>

                                                                  <div class="form-group m-form__group">
  																																		<label for="exampleInputEmail1">
  																																			@lang('app.subject')  :
  																																		</label>
  																																		<input type="text"  name= "subject" class="form-control m-input" placeholder="{{ __('app.enter_subject') }}" value="">

  																																</div>

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.quote_status')  :
                                                                      </label>
                                                                      <select class="form-control m-input" name="quote_status">
                                                                            <option value="">Choose Status</option>
                                                                            <option value="pending">Pending</option>
                                                                      </select>

                                                                  </div>

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.quote_date')  :
                                                                      </label>
                                                                      <input type="text"  name= "quote_date" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_quote_date') }}">
                                                                  </div>

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.quote_expire_date')  :
                                                                      </label>
                                                                      <input type="text"  name= "expire_date" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_quote_expire_date') }}">
                                                                  </div>

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.discount_value')  :
                                                                      </label>
                                                                      <input type="text"  name= "quote_discount" class="form-control m-input" placeholder="{{ __('app.enter_quote_discount') }}" value="0">

                                                                  </div>


                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.discount_type')  :
                                                                      </label>

                                                                      <select class="form-control m-input" name="quote_discount_type">

                                                                            <option value="percentage" selected="">Percentage</option>
                                                                            <option value="amount">Fix</option>

                                                                         </select>

                                                                  </div>


                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.quote_txt')  :
                                                                      </label>
                                                                      <textarea rows="10" cols="70"  name="quote_txt"></textarea>

                                                                  </div>

                                                                  <div class="form-group m-form__group">
                                                                      <label for="exampleInputEmail1">
                                                                        @lang('app.quote_customer')  :
                                                                      </label>
                                                                      <textarea rows="10" cols="70"  name="quote_customer"></textarea>

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
												@lang('app.list_of_quotes')
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
													<a href='{{url("/quote")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.quote')
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("/quote/create")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.add_new_quotes')
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
