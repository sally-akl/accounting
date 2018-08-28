@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
                                     @lang('app.list_of_invoice_items')
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																															<div class="col-xl-6">

                                                                </div>

                                                            </div>


																														<form method="POST" action="{{ url('invoice/items/store') }}">
																																@csrf

                                                            <div class="row dataTables">
                                                                <table class="table table-striped m-table items_table">
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


																																			<th></th>
																																			<th></th>
																																	</tr>

                                                                        @php $index_is = 0 ; @endphp
																																				@php $discount = 0;  @endphp
																																				@php $total_price = 0;  @endphp
                                                                        @foreach ($invoice_items as $key => $invoice_item)

																																				<tr>
																																						<th scope="row">


																																						</th>

																																						<td>
																																							<select class="form-control m-input customer_name" name="service_val{{$key}}">
																																										@foreach ($services as $key => $service)
																																											<option value="{{$service->id}}"  {{$invoice_item->pivot->service_id == $service->id?"selected":"" }}  >{{$service->title}}</option>
																																										@endforeach
																																							</select>

																																						</td>

																																						<td>
                                                                              	<input type="text"  name= "qty{{$key}}" id="qty{{$key}}" class="form-control m-input" value="{{$invoice_item->pivot->qty}}">
																																						</td>

																																						<td>
                                                                               	<input type="text"  name= "price{{$key}}" class="form-control m-input price_item" value="{{$invoice_item->pivot->price}}">
																																						</td>


																																						 <td>

																																						 </td>

																																				</tr>
																																				  @php $total_price += $invoice_item->pivot->qty * $invoice_item->pivot->price ;  @endphp
                                                                          @php $index_is++ ; @endphp
                                                                        @endforeach


																																				<tr>

																																					<th scope="row">


																																					</th>

																																					<td>
																																						<select class="form-control m-input customer_name" name="service_val{{$index_is}}">
																																									@foreach ($services as $key => $service)
																																										<option value="{{$service->id}}"  >{{$service->title}}</option>
																																									@endforeach
																																						</select>

																																					</td>

																																					<td>
																																							<input type="text"  name= "qty{{$index_is}}" id="qty{{$index_is}}" class="form-control m-input " >
																																					</td>

																																					<td>
																																							<input type="text"  name= "price{{$index_is}}" class="form-control m-input price_item">
																																					</td>


																																					 <td>

																																					 </td>


																																				</tr>

                                                                </tbody>
                                                                </table>
																																<input type="hidden" name="current_index" id="current_index" value="{{$index_is}}" />
																																<input type="hidden" name="discount" id="discount" value="{{$invoice->discount_amount}}" />
                                                                <input type="hidden" name="discount_type" id="discount_type" value="{{$invoice->discount_type}}" />
																																<input type="hidden" name="invoice_id"  value="{{$invoice->id}}" />

                                                                <div style="margin-left:19px;margin-top:10px;margin-bottom:10px;width:100%">
																																<input type="button" class="btn btn-success m-btn m-btn--pill add_new_row" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.add') }}">
                                                                <input type="button" class="btn btn-danger m-btn m-btn--pill remove_row" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.delete') }}">
																															</div>


                                                              <div style="margin-left: 480px;width:90%;margin-right: 39px;">
                                                                  <table class="table table-striped m-table">
                                                                      <tr>
																																				<th scope="row">


																																				</th>
																																				 <td>Sub Total</td>
																																				 <td></td>


																																				 <td><span class="total_price"><?php  echo  $total_price;  ?></span></td>
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
																																									 $discount_value = ($total_price * $invoice->discount_amount) /100;
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

																																				 <td><span class="all_total_val"><?php  echo $total_price *  $discount_value;   ?></span></td>
																																			</tr>
																																	</table>

																															</div>

                                                              <div>
																																<input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.save') }}" style="width: 100px;margin-left: 11px;margin-bottom: 10px;">

																															</div>




                                                            </div>

																													</form>



														</div>


														<script type="text/javascript">

														var _focus_price = {

															 price_item : $('.price_item'),
															 discount_elem : $("#discount"),
															 discount_type_elem : $("#discount_type"),
															 total_price_elem : $(".total_price") ,
															 discount_total_elem : $(".discount_total") ,
															 all_total_val_elem:$(".all_total_val") ,
															 total_price : 0 ,
															 qty_txt: "",
															 p:0,
															 q:0,
															 setMainElement : function(elem)
															 {
																   this.price_item = elem;
																	 return this;
															 },
															 release : function()
															 {
																	 this.price_item.off();
																	 var that = this ;
																	 this.price_item.blur(function(){
																		 that.calculation(that);
																	 });


															 },
															 calculation : function(that)
															 {
																    if(typeof that == 'undefined')
																		   that = this;

																   that.total_price = 0;
                                   that.total_price = parseInt( that.total_price );
																	 that.price_item.each(function(index, elem)
																	 {
																				 that.qty_txt = "qty"+index;
																				 if($("#"+that.qty_txt).length != 0)
																				 {
																						 if($("#"+that.qty_txt).val() == "")
																								$("#"+that.qty_txt).val(1);
																						 that.p = parseInt($(elem).val());
																						 that.q =  parseInt($("#"+that.qty_txt).val());
																						 that.total_price += that.p * that.q;
																				 }

																	 });


																		that.total_price_elem.text(that.total_price);
																		var  discount_value = parseInt(that.discount_elem.val());
																		var discount_type = that.discount_type_elem.val();

																		if(discount_type != "amount")
																		{
																				 discount_value = (that.total_price * discount_value) /100;
																		}

																		that.discount_total_elem.text(discount_value);
																		that.all_total_val_elem.text(that.total_price - discount_value);



															 }




													 }


															 $(".add_new_row").on("click",function(){

                                  var current_index = $("#current_index").val();
																	if($("#qty0").length == 0)
																	  current_index = 0;
																	else
																	  current_index++;

																	var service_txt= "service_val"+current_index;
																	var price_txt = "price"+current_index;
																	var qty_txt = "qty"+current_index;
																	var options = "";

																	<?php
																	   foreach ($services as $key => $service)
																		 {
																			 ?>
                                      options += '<option value="<?php echo $service->id ?>"  ><?php echo $service->title ?></option>';
																			 <?php
																		 }
																  ?>
                                  var new_row ='<tr>';
																	new_row += '<th scope="row"></th>';
																	new_row +='<td>';
																	new_row +='<select class="form-control m-input customer_name" name="'+service_txt+'">';
																	new_row += options;
																	new_row +='</select>';
																	new_row +='</td>';
																	new_row +='<td>';
																	new_row +='<input type="text"  name= "'+qty_txt+'" id="'+qty_txt+'" class="form-control m-input" >';
                                  new_row +='</td>';
																	new_row +='<td>';
																	new_row +='	<input type="text"  name= "'+price_txt+'" class="form-control m-input price_item">';
                                  new_row +='	</td><td></td></tr>';
																	$(".items_table  tr:last").after(new_row);

																	$("#current_index").val(current_index);
																		_focus_price.setMainElement($('.price_item')).release();


															 });

															 $(".remove_row").on("click",function(){
																    var current_index = $("#current_index").val();
                                   	$(".items_table  tr:last").remove();
																		current_index--;
																		if(current_index < 0)
																		  current_index = 0;
																		$("#current_index").val(current_index);
																		_focus_price.setMainElement($('.price_item')).release();
																		_focus_price.calculation();
															 });

                               _focus_price.release();

														</script>

@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.list_of_invoice_items')
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

											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
