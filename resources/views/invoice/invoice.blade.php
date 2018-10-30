

															<div id="invoice_content">

																													 <div class="row information-invoice">
																															 <div class="col-lg-6">
																																	 <h3>Invoice</h3>
																																	 <h3>#{{$invoice->invoice_code_num}}</h3>
																																	 <h3>{{$invoice->invoice_status}}</h3>
																																	 <h3>@lang('app.invoice_to')    {{$invoice->CustomerData->address}}</h3>
																																	 <h3>@lang('app.phone') {{$invoice->CustomerData->phone}}</h3>
																																	 <h3>@lang('app.email')  {{$invoice->CustomerData->email}}</h3>
																															 </div>
																															 <div class="col-lg-6 info-right">
																																 <img src="{{ url('/') }}/images/{{$company_settings->company_logo}}" width="280" height="60"/>

																																	 <h3>{{$company_settings->company_name}} <br> {{$company_settings->company_address}}</h3>
																																	 <h3>@lang('app.invoice_date') {{$invoice->invoice_date}}</h3>
																																	 <h3>@lang('app.invoice_total') <?php
 																											$price = 0 ;

 																										//  print_r($invoice->services);
 																										 foreach ($invoice->services as $key => $service)
 																											 {
 																													if($service->pivot->invoice_type == $invoice->invoice_item_type)
 																														$price += $service->pivot->qty * $service->pivot->price;

 																											 }

 																											 $discount_value = $invoice->discount_amount;
 																											 if($invoice->discount_type != "amount")
 																											 {
 																														$discount_value = ($price * $invoice->discount_amount) /100;
 																											 }
 																											 $price =  $price - $discount_value;

 																											 echo $price;
 																							 ?></h3>
																																	 <h3>@lang('app.payed') <?php
                                                      $total_payed =  App\transaction::where("transfer_type","income")->where("invoice_id",$invoice->id)->sum('transfer_amount');
                                                      echo $total_payed;
																						 ?></h3>

                                                   <h3>@lang('app.rest_amount') <?php echo $price - $total_payed; ?></h3>



																															 </div>
																													 </div><hr>
																													 <!-- end of invoice info -->





																													 <div class=" col-lg-12 custyle">

																															 <table class="table table-striped custab"  style="    margin-bottom: 200px;">
																																	 <thead>
																																		 <tr>
																																			 <th scope="col">	@lang('app.service_name')</th>
																																			 <th scope="col">	@lang('app.qty')</th>
																																			 <th scope="col">@lang('app.price')</th>
																																			 <th scope="col"> @lang('app.total')</th>
																																		 </tr>
																																	 </thead>
																																	 <tbody>
																																		  @foreach ($invoice->services as $key => $inv)
																																		 <tr>
																																			 <td data-label="@lang('app.service_name')">{{App\service::find($inv->pivot->service_id)->title}}</td>
																																			 <td data-label="@lang('app.qty')"> {{$inv->pivot->qty}}</td>
																																			 <td data-label="@lang('app.price')"> {{$inv->pivot->price}}</td>
																																			 <td data-label="@lang('app.total')"> {{$inv->pivot->price * $inv->pivot->qty}}</td>

																																		 </tr>
																																		  @endforeach
																																		 <tr>
																																			 <td scope="row" data-label="@lang('app.service_name')"></td>
																																			 <td data-label="@lang('app.qty')"></td>
																																			 <td data-label="@lang('app.price')">subtotal</td>
																																			 <td data-label="@lang('app.total')"><?php  echo  $price;  ?></td>

																																		 </tr>
																																		 <tr>
																																			 <td data-label="@lang('app.service_name')"> </td>
																																			 <td data-label="@lang('app.qty')"></td>
																																			 <td data-label="@lang('app.price')">Discount</td>
																																			 <td data-label="@lang('app.total')"> <?php

																							 $discount_value = $invoice->discount_amount;
																							 if($invoice->discount_type != "amount")
																							 {
																										$discount_value = ($price * $invoice->discount_amount) /100;
																							 }

																							 echo $discount_value;

																						?>
</td>
																																		 </tr>
																																		 <tr>
																																			 <td scope="row" data-label="Acount"></td>
																																			 <td data-label="Due Date"></td>
																																			 <td data-label="Amount">Total</td>
																																			 <td data-label="Amount"><?php  echo $price -  $discount_value;   ?></td>
																																		 </tr>
																																	 </tbody>
																																 </table>

																															 </div>


													 </div>
