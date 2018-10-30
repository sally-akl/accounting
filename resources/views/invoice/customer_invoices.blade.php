@extends('layouts.master')

@section('content')

 @if(!$filter_customer)

 <section id="statistcs-invoice">
				 <div class="container-fluid">
					 <div class="row cart-top has-shadow">


						 <div class="col-lg-4">
							 <div class="row red3">
								 <div class="col-3 col-lg-3">
									 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-receipt"></i>
								 </div>
								 <div class="col-9 col-lg-9">
									 <h1><?php echo $total_unpaid; ?> </h1>
									 <br>
									 <p>@lang('app.Total_unpaid_count')</p>
								 </div>


							 </div>
						 </div>
						 <div class="col-lg-4">
							 <div class="row green3">
								 <div class="col-3 col-lg-3">
									 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fas fa-file-invoice-dollar"></i>
								 </div>
								 <div class="col-9 col-lg-9">
									 <h1>{{$invoice_num}}</h1>
									 <br>
									 <p>@lang('app.Total')</p>
								 </div>


							 </div>
						 </div>
						 <div class="col-lg-4">
							 <div class="row blue3">
								 <div class="col-3 col-lg-3">
									 <i style="color: #dedede66;font-size: 70px;line-height: 1.3;" class="fab fa-creative-commons-nc"></i>
								 </div>
								 <div class="col-9 col-lg-9">
									 <h1><?php echo $total_paid; ?></h1>
									 <br>
									 <p>@lang('app.Total_paid_count')</p>
								 </div>


							 </div>
						 </div>

					 </div>
				 </div>
			 </section>

 @else

<section id="add-form">
          <div class="container-fluid">
            <div class="row">
              <div class="card col-lg-8 padding20">
                <div class="row">
                  <div class="col-lg-3">
                    <label class=" form-control-label">@lang('app.Search')</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 mg-top30">
										 @include("invoice.search")

                  </div>
                </div>

              </div>
              <div class="col-lg-4">

                <div class="col-lg-12">
                  <div class="row red2" style="height:105px;">
                    <div class="col-3 col-xl-3">
                      <i style="color: #dedede66;font-size: 55px;line-height: 1.6;" class="fas fa-file-invoice"></i>
                    </div>
                    <div class="col-9 col-xl-9">
                      <h1><?php echo  $total_unpaid; ?></h1>
                      <br>
                      <p>@lang('app.Total_unpaid_count')</p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="row blue2" style="height:105px;">
                    <div class="col-3 col-xl-3">
                      <i style="color: #dedede66;font-size: 50px;line-height: 1.7;" class="fas fa-sort-amount-up"></i>
                    </div>
                    <div class="col-9 col-xl-9">
                      <h1>{{$invoice_num}}</h1>
                      <br>
                      <p>@lang('app.Total')</p>
                    </div>
                  </div>


                </div>

                <div class="col-lg-12">

                  <div class="row green2" style="height:105px;">
                    <div class="col-3 col-xl-3">
                      <i style="color: #dedede66;font-size: 50px;line-height: 1.5;" class="far fa-money-bill-alt"></i>
                    </div>
                    <div class="col-9 col-xl-9">
                      <h1><?php echo $total_paid; ?></h1>
                      <br>
                      <p>@lang('app.Total_paid_count')</p>
                    </div>

                  </div>


                </div>

              </div>
            </div>
          </div>
        </section>

				@endif



							 <section id="add-table">
								 <div class="container-fluid">
									 <div class="row align-items-center justify-content-center">
											 <div class="card col-lg-12 custyle">
												 <div class="row">
													 <div class="col-lg-12 mg-top25">
														 <label class="form-control-label"><i class="fas fa-cog"></i>  @if($filter_customer == true)
                                         @lang('app.list_of_customer_invoices')
																			@else
																				  @lang('app.list_of_invoices')
																			@endif
																		</label>
																		<?php
																																				 if(!$filter_customer)
																																				 {


																																		 ?>

																																			 <a href="{{ url('reports/invoices') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
																																			   @csrf
																																		 <button type="submit" class="btn btn-primary2 small-sc-btn2">view Report</button>
																																	 </a>
														 <a href="{{ url('invoice/create/0/toinvoice') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.add_new_invoices')</button>
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
																	@lang('app.customer_invoice_date')
																 </th>

																 <th scope="col">
																  @lang('app.invoice_status')
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

                                  @foreach ($invoices as $key => $invoice)

														 <tr>
															 <td data-label="@lang('app.customer_name')">	{{clean($invoice->CustomerData->full_name)}}</td>
															 <td data-label="@lang('app.customer_amount')">
																 <?php
                                      $ct = \App\classes\Common::getCurrencyText($invoice->currancy);
                                      echo $invoice->getprice()." ".$ct;
                                   ?>
                                </td>
																<td data-label="@lang('app.customer_invoice_date')">
																	{{ date("Y-m-d",strtotime($invoice->invoice_date))}}
																 </td>

																 <td data-label="@lang('app.invoice_status')">
 																	{{$invoice->invoice_status}}
 																 </td>

                                 <td data-label="@lang('app.branch_name')">	{{ \App\branch::find($invoice->CustomerData->branch_id)!=null? clean(\App\branch::find($invoice->CustomerData->branch_id)->branch_title):""}}
                                 </td>

                                 <td data-label="@lang('app.submit_user_name')">	{{$invoice->users != null ?$invoice->users->name:""	}}

                                 </td>



															 <td class="text-center">
																 <?php
																																									if(!$filter_customer)
																																									{


																																							?>

																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$invoice->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
                                 <?php
                                                                                    }
                                                                               ?>


                                                                               <div class="dropdown" style="top: -7px;right:73px;">
                                              																		 <button type="button" class="btn btn-success dropdown-toggle top-controls" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              																				 @lang('app.operation')
                                              																		 </button>
                                              																		 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                     <a class='dropdown-item' href='{{url("transactions/income/{$invoice->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.All_invoice_transaction')</a>
                                                                                     <a class='dropdown-item' href='{{url("invoice/{$invoice->id}/show")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.Show')</a>


                                              																		 </div>
                                              																	 </div>


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


@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("invoice/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/invoice/all")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});

								 })

</script>

@endsection
