@extends('layouts.master')

@section('content')

<section id="add-form" class="search_switch_form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		  <label class=" form-control-label"><i class="far fa-plus-square"></i> {{\App\country::find($c)->title}}  @lang('app.add_new_city') {{ __('app.under') }} </label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																			  	 @include("city.add_sub")

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
																			   @include("city.search")

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
														 <label class="form-control-label"> <i class="fas fa-cog"></i> @lang('app.list_of_city')</label>
													<!--	 <a href="{{ url('city/create') }}/{{app()->getLocale()}}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_city')</button>
													   </a>
													 -->


													<!--	 <a href="#" class="switcher_button" id="search_switch_button" style="display:none">
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
																																				 @lang('app.city_name')
																																			 </th>

																																			 <th scope="col">
																																				 @lang('app.country_name')
																																			 </th>

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                             @foreach ($cities as $key => $city)

														 <tr>
															 <td data-label="@lang('app.city_name')">{{clean($city->title)}}</td>
															 <td data-label="@lang('app.country_name')">{{clean($city->country->title)}}</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("city/{$city->id}/edit")}}/{{$c}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$city->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$cities->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>



@endsection

@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("city/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/city")}}/{{$c}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
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
