<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
    <style>

    .invoice_content
    {
       margin-left: 10px;
       margin-top: 46px;
    }
    .invoice_content h2
    {
       font-size: 24px;
    }
    .invoice_content h2,h3,h4,h1,h5,h6
    {
       font-weight: 100;
    }
    .invoice_content .to_right
    {
       text-align:right;
    }
    .company_info_content , .invoice_details
    {
       margin-right:10px;
    }
    article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
        display: block;
    }
    .row
    {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px;
    }
    .col-sm-6
    {
      position: relative;
      width: 100%;
      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px;
    }
    .dataTables
    {
      margin: 10px 0;
    }
    .dataTables table {
    margin: 10px 20px;
    color: #575962;
    }
    .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
    }


    </style>

  </head>
  <body>


															<div id="invoice_content">

                              <div class="invoice_content">

                                <header class="clearfix">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2>Invoice</h2>
                                            <h4>#{{$invoice->invoice_code_num}}</h4>
                                            <h3>{{$invoice->invoice_status}}</h3>
                                        </div>

                                        <div class="col-sm-6  to_right">
																					<div class="company_info_content">
                                          <div>


																					</div>
                                          <address>
                                           <strong>{{$company_settings->company_name}}</strong>
																					 <br>
                                           {{$company_settings->company_address}}
																					</address>
                                          </div>
                                        </div>

                                    </div>

                                </header>

                                <div>
                                    <div class="row">

                                         <div class="col-sm-6">
                                             <p>
                                                <strong>@lang('app.invoice_to'):</strong>
                                             </p>
                                            <address>
                                                   {{$invoice->CustomerData->address}}
                                                    <br>
                                                   <strong>@lang('app.phone'):</strong>
                                                    {{$invoice->CustomerData->phone}}
                                                   <br>
                                                   <strong>@lang('app.email'):</strong>
                                                     {{$invoice->CustomerData->email}}
                                                   <br>

                                            </address>


                                         </div>

                                         <div class="col-sm-6 to_right">
																					 <div class="invoice_details">
                                            <p>
                                              <span>@lang('app.invoice_date'):</span>
																							<span>{{$invoice->invoice_date}}</span>
																						</p>

                                            <h2>@lang('app.invoice_total'):
                                              <span>
																								<?php
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
 																							 ?>
																							</span>



																						</h2>
                                            <h2>@lang('app.payed'):
                                            <?php
                                                      $total_payed =  App\transaction::where("transfer_type","income")->where("invoice_id",$invoice->id)->sum('transfer_amount');
                                                      echo $total_payed;
																						 ?>



																						</h2>
                                            <h2>@lang('app.rest_amount'):

                                             <?php echo $price - $total_payed; ?>

																						</h2>

                                         </div>
																				</div>


                                    </div>



                                </div>




                              </div>

                             <div class="row dataTables">


															 <table class="table table-striped m-table">
															 <tbody>
																	 <tr>
																			 <th>

																			 </th>
																			 <th>
																					@lang('app.service_name')
																			 </th>

																			 <th>
																				 	@lang('app.qty')
																			 </th>

																			 <th>
																					@lang('app.price')
																			 </th>

																			 <th style="text-align:right;">
																				 @lang('app.total')
																			</th>


																			 <th></th>
																			 <th></th>
																	 </tr>

																			 @foreach ($invoice->services as $key => $inv)

																			 <tr>
																					 <th scope="row">


																					 </th>

																					 <td>
																							 {{App\service::find($inv->pivot->service_id)->title}}
																					 </td>

																					 <td>

																							 {{$inv->pivot->qty}}
																					 </td>

																					 <td>
																							  {{$inv->pivot->price}}
																					 </td>

																					 <td style="text-align:right;">
																							 {{$inv->pivot->price * $inv->pivot->qty}}
																					</td>


																					 <td>

																					 </td>


																			 </tr>



																			 @endforeach



															 </tbody>
															 </table>


														 </div>


                             <div class="row">


                               <div class="col-sm-12">
                                   <table class="table table-striped m-table">
                                       <tr>
                                         <th scope="row">


                                         </th>
                                          <td>Sub Total</td>
                                          <td></td>


                                          <td><span class="total_price"><?php  echo  $price;  ?></span></td>
                                       </tr>

                                       <tr>
                                         <th scope="row">


                                         </th>
                                          <td>Discount</td>
                                          <td></td>


                                          <td><span class="discount_total">
                                           <?php

                                               $discount_value = $invoice->discount_amount;
                                               if($invoice->discount_type != "amount")
                                               {
                                                    $discount_value = ($price * $invoice->discount_amount) /100;
                                               }

                                               echo $discount_value;

                                            ?>

                                          </span></td>
                                       </tr>

                                       <tr>
                                         <th scope="row">


                                         </th>
                                          <td>Total</td>
                                          <td></td>

                                          <td><span class="all_total_val"><?php  echo $price *  $discount_value;   ?></span></td>
                                       </tr>
                                   </table>

                               </div>


                             </div>


													 </div>
												 </body>

</html>
