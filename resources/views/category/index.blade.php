@extends('layouts.master')

@section('content')

<section id="add-form" class="add_switch_form">
								 <div class="container-fluid">
										 <div class="row align-items-center justify-content-center">
												 <div class="card col-lg-12 padding20">
													 <div class="row">
													 <div class="col-lg-6 ">
																 <label class=" form-control-label"><i class="far fa-plus-square"></i>  @lang('app.add_new_category')</label>
															 </div>
															 </div>
															 <div class="row">
																 <div class="col-lg-12 mg-top25">
																	     @include("category.sub_add")
																			 </div>
																		 </div>

												 </div>
										 </div>
								 </div>
						 </section>


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


						<section id="add-form" class="add_switch_form">

							<div class="container-fluid">
									<div class="row align-items-center justify-content-center">
											<div class="card col-lg-12 padding20">
												<div class="row">
												<div class="col-lg-6 ">
															<label class=" form-control-label"><i class="far fa-plus-square"></i>  @lang('app.add_new_job')</label>
														</div>
														</div>
														<div class="row">
															<div class="col-lg-12 mg-top25">
																					@include("job.sub_add")
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
																			  @include("category.search")

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
														 <label class="form-control-label"> <i class="fas fa-cog"></i>  @lang('app.list_of_categories')</label>
													<!--	 <a href="{{ url('category/create/0') }}/{{app()->getLocale()}}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_category')</button>
													   </a>
													 -->

                             <!--
													 <a href="#" class="switcher_button" id="add_switch_button" style="display:inline">
															 <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_category')</button>
													 </a>

													 <a href="#" class="switcher_button" id="search_switch_button" style="display:none">
															 <button type="button" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true" style="margin-right: 6px;"></i>@lang('app.Search')</button>
													 </a>
                            -->

													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																																				   @lang('app.category_name')
																																			 </th>

																																			 <th scope="col">
																																				  @lang('app.category_code')
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

                              @foreach ($categories as $key => $category)

														 <tr>
															 <td data-label=" @lang('app.category_name')">	{{clean($category->title)}}</td>
															 <td data-label="@lang('app.category_code')">	{{clean($category->category_code)}}
                                                                                <a href="{{url("category/{$category->id}/editcode")}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="margin-left: 5px;color: red;">  @lang('app.edit')</a>
																</td>

																<td data-label="@lang('app.branch_name')">	{{ \App\branch::find($category->branch_id)!=null? clean(\App\branch::find($category->branch_id)->branch_title):""}}
																</td>

																<td data-label="@lang('app.submit_user_name')">		{{$category->users != null ?$category->users->name:""	}}

																</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("category/{$category->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$category->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$categories->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection

@section('footerjscontent')


							 <script type="text/javascript">
															$(".deleted_btn").on("click",function(){

																var id = $(this).attr("data-title");
																var url_delete = '{{url("category/index")}}'+"/"+id+'/{{app()->getLocale()}}'
																				 $.ajax({url: url_delete , success: function(result){

																							result = JSON.parse(result);
																							console.log(result);
																							if(result.sucess)
																							{
																									window.location.href = '{{url("/category")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																							}
																					 }});

																});

																$(".switcher_button").on("click",function()
																{
																			 var id = $(this).attr("id");
																			if(id =="add_switch_button")
																			{
																				 $("#search_switch_button").css("display","inline");
																				 $(".add_switch_form").css("display","block");
																				 $(".search_switch_form").css("display","none");

																			}
																			else {
																				 $("#add_switch_button").css("display","inline");
																				 $(".add_switch_form").css("display","none");
																				 $(".search_switch_form").css("display","block");
																			}

																			$(this).css("display","none");

																});



													 </script>

@endsection
