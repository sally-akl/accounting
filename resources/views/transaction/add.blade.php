@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																			@if($trans_type == "income")
																				 @lang('app.add_new_income')
																			 @elseif($trans_type == "expense")
																				 @lang('app.add_new_expense')
																			 @elseif($trans_type == "transfer")
																					 @lang('app.add_new_transaction')

																			 @endif
																		</h3>
																	</div>
																</div>
															</div>


                            @include("utility.error_messages")


                              <form method="POST" action="{{ url('transactions/store') }}" class="transactions_form">
                                  @csrf
                                                            <div class="row addConntent">
                                                                <div class="col-xl-12">

																																	<div class="form-group m-form__group">
																																			<label for="exampleInputEmail1">
																																				@lang('app.account_to')  :
																																			</label>

																																			<div class="row">
				                                                                  <div class="col-xl-9">
																																						<select class="form-control m-input" name="to_account">
																																								 @foreach ($accounts as $key => $account)
																																									<option value="{{$account->id}}">{{$account->account_number}}</option>
																																								 @endforeach
																																						</select>

																																					</div>

																																					<div class="col-xl-3" style="padding:11px;">
																																						<a href='{{ url("account/create/{$trans_type}") }}' style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>Add account</a>
																																					</div>
																																			</div>

																												           	</div>

																																		<div class="form-group m-form__group">
																																				<label for="exampleInputEmail1">
																																					@lang('app.date')  :
																																				</label>

																																				<input type="text"  name= "transfer_d" class="form-control m-input" id="m_datepicker_1"  placeholder="{{ __('app.enter_date') }}">

																																		</div>

																																		<div class="form-group m-form__group">
																																				<label for="exampleInputEmail1">
																																					@lang('app.account_amount')  :
																																				</label>

																																				<input type="text"  name= "amount" id="tran_amount" class="form-control m-input"  placeholder="{{ __('app.enter_amount') }}">

																																		</div>

																																		<div class="form-group m-form__group">
																																				<label for="exampleInputEmail1">
																																					@lang('app.desc')  :
																																				</label>

																																				 <textarea name="desc" rows="10" cols="70"></textarea>
																																		</div>

 																																		@if($trans_type == "income")
																																		   @if(Session::get('filtered_invoice') == null)
																																					<div class="form-group m-form__group">
																																							<label for="exampleInputEmail1">
																																								@lang('app.invoice')  :
																																							</label>
																																							<select class="form-control m-input" name="invoice_val" id="invoice_val">
																																									 @foreach ($invoices as $key => $inv)
																																										<option value="{{$inv->id}}">{{$inv->invoice_code_num}}</option>
																																									 @endforeach
																																							</select>

																																						</div>
																																					@else
																																					<input type="hidden" name="invoice_val" id="invoice_val" value="{{Session::get('filtered_invoice')}}" />

																																					<input type="hidden" name="check_invoice_income" id="check_invoice_income" />
																																			 @endif


																																		 @elseif($trans_type == "expense")
																																		 <div class="form-group m-form__group">
																																				 <label for="exampleInputEmail1">
																																					 @lang('app.expense')  :
																																				 </label>

																																				 <div class="row">
																																						 <div class="col-xl-9">
																																							 <select class="form-control m-input" name="expense_val">
																																										@foreach ($expense_type as $key => $exp)
																																										 <option value="{{$exp->id}}">{{$exp->title}}</option>
																																										@endforeach
																																							 </select>


																																						 </div>

																																						 <div class="col-xl-3" style="padding:11px;">
																																							 <a href='{{ url("expense/create/{$trans_type}") }}' style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>Add expense type</a>
																																						 </div>
																																				 </div>

																																			 </div>
																																		 @elseif($trans_type == "transfer")
																																		 <div class="form-group m-form__group">
																																				 <label for="exampleInputEmail1">
																																					 @lang('app.account_from')  :
																																				 </label>


																																				 <div class="row">
																																						 <div class="col-xl-9">
																																							 <select class="form-control m-input" name="account_from">
																																										@foreach ($accounts as $key => $account)
																																										 <option value="{{$account->id}}">{{$account->account_number}}</option>
																																										@endforeach
																																							 </select>
																																						 </div>

																																						 <div class="col-xl-3" style="padding:11px;">
																																							 <a href='{{ url("account/create/{$trans_type}") }}' style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>Add account</a>
																																						 </div>
																																				 </div>

																																			 </div>

																																		 @endif



                                                                  <input type="hidden" name="transfer_type" value="{{$trans_type}}" />
																																	<input type="hidden" name="action_type" value="{{$action}}" />



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

	@if($trans_type == "income")

	  <script type="text/javascript">

			 $(".transactions_form").submit(function() {
            var amount = $("#tran_amount").val();
						var invoice_val = $("#invoice_val").val();
						$("#check_invoice_income").val(invoice_val+"-"+amount);
       });

		</script>

	@endif




@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@if($trans_type == "income")
													@lang('app.list_of_income')
												@elseif($trans_type == "expense")
													@lang('app.list_of_expense')
												@elseif($trans_type == "transfer")
														@lang('app.list_of_transfer')

												@endif
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
													<a href='{{url("/transactions/{$trans_type}")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@if($trans_type == "income")
																@lang('app.income')
															@elseif($trans_type == "expense")
																@lang('app.expense')
															@elseif($trans_type == "transfer")
																	@lang('app.transfer')

															@endif
														</span>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("transactions/create/{$trans_type}")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@if($trans_type == "income")
																@lang('app.add_new_income')
															@elseif($trans_type == "expense")
																@lang('app.add_new_expense')
															@elseif($trans_type == "transfer")
																	@lang('app.add_new_transaction')

															@endif
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
