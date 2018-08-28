@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.add_new_employee')
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('employee/store') }}">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">
                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.employee_name')  :
                                                                    </label>
                                                                    <input type="text"  name= "name" class="form-control m-input" placeholder="{{ __('app.enter_employee_name') }}">

                                                                </div>

																																<div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.employee_email')  :
                                                                    </label>
                                                                    <input type="text"  name= "employee_email" class="form-control m-input" placeholder="{{ __('app.enter_employee_email') }}">

                                                                </div>

																																<div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.employee_address')  :
                                                                    </label>
                                                                    <input type="text"  name= "address" class="form-control m-input" placeholder="{{ __('app.enter_employee_address') }}">

                                                                </div>

																																<div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">
                                                                      @lang('app.employee_phone')  :
                                                                    </label>
                                                                    <input type="text"  name= "phone" class="form-control m-input" placeholder="{{ __('app.enter_employee_phone') }}">

                                                                </div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.employee_status')  :
																																		</label>
																																		<select class="form-control m-input" name="status">
																																					<option value="1">Active</option>
																																					<option value="2">Not active</option>
																																		</select>

																																</div>

																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.employee_join_data')  :
																																		</label>

																																		<input type="text"  name= "join_date" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_employee_join_date') }}">

																																</div>


																																<div class="form-group m-form__group">
																																		<label for="exampleInputEmail1">
																																			@lang('app.employee_details')  :
																																		</label>
																																	   <textarea rows="10" cols="70" name="details"></textarea>
																																</div>


                                                                <div class="row btnAddn">
                                                                    <div class="col-xl-12">
                                                                        <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.add_new_employee') }}">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                              <input type="hidden" name="where_from" value="{{$where_from}}" />
                                                          </form>

 <div class="datepicker datepicker-dropdown dropdown-menu datepicker-orient-left datepicker-orient-bottom" style="top: 302.766px; left: 566px; z-index: 10; display: none;margin-left:275px;margin-top:51px;"><div class="datepicker-days" style=""><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev"><i class="la la-angle-left"></i></th><th colspan="5" class="datepicker-switch">July 2018</th><th class="next"><i class="la la-angle-right"></i></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td class="old day" data-date="1529798400000">24</td><td class="old day" data-date="1529884800000">25</td><td class="old day" data-date="1529971200000">26</td><td class="old day" data-date="1530057600000">27</td><td class="old day" data-date="1530144000000">28</td><td class="old day" data-date="1530230400000">29</td><td class="old day" data-date="1530316800000">30</td></tr><tr><td class="day" data-date="1530403200000">1</td><td class="day" data-date="1530489600000">2</td><td class="day" data-date="1530576000000">3</td><td class="day" data-date="1530662400000">4</td><td class="day" data-date="1530748800000">5</td><td class="day" data-date="1530835200000">6</td><td class="today day" data-date="1530921600000">7</td></tr><tr><td class="day" data-date="1531008000000">8</td><td class="day" data-date="1531094400000">9</td><td class="day" data-date="1531180800000">10</td><td class="day" data-date="1531267200000">11</td><td class="day" data-date="1531353600000">12</td><td class="day" data-date="1531440000000">13</td><td class="day" data-date="1531526400000">14</td></tr><tr><td class="day" data-date="1531612800000">15</td><td class="day" data-date="1531699200000">16</td><td class="day" data-date="1531785600000">17</td><td class="day" data-date="1531872000000">18</td><td class="day" data-date="1531958400000">19</td><td class="day" data-date="1532044800000">20</td><td class="day" data-date="1532131200000">21</td></tr><tr><td class="day" data-date="1532217600000">22</td><td class="day" data-date="1532304000000">23</td><td class="day" data-date="1532390400000">24</td><td class="day" data-date="1532476800000">25</td><td class="day" data-date="1532563200000">26</td><td class="day" data-date="1532649600000">27</td><td class="day" data-date="1532736000000">28</td></tr><tr><td class="day" data-date="1532822400000">29</td><td class="day" data-date="1532908800000">30</td><td class="day" data-date="1532995200000">31</td><td class="new day" data-date="1533081600000">1</td><td class="new day" data-date="1533168000000">2</td><td class="new day" data-date="1533254400000">3</td><td class="new day" data-date="1533340800000">4</td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev"><i class="la la-angle-left"></i></th><th colspan="5" class="datepicker-switch">2018</th><th class="next"><i class="la la-angle-right"></i></th></tr></thead><tbody><tr><td colspan="7"><span class="month">Jan</span><span class="month">Feb</span><span class="month">Mar</span><span class="month">Apr</span><span class="month">May</span><span class="month">Jun</span><span class="month focused">Jul</span><span class="month">Aug</span><span class="month">Sep</span><span class="month">Oct</span><span class="month">Nov</span><span class="month">Dec</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev"><i class="la la-angle-left"></i></th><th colspan="5" class="datepicker-switch">2010-2019</th><th class="next"><i class="la la-angle-right"></i></th></tr></thead><tbody><tr><td colspan="7"><span class="year old">2009</span><span class="year">2010</span><span class="year">2011</span><span class="year">2012</span><span class="year">2013</span><span class="year">2014</span><span class="year">2015</span><span class="year">2016</span><span class="year">2017</span><span class="year focused">2018</span><span class="year">2019</span><span class="year new">2020</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev"><i class="la la-angle-left"></i></th><th colspan="5" class="datepicker-switch">2000-2090</th><th class="next"><i class="la la-angle-right"></i></th></tr></thead><tbody><tr><td colspan="7"><span class="decade old">1990</span><span class="decade">2000</span><span class="decade focused">2010</span><span class="decade">2020</span><span class="decade">2030</span><span class="decade">2040</span><span class="decade">2050</span><span class="decade">2060</span><span class="decade">2070</span><span class="decade">2080</span><span class="decade">2090</span><span class="decade new">2100</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-centuries" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev"><i class="la la-angle-left"></i></th><th colspan="5" class="datepicker-switch">2000-2900</th><th class="next"><i class="la la-angle-right"></i></th></tr></thead><tbody><tr><td colspan="7"><span class="century old">1900</span><span class="century focused">2000</span><span class="century">2100</span><span class="century">2200</span><span class="century">2300</span><span class="century">2400</span><span class="century">2500</span><span class="century">2600</span><span class="century">2700</span><span class="century">2800</span><span class="century">2900</span><span class="century new">3000</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div></div>

														</div>
														<!--end::Portlet-->


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
												<li class="m-nav__item">
													<a href='{{url("/employee/create")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.add_new_employee')
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
