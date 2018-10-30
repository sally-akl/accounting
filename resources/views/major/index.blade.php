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
																			  @include("major.search")

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
														 <label class="form-control-label"> <i class="fas fa-cog"></i> @lang('app.list_of_major')</label>
														 <a href="{{ url('major/create/0') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_major')</button>
													   </a>

                            @include("plugins.ajax_add_category")


													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																																				    @lang('app.major_name')
																																			 </th>

																																			 <th scope="col">
																																				  	@lang('app.category_name')
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

                                @foreach ( $majors as $key => $major)

														 <tr>
															 <td data-label="@lang('app.major_name')">{{clean($major->title)}}</td>
															 <td data-label="@lang('app.category_name')">	{{clean($major->category->title)}}
</td>

<td data-label="@lang('app.branch_name')">	{{ \App\branch::find($major->category->branch_id)!=null? clean(\App\branch::find($major->category->branch_id)->branch_title):""}}
</td>
<td data-label="@lang('app.submit_user_name')">	{{$major->users != null ?$major->users->name:""	}}

 </td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("major/{$major->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$major->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$majors->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>



@endsection


@section('footerjscontent')


							 <script type="text/javascript">
															$(".deleted_btn").on("click",function(){

																var id = $(this).attr("data-title");
																var url_delete = '{{url("major/index")}}'+"/"+id+'/{{app()->getLocale()}}'
																				 $.ajax({url: url_delete , success: function(result){

																							result = JSON.parse(result);
																							console.log(result);
																							if(result.sucess)
																							{
																									window.location.href = '{{url("/major")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																							}
																					 }});

																});


													 </script>

@endsection
