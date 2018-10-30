@extends('layouts.master')

@section('content')

							<section id="add-form" class="search_switch_form">
																								 <div class="container-fluid">
																										 <div class="row align-items-center justify-content-center">
																												 <div class="card col-lg-12 padding20">
																													 <div class="row">
																													 <div class="col-lg-6">
																																 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_customer_request')</label>
																															 </div>
																															 </div>
																															 <div class="row">
																																 <div class="col-lg-12 mg-top25">
																																		  @include("customer_requests.sub_add")

																																			 </div>
																																		 </div>

																												 </div>
																										 </div>
																								 </div>
																						 </section>

               	<section id="add-form" class="search_switch_form">
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
																																		  @include("customer_requests.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> @lang('app.list_of_customer_requests')</label>

													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">  @lang('app.customer_name')</th>
															 <th scope="col">  @lang('app.subject')</th>
															 <th scope="col">  @lang('app.date')</th>
															 <th scope="col">
																 @lang('app.submit_user_name')
															</th>
															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                             @foreach ($customer_requests as $key => $c_request)

														 <tr>
															 <td data-label="@lang('app.customer_name')">{{clean($c_request->customers->full_name)}}</td>
															 <td data-label="@lang('app.subject')">{{clean($c_request->subject)}}</td>
															 <td data-label="@lang('app.date')">{{clean($c_request->m_date)}}</td>
															 <td data-label="@lang('app.submit_user_name')">	{{$c_request->users != null ?$c_request->users->name:""	}}

															 </td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("customerrequests/{$c_request->id}/edit")}}/{{$id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$c_request->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>

															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$customer_requests->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection


@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("customerrequests/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/customerrequests")}}/{{$id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});
								 });
</script>

@endsection
