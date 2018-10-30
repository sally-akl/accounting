@extends('layouts.master')

@section('content')


							 <section id="add-table">
								 <div class="container-fluid">
									 <div class="row align-items-center justify-content-center">
											 <div class="card col-lg-12 custyle">
												 <div class="row">
													 <div class="col-lg-12 mg-top25">
														 <label class="form-control-label"> <i class="fas fa-cog"></i>  @lang('app.list_of_roles')</label>
														 <a href="{{ url('roles/create') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_role')</button>
													   </a>
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th>
																		@lang('app.title')
															 </th>
															 <th></th>
														 </tr>
													 </thead>
													 <tbody>

                               @foreach ($roles as $key => $role)

														 <tr>
															 <td data-label="@lang('app.title')">	{{clean($role->title)}}</td>


															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("roles/{$role->id}/edit")}}/{{app()->getLocale()}}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$role->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>

																 <div class="dropdown">
																		 <button type="button" class="btn btn-success dropdown-toggle top-controls" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				 @lang('app.operation')
																		 </button>
																		 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																			 <a class='dropdown-item' href='{{url("roles/user/{$role->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>	@lang('app.user_roles')</a>
																			 <a class='dropdown-item' href='{{url("roles/permissions/{$role->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>	@lang('app.role_permissions_txt')</a>
																		 </div>
																	 </div>

															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$roles->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>



@endsection


@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("roles/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/roles")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});

								 })



						</script>

@endsection
