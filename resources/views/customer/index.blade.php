@extends('layouts.master')

@section('content')
<section id="add-form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i> @lang('app.Search')</label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																				 	 @include("customer.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i>   @lang('app.list_of_customer')</label>
														 <a href="{{ url('customer/create') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_customer')</button>
													   </a>

														 @include("plugins.ajax_add_city")
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
																	  @lang('app.customer_email')
																 </th>
																 <th scope="col">
																		@lang('app.customer_phone')
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

                                @foreach ($customer as $key => $c)

														 <tr>
															 <td data-label="@lang('app.customer_name')">	{{clean($c->full_name)}}</td>
															 <td data-label=" @lang('app.customer_email')">
																			{{clean($c->email)}}
                                </td>
																<td data-label="	@lang('app.customer_phone')">
																		{{clean($c->phone_}}
																 </td>

																 <td data-label="@lang('app.branch_name')">	{{ \App\branch::find($c->branch_id)!=null? clean(\App\branch::find($c->branch_id)->branch_title):""}}
																</td>

																 <td data-label="@lang('app.submit_user_name')">		{{$c->users != null ?$c->users->name:""	}}

																 </td>



															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("customer/{$c->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$c->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>

																 <div class="dropdown" style="top: -38px;right:94px;">
																		 <button type="button" class="btn btn-success dropdown-toggle top-controls" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				 @lang('app.operation')
																		 </button>
																		 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class='dropdown-item' href='{{url("invoice/customer/{$c->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.Invoices')</a>
																					<a class='dropdown-item' href='{{url("quote/customer/{$c->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.Quote')</a>
				 																  <a class='dropdown-item' href='{{url("customerrequests/{$c->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.customer_requests')</a>
				 																  <a class='dropdown-item' href='{{url("customercomplain/{$c->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.customer_complains')</a>
																					@if(Auth::user()->AllowToPath("add_invoices"))
																					<a class='dropdown-item' href='{{url("invoice/create/{$c->id}/tocustomer")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>@lang('app.add_new_invoices')</a>
																					@endif

																					@if(Auth::user()->AllowToPath("add_customer_request"))
																					<a class='dropdown-item add_customer_request_compl' data-hr='{{url("customerrequests/create/{$c->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' href='#'>@lang('app.add_customer_request')</a>
																					@endif

																					@if(Auth::user()->AllowToPath("add_customer_request"))
																					<a class='dropdown-item add_customer_request_compl' data-hr='{{url("customercomplain/create/{$c->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' href='#'>@lang('app.add_customer_complain')</a>
																					@endif
																		 </div>
																	 </div>




															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$customer->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection


@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("customer/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/customer")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});

								 });


								 $(".add_customer_request_compl").on("click",function(){

								        var create_form_url = $(this).attr("data-hr");
								        $.ajax({url: create_form_url , success: function(result){
								                  $(".create_body_content").html(result);
								                  $('#pop_ups_modals').modal();

								                  $(".add_extra_salary_btn").submit(function(e){

								                       e.preventDefault();
								                       var submit_form_url = $(this).attr('action');
								                       var formData = new FormData($(this)[0]);
								                       $(".alert-success").css("display","none");
								                       $(".alert-danger").css("display","none");
								                       $.ajax({
								                            url: submit_form_url,
								                            type: 'POST',
								                            data: formData,
								                            async: false,
								                            dataType: 'json',
								                            success: function (response) {

																							$(".alert-success").html("Sucessfully Added");
																							$(".alert-success").css("display","block");
																								setTimeout(function(){location.reload(); }, 2000);
								                            },
																						error : function( data )
																						{
																								if( data.status === 422 )
																								{

																										var $error_text = "";
																										var errors = $.parseJSON(data.responseText);
																										$.each(errors.errors, function (key, value) {
																												 $error_text +=value+"<br>";
																										 });

																										$(".alert-danger").html($error_text);
																										$(".alert-danger").css("display","block");

																								}

																						},
								                            cache: false,
								                            contentType: false,
								                            processData: false
								                        });

								                        return false;
								                   });

								       }});
								  });

						</script>

@endsection
