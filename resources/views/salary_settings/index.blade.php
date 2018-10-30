@extends('layouts.master')

@section('content')

<section id="add-form" class="add_switch_form">
								 <div class="container-fluid">
										 <div class="row align-items-center justify-content-center">
												 <div class="card col-lg-12 padding20">
													 <div class="row">
													 <div class="col-lg-6 ">
																 <label class=" form-control-label"><i class="far fa-plus-square"></i>
                                  @if($mtype == "extra_salary")
																	  @lang('app.add_manage_extra_slary')
																	@elseif($mtype == "bouns")
																	   @lang('app.add_manage_bouns')
																  @elseif($mtype == "discount")
	 																	 @lang('app.add_manage_discount')
																	@endif
																 </label>
															 </div>
															 </div>
															 <div class="row">
																 <div class="col-lg-12 mg-top25">
																	     @include("salary_settings.sub_add")
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
																			  @include("salary_settings.search")

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
														 <label class="form-control-label"> <i class="fas fa-cog"></i>

															 @if($mtype == "extra_salary")
																 @lang('app.sal_manage_extra_slary')
															 @elseif($mtype == "bouns")
																	@lang('app.sal_manage_bouns')
															 @elseif($mtype == "discount")
																	@lang('app.sal_manage_discount')
															 @endif

														 </label>


													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																	 @lang('app.desc')
															 </th>

															 <th scope="col">
																	 @lang('app.percentage')
															 </th>

															 <th scope="col">
																	 @lang('app.submit_user_name')
															 </th>

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                              @foreach ($extra_min_salarries as $key => $extra)

														 <tr>
															 <td data-label=" @lang('app.desc')">	{{clean($extra->title)}}</td>
															 <td data-label="@lang('app.percentage')">	{{clean($extra->percentage)}}</td>
																<td data-label="@lang('app.submit_user_name')">		{{$extra->users != null ?$extra->users->name:""	}}	</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("salarysettings/{$extra->id}/edit")}}/{{$extra->mtype}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$extra->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$extra_min_salarries->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection

@section('footerjscontent')


							 <script type="text/javascript">
															$(".deleted_btn").on("click",function(){

																var id = $(this).attr("data-title");
																var url_delete = '{{url("salarysettings/index")}}'+"/"+id+'/{{app()->getLocale()}}'
																				 $.ajax({url: url_delete , success: function(result){

																							result = JSON.parse(result);
																							console.log(result);
																							if(result.sucess)
																							{
																									window.location.href = '{{url("/salarysettings")}}/{{$mtype}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																							}
																					 }});

																});

													 </script>

@endsection
