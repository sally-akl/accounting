@extends('layouts.master')

@section('content')



							 <section id="add-table">
								 <div class="container-fluid">
									 <div class="row align-items-center justify-content-center">
											 <div class="card col-lg-12 custyle">
												 <div class="row">
													 <div class="col-lg-12 mg-top25">
														 <label class="form-control-label"> <i class="fas fa-cog"></i>  @lang('app.paid_invoices')</label>
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															   <th>
                                    @lang('app.customer_name')
                                 </th>

																	<th>
																		@lang('app.customer_amount')
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

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                               @foreach ($invoices as $key => $invoice)

														 <tr>
															 <td data-label="@lang('app.customer_name')">	{{clean($invoice->CustomerData->full_name)}}</td>
															 <td data-label="@lang('app.customer_amount')"> <?php
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

                                                                                         echo $price;
                                                                                 ?>

</td>
 <td data-label="@lang('app.customer_invoice_date')">	{{ date("Y-m-d",strtotime($invoice->invoice_date))}}</td>
  <td data-label="@lang('app.invoice_status')">	  {{clean($invoice->invoice_status)}}</td>

	<td data-label="@lang('app.submit_user_name')">	{{$invoice->users != null ?$invoice->users->name:""	}}

	</td>

															 <td class="text-center">
																 <a href='{{url("transactions/{$invoice->id}/invoicesDetails")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.Details')</a>

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
@endsection
