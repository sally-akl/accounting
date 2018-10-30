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
																			   @include("user.search")

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
														 <label class="form-control-label"> <i class="fas fa-cog"></i>  @lang('app.list_of_users')</label>
														 <a href="{{ url('register') }}?lang={{app()->getLocale()}}&branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_user')</button>
													   </a>
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th>
																																				 @lang('app.user_name')
																																			 </th>

																																			 <th>
																																				 @lang('app.user_email')
																																			 </th>

																																			 <th>
																																				@lang('app.role_name')
																																			</th>

																																			 <th></th>


														 </tr>
													 </thead>
													 <tbody>

                              @foreach ($user as $key => $u)

														 <tr>
															 <td data-label="@lang('app.user_name')">	{{$u->name}}</td>
															 <td data-label="@lang('app.user_email')">	{{$u->email}}</td>
															 <td data-label="@lang('app.user_email')">
                                   <?php
																	       $val = "";
                                         foreach ($u->roles as $key => $role)
																				 {
																					   if(empty($val))
																					      $val = $role->pivot->role_id;
																				 }

                                         if(!empty($val))
																				    echo \App\role::find($val)->title;

																	  ?>


																</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("user/{$u->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$u->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>

															<!--	<a href='{{url("user/roles/{$u->id}")}}/{{app()->getLocale()}}'>	@lang('app.user_roles')</a> -->
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$user->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>




@endsection


@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("user/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/user")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});

								 })
						</script>

@endsection
