@extends('layouts.master')

@section('content')

<section id="add-form" class="add_switch_form">
								 <div class="container-fluid">
										 <div class="row align-items-center justify-content-center">
												 <div class="card col-lg-12 padding20">
													 <div class="row">
													 <div class="col-lg-6 ">
																 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_service')</label>
															 </div>
															 </div>
															 <div class="row">
																 <div class="col-lg-12 mg-top25">
																	    @include("service.sub_add")
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
																				 @include("service.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i>  @lang('app.list_of_service')</label>
														 @include("plugins.ajax_add_category")
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																																			  @lang('app.service_name')
																																			 </th>

																																			 <th scope="col">
																																				  @lang('app.service_code')
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

                                @foreach ($services as $key => $service)

														 <tr>
															 <td data-label="@lang('app.service_name')">	{{clean($service->title)}}</td>
															 <td data-label="@lang('app.service_code')">
																 {{clean($service->service_code)}}
																																							 <a href='{{url("service/{$service->id}/editcode")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="margin-left: 5px;color: red;">  @lang('app.edit')</a>

                                </td>
																<td data-label="@lang('app.branch_name')">	{{ \App\branch::find($service->category->branch_id)!=null? clean(\App\branch::find($service->category->branch_id)->branch_title):""}}
																</td>
																<td data-label="@lang('app.submit_user_name')">{{$service->users != null ?$service->users->name:""	}}

																</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("service/{$service->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$service->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$services->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>


@endsection

@section('footerjscontent')

<script type="text/javascript">
														$(".deleted_btn").on("click",function(){

															var id = $(this).attr("data-title");
															var url_delete = '{{url("service/index")}}'+"/"+id+'/{{app()->getLocale()}}'
																			 $.ajax({url: url_delete , success: function(result){

																						result = JSON.parse(result);
																						console.log(result);
																						if(result.sucess)
																						{
																								window.location.href = '{{url("/service")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																						}
																				 }});

															});





												 </script>

@endsection
