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

									 @include("reports.employee_income_search")
								 </div>
							 </div>

						 </div>

					 </div>
				 </div>
			 </section>

       @if(isset($invoices))
			 <section id="add-table">
				 <div class="container-fluid">
					 <div class="row align-items-center justify-content-center">
						 <div class="card col-lg-12 custyle">
							 <div class="row">
								 <div class="col-lg-12 mg-top25">
									 <label class="form-control-label"> @lang('app.employee_income_report')</label>
								 </div>
							 </div>
							 <table class="table table-striped custab">
								 <thead>
									 <tr>
										 <th>
																																				 @lang('app.transfer_code')
																																			 </th>
										 <th>
																																				 @lang('app.customer_name')
																																			 </th>



																																			 <th>
																																				 @lang('app.customer_invoice_date')
																																			 </th>

																																			 <th>
																																				 @lang('app.invoice_status')
																																			 </th>

																																			 <th scope="col">
																																				 @lang('app.submit_user_name')
																																			</th>

																																			 <th>
																																				@lang('app.customer_amount_invoice')
																																			</th>


									 </tr>
								 </thead>
								 <tbody>
									   @foreach ($invoices as $key => $invoice)
									 <tr>
										 <td data-label="@lang('app.transfer_code')">	{{clean($invoice->invoice_code_num)}}</td>
										 <td data-label="@lang('app.customer_name')">	{{clean($invoice->CustomerData->full_name)}}</td>

										 <td data-label="@lang('app.customer_invoice_date')">	{{ date("Y-m-d",strtotime($invoice->invoice_date))}}</td>
										 <td data-label="@lang('app.invoice_status')">  {{clean($invoice->invoice_status)}}</td>
										 <td data-label="@lang('app.submit_user_name')">	{{$invoice->users != null ?$invoice->users->name:""	}}

										 </td>

										 <td data-label="@lang('app.customer_amount_invoice')"> <?php
                                                                                        $price = 0 ;

                                                                                      //  print_r($invoice->services);
                                                                                       foreach ($invoice->services as $key => $service)
                                                                                         {
                                                                                            if($service->pivot->invoice_type == $invoice->invoice_item_type)
                                                                                               $price += clean($service->pivot->qty) * clean($service->pivot->price);

                                                                                         }

                                                                                         $discount_value = clean($invoice->discount_amount);
                                                                                         if($invoice->discount_type != "amount")
																																												 {
																																													    $discount_value = ($price * clean($invoice->discount_amount)) /100;
																																												 }
																																												 $price =  $price - $discount_value;
																																												 $cu = \App\classes\Common::getCurrencyText($invoice->currancy);

                                                                                         echo $price." ".$cu;
                                                                                 ?>

                                                  </td>



									 </tr>
									   @endforeach

								 </tbody>
							 </table>

							   {{$invoices->links('vendor.pagination.default')}}
						 </div>
					 </div>
				 </div>
			 </section>
			 @endif

       @if(isset($invoices))
			 <section id="add-table">
				 <div class="container-fluid">
					 <div class="row align-items-center justify-content-center">
						 <div class="card col-lg-12 custyle">
							 <div class="row">
								 <div class="col-lg-12 mg-top25">
									 <label class="form-control-label"> @lang('app.employee_invoices_transaction')</label>
								 </div>
							 </div>

							 <div class="form-group row">
						                         <label class="col-sm-3 form-control-label label-sm">@lang('app.choose_invoices')</label>
						                         <div class="col-sm-9">
						                           <select name="invoice" class="form-control choose_inv">
						                             <option value="0">----</option>
						                             @foreach ($invoices as $key => $invoice)
						                                 <option value="{{$invoice->id}}" >{{$invoice->invoice_code_num}}</option>
						                             @endforeach

						                           </select>
						                         </div>

						                           </div>

							      <div id="invoice_transaction_content">
										</div>
						 </div>
					 </div>
				 </div>
			 </section>
			 @endif
@endsection

@section('footerjscontent')

 <script type="text/javascript">
  $(".choose_inv").on("change",function(){
			var id = $(this).val();
			var create_form_url = '{{url("ajax/invoices/transactions")}}'+"/"+id+'/{{app()->getLocale()}}'
			if(id != 0)
			{
					$.ajax({url: create_form_url , success: function(result){
										$("#invoice_transaction_content").html(result);
				   }});
			}

	});
	</script>
@endsection
