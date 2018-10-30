@extends('layouts.master')

@section('content')
<section id="add-form">
				 <div class="container-fluid">
					 <div class="row">
						 <div class="card col-lg-12 " style="padding: 13px;">
							 <div class="row">
								 <div class="col-lg-3 mg-top25">
									 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i>@lang('app.Search')</label>
								 </div>
							 </div>
							 <div class="row">
								 <div class="col-lg-12 mg-top30">

									 @include("reports.salary_search")
								 </div>
							 </div>

						 </div>

					 </div>
				 </div>
			 </section>

			 <section id="add-table">
				 <div class="container-fluid">
					 <div class="row align-items-center justify-content-center">
						 <div class="card col-lg-12 custyle">
							 <div class="row">
								 <div class="col-lg-12 mg-top25">
									 <label class="form-control-label">  {{!empty($employee_id)?\App\employee::find($employee_id)->employee_name:""}}   @lang('app.salary_report')</label>
								 </div>
							 </div>
							 <table class="table table-striped custab" id="print_tb">

								 <thead>
									 <tr>
										 <th>@lang('app.transfer_code')</th>
										 <th>@lang('app.transfer_type')</th>
                     <th>@lang('app.employee_name')</th>
                     <th>@lang('app.Date')</th>
										 <th>@lang('app.Description')</th>
										 <th scope="col">
										     @lang('app.submit_user_name')
										 </th>
										 <th>@lang('app.customer_amount')</th>
										   <th scope="col">@lang('app.amount_after_trans')</th>
									 </tr>
								 </thead>
								 <tbody>
										@php $total_amount = 0 ;  @endphp
										 @foreach ($transfers as $key => $trans)
									 <tr>
										 <td data-label="@lang('app.transfer_code')">	{{clean($trans->transfer_code_num)}}</td>
										 <td data-label="@lang('app.transfer_type')">	{{clean($trans->transfer_type)}}</td>
										 <td data-label="@lang('app.employee_name')">	{{clean($trans->employee->employee_name)}}</td>
										 <td data-label="@lang('app.Date')">	{{$trans->transfer_date}}</td>

										 <td data-label="@lang('app.Description')">{{clean($trans->transfer_desc)}}</td>
										 <td data-label="@lang('app.submit_user_name')">	{{$trans->users != null ?$trans->users->name:""	}}

										 </td>
											 <td data-label="@lang('app.Amount')"> <a href="#" class="view_details" data-href='{{url("/ajax/salary/details/")}}/{{$trans->id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>	{{clean($trans->transfer_amount)}} {{\App\classes\Common::getCurrencyText($trans->currancy)}} </a></td>
											 <td data-label="@lang('app.amount_after_trans')">	{{clean($trans->converted_transfer_amount)}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</td>

									 </tr>
										 @php $total_amount += $trans->transfer_amount ;  @endphp
										 @endforeach

										 <tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>@lang('app.Total') : {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}} {{$total_amount}} </td>
										 </tr>


								 </tbody>
							 </table>

							 {{$transfers->links('vendor.pagination.default')}}
						 </div>
					 </div>
				 </div>
			 </section>
			 @include("utility.common_modal")
@endsection

@section('footerjscontent')

 <script type="text/javascript">
  $(".view_details").on("click",function(){
			var create_form_url = $(this).attr("data-href");
			$.ajax({url: create_form_url , success: function(result){
								$(".create_body_content").html(result);
								$('#pop_ups_modals').modal();
		 }});
	});
	</script>
@endsection
