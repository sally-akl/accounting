@extends('layouts.master')

@section('content')

<section id="manage-incom">
									 <div class="container-fluid">
											 <div class="row">
													 <div class="col-lg-12">
															 <div class="card">
																	 <div class="card col-lg-12 padding20">
																			 <div class="row">
																					 <div class=" mg-top25">
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i>
																								 @if($trans_type == "income")
	         																				 @lang('app.add_new_income')
	         																			 @elseif($trans_type == "expense")
	         																				 @lang('app.add_new_expense')
	         																			 @elseif($trans_type == "transfer")
	         																					 @lang('app.add_new_transaction')

	         																			 @endif</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action="{{ url('transactions/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" class="transactions_form" enctype="multipart/form-data">
																									 @csrf


																									 <div class="form-group row">
																											 <label class="col-sm-3 form-control-label label-sm">@lang('app.date') </label>
																											 <div class="col-sm-9">
																													 <input   name= "transfer_d" value="{{ old('transfer_d') }}"  placeholder="{{ __('app.enter_date') }}" class="form-control  {{ $errors->has('transfer_d') ? ' is-invalid' : '' }} form-control-success" type="date">
																											 </div>
																									 </div>

																									 @if($trans_type == "expense")
																									 <div class="form-group row">
																											 <label class="col-sm-3 form-control-label label-sm">  @lang('app.from_person') </label>
																											 <div class="col-sm-9">
																																<input id="inputHorizontalSuccess"  name= "from_person" value="{{ old('from_person') }}"  placeholder="{{ __('app.from_person') }}" class="form-control {{ $errors->has('from_person') ? ' is-invalid' : '' }} form-control-success" type="text">

																											 </div>
																									 </div>

																										@endif

																									 <div class="form-group row">
																											 <label class="col-sm-3 form-control-label label-sm">@lang('app.account_amount') ({{Auth::user()->currency}}) </label>
																											 <div class="col-sm-9">
																													 <input id="tran_amount"  name= "amount"  value="{{ old('amount') }}" placeholder="{{ __('app.enter_amount') }}" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }} form-control-success" type="text" value="{{$total_salary}}">
																											 </div>
																									 </div>

																									 <div class="form-group row">
																											 <label class="col-sm-3 form-control-label label-sm">@lang('app.account_amount_in_character') </label>
																											 <div class="col-sm-9">
																													 <input id="inputHorizontalSuccess"  name= "amount_in_character" value="{{ old('amount_in_character') }}"  placeholder="{{ __('app.account_amount_in_character') }}" class="form-control {{ $errors->has('amount_in_character') ? ' is-invalid' : '' }} form-control-success" type="text">
																											 </div>
																									 </div>

																									 @if($action == "add_emplyee_payment")

																									 <div class="form-group row">
																											<label class="col-sm-3 form-control-label label-sm">	@lang('app.salary_type')</label>
																											<div class="col-sm-9">
																													<select name="sal_type" class="form-control {{ $errors->has('sal_type') ? ' is-invalid' : '' }}">
																														 <option value="weekly" {{$salary_type =="weekly"?"selected":""}}>Weekly</option>
																														 <option value="monthly" {{$salary_type =="monthly"?"selected":""}}>Monthly</option>
																													</select>
																											</div>
																									</div>

																									 @endif



																									 <div class="form-group row">
																											 <label class="col-sm-3 form-control-label label-sm">	@lang('app.desc')</label>
																											 <div class="col-sm-9">

																														<textarea name="desc" rows="10" cols="70" class="form-control {{ $errors->has('desc') ? ' is-invalid' : '' }} form-control-success">{{ old('desc') }}</textarea>
																											 </div>
																									 </div>


																									 @if($trans_type == "income")
																											 @if(Session::get('filtered_invoice') == null)


																														<div class="form-group row">
																																<label class="col-sm-3 form-control-label label-sm">  @lang('app.invoice')</label>
																																<div class="col-sm-9">
																																		<select name="invoice_val" id="invoice_val" class="form-control  {{ $errors->has('invoice_val') ? ' is-invalid' : '' }}">
																																			@foreach ($invoices as $key => $inv)
																																			 <option value="{{$inv->id}}" {{old('invoice_val') == $inv->id ?"selected":""}}>{{$inv->invoice_code_num}}</option>
																																			@endforeach

																																		</select>
																																</div>
																														</div>
																														<input type="hidden" name="check_invoice_income" id="check_invoice_income" />

																													@else
																													<input type="hidden" name="invoice_val" id="invoice_val" value="{{Session::get('filtered_invoice')}}" />

																													<input type="hidden" name="check_invoice_income" id="check_invoice_income" />
																											 @endif
																											 @elseif($trans_type == "expense")
																											 <div class="form-group row">
																													 <label class="col-sm-3 form-control-label label-sm">  @lang('app.expense') </label>
																													 <div class="col-sm-9">
																															 <select name="expense_val" class="form-control {{ $errors->has('expense_val') ? ' is-invalid' : '' }}">

																																			@foreach ($expense_type as $key => $exp)
																																			 <option value="{{$exp->id}}" {{$action == "add_emplyee_payment" && $exp->id == 5?"selected":""}}>{{$exp->title}}</option>
																																			@endforeach

																															 </select>
																															 <a href='{{ url("expense/create/{$trans_type}") }}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>@lang('app.new_expense_type')</a>
																													 </div>
																											 </div>


																												@endif

																												<div class="form-group row">
		 																													 <label class="col-sm-3 form-control-label label-sm"> @lang('app.express_file')  </label>
		 																													 <div class="col-sm-9">
		 																														 <input  name="logo" type="file" id="imageInput">

		 																													 </div>
		 																										</div>

																												@if(is_int($branches))
																													<input type="hidden" name="branch_name" value="{{$branches}}" />

																													 @else

																													 <div class="form-group row">
																																		<label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
																																		<div class="col-sm-9">
																																<select name="branch_name" class="form-control">


																																						 @foreach ($branches as $key => $branch)
																																							 <option value="{{$branch->id}}" {{old('branch_name') == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
																																						 @endforeach

																																	</select>
																																	</div>
																															</div>

																													 @endif

																													 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">	@lang('app.submit_user_name')</label>
																															 <div class="col-sm-9">

																																	 {{ Auth::user()->name }}
																															 </div>
																													 </div>





																									 <input type="hidden" name="transfer_type" value="{{$trans_type}}" />
																									 <input type="hidden" name="action_type" value="{{$action}}" />
																									 <input type="hidden" name="emp_id" value="{{$emp_id}}" />
																									 <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
																							 </form>
																					 </div>
																			 </div>

																	 </div>
															 </div>
													 </div>
											 </div>
									 </div>
							 </section>

@endsection

@section('footerjscontent')

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
