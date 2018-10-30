@extends('layouts.master')

@section('content')

<div class="container">
															 <div class="row justify-content-center">
																	 <div class="col-lg-6">
																			 <div id="imaginary_container">
																				 @include("quote.search")

																			 </div>
																	 </div>
															 </div>
													 </div>



							 <section id="add-table">
								 <div class="container-fluid">
									 <div class="row align-items-center justify-content-center">
											 <div class="card col-lg-12 custyle">
												 <div class="row">
													 <div class="col-lg-12 mg-top25">
														 <label class="form-control-label"> <i class="fas fa-cog"></i>
															 @if($filter_customer == true)
																		 @lang('app.list_of_customer_quotes')
																	 @else
																			 @lang('app.list_of_quotes')
																		 @endif
														 </label>
														 <?php
																if(!$filter_customer)
																{


														 ?>

														 <a href="{{ url('quote/create') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.add_new_quote')</button>
													   </a>
														 @include("plugins.ajax_add_customer")
														 <?php
																	}
											       ?>
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																																				    @lang('app.customer_name')
																																			 </th>

																																			 <th scope="col">
																																				@lang('app.customer_amount')
																																			 </th>

																																			 <th scope="col">
																																			@lang('app.customer_quote_date')
																																			 </th>
																																			 <th scope="col">
																			                                    @lang('app.branch_name')
																			                                 </th>
																																			 <th scope="col">
																																				@lang('app.submit_user_name')
																																		 </th>

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                              @foreach ($quotes as $key => $q)

														 <tr>
															 <td data-label="@lang('app.customer_name')">	{{clean($q->customer->full_name)}}</td>
															 <td data-label="@lang('app.customer_amount')">
																 <?php
																				$price = 0 ;

																				//  print_r($invoice->services);
																				foreach ($q->services as $key => $service)
																				{
																							if($service->pivot->invoice_type == $q->quote_type)
																								$price += clean($service->pivot->qty) * clean($service->pivot->price);

																				}

																				$discount_value = clean($q->quote_discount_amount);
																				if($q->quote_discount_type != "amount")
																				{
																					  if($q->quote_discount_amount != 0)
																						      $discount_value = ($price * clean($q->quote_discount_amount)) /100;
																				}
																			  $price =  $price - $discount_value;
																				$ct = \App\classes\Common::getCurrencyText($q->currancy);
                                      	echo $price." ".$ct;
																	?>

                               </td>
															 <td data-label="@lang('app.customer_quote_date')">	{{ date("Y-m-d",strtotime($q->quote_date))}}</td>
															 <td data-label="@lang('app.branch_name')">	{{ \App\branch::find($q->customer->branch_id)!=null? clean(\App\branch::find($q->customer->branch_id)->branch_title):""}}
															 </td>
															 <td data-label="@lang('app.submit_user_name')">	{{$q->users != null ?$q->users->name:""	}}

															 </td>

															 <td class="text-center">
																 <?php
																			if(!$filter_customer)
																			{
                                	?>
																 <a class='btn btn-info btn-xs' href='{{url("quote/{$q->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$q->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
																 <?php
																			}
																	?>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$quotes->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>



@endsection


@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("quote/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/quote")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});

								 })



						</script>

@endsection
