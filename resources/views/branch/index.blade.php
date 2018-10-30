@extends('layouts.master')

@section('content')


<section id="add-form" class="search_switch_form">
				<div class="container-fluid">
						<div class="row align-items-center justify-content-center">
									<div class="card col-lg-12 padding20">
											<div class="row">
													<div class="col-lg-6">
																<label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.new_branch')</label>
													 </div>
											</div>
											<div class="row">
													 <div class="col-lg-12 mg-top25">
															@include("branch.sub_add")
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
																<label class=" form-control-label"><i class="far fa-plus-square"></i>@lang('app.add_new_city')</label>
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
																			  @include("branch.search")

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
														 <label class="form-control-label"> <i class="fas fa-cog"></i>  @lang('app.list_of_branches')</label>
													<!--	 <a href="{{ url('category/create/0') }}/{{app()->getLocale()}}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_category')</button>
													   </a>
													 -->


												<!--	 <a href="{{ url('branch/create') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"  style="display:inline">
															 <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_branch')</button>
													 </a>
												 -->

													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																		@lang('app.branch_name')
															</th>

															<th scope="col">
																		@lang('app.branch_code')
															 </th>

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                              @foreach ($branches as $key => $branch)

														 <tr>
															 <td data-label="@lang('app.branch_name')">	{{clean($branch->branch_title)}}</td>
															 <td data-label="@lang('app.branch_code')')">	{{clean($branch->branch_code)}}
                                    <a href='{{url("branch/{$branch->id}/editcode")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="margin-left: 5px;color: red;">  @lang('app.edit')</a>
</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("branch/{$branch->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$branch->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$branches->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection

@section('footerjscontent')


							 <script type="text/javascript">
															$(".deleted_btn").on("click",function(){

																var id = $(this).attr("data-title");
																var url_delete = '{{url("branch/index")}}'+"/"+id+'/{{app()->getLocale()}}'
																				 $.ajax({url: url_delete , success: function(result){

																							result = JSON.parse(result);
																							console.log(result);
																							if(result.sucess)
																							{
																									window.location.href = '{{url("/branch")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																							}
																					 }});

																});


																$(".country_name").on("change",function(){

																	var val = $(this).val();
																	var url_cities = '{{url("city/country")}}'+"/"+val+'/{{app()->getLocale()}}'
																					 $.ajax({url: url_cities , success: function(result){

																								result = JSON.parse(result);
																								$(".city_name").html(result.cities);

																						 }});

																	});


													 </script>

@endsection
