@extends('layouts.master')

@section('content')

<section id="add-form" class="add_switch_form">
								 <div class="container-fluid">
										 <div class="row align-items-center justify-content-center">
												 <div class="card col-lg-12 padding20">
													 <div class="row">
													 <div class="col-lg-6 ">
																 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_job')</label>
															 </div>
															 </div>
															 <div class="row">
																 <div class="col-lg-12 mg-top25">
																		@include("utility.error_messages")
																	  <form method="POST" action="{{ url('job/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
																			@csrf
																			 <div class="form-group row">
																					 <label class="col-sm-2 form-control-label label-sm"> @lang('app.job_name')</label>
																					 <div class="col-sm-10">
																						 <input id="inputHorizontalSuccess" name= "jtitle"  value="{{ old('jtitle') }}"  placeholder="{{ __('app.enter_job_name') }}" class="form-control {{ $errors->has('jtitle') ? ' is-invalid' : '' }} form-control-success" type="text">
																					 </div>
																				 </div>
																				 <div class="form-group row">
																										 <label class="col-sm-2 form-control-label label-sm">@lang('app.category')</label>
																										 <div class="col-sm-10">
																											 <select name="category" class="form-control">

		 																																	@foreach ($pcategories as $key => $cat)
		 																																		 <option value="{{$cat->id}}" {{old('category') == $cat->id ?"selected":""}}>{{$cat->title}}</option>
		 																																	 @endforeach

																									 </select>
																									 </div>
																							 </div>

																				 <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('app.save') </button>
																			 </form>
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
																			   @include("job.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> @lang('app.list_of_job')</label>
													   @include("plugins.ajax_add_category")
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																																				     @lang('app.job_name')
																																			 </th>

																																			 <th scope="col">
																																				  @lang('app.job_code')
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

                              @foreach ($jobs as $key => $job)

														 <tr>
															 <td data-label="@lang('app.job_name')">	{{clean($job->title)}}</td>
															 <td data-label="@lang('app.job_code')">
																 {{clean($job->job_code)}}
																																						 <a href='{{url("job/{$job->id}/editcode")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'  style="margin-left: 5px;color: red;">  @lang('app.edit')</a>

                               </td>
															 <td data-label="@lang('app.branch_name')">	{{ \App\branch::find($job->category->branch_id)!=null? clean(\App\branch::find($job->category->branch_id)->branch_title):""}}
															 </td>
															 <td data-label="@lang('app.submit_user_name')">	{{$job->users != null ?$job->users->name:""	}}

															 </td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("job/{$job->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$job->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$jobs->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection


@section('footerjscontent')



							 <script type="text/javascript">
															$(".deleted_btn").on("click",function(){

																var id = $(this).attr("data-title");
																var url_delete = '{{url("job/index")}}'+"/"+id+'/{{app()->getLocale()}}'
																				 $.ajax({url: url_delete , success: function(result){

																							result = JSON.parse(result);
																							console.log(result);
																							if(result.sucess)
																							{
																									window.location.href = '{{url("/job")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																							}
																					 }});

																});




													 </script>
@endsection
