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
																				  @include("employee.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> @lang('app.list_of_employee')</label>
														 <a href="{{ url('employee/create/0') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_employee')</button>
													   </a>


														  @include("plugins.ajax_add_major")
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																	 @lang('app.employee_name')
															  </th>
                                <th scope="col">
																		@lang('app.employee_email')
																 </th>
																 <th scope="col">
																	  @lang('app.employee_status')
																 </th>
																 <th scope="col">
																		@lang('app.employee_join_data')
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

                                  @foreach ($employees as $key => $employee)

														 <tr>
															 <td data-label="@lang('app.employee_name')">{{clean($employee->employee_name)}}</td>
															 <td data-label="@lang('app.employee_email')">
																	{{clean($employee->employee_email)}}
                                </td>
																<td data-label="@lang('app.employee_status')">
																	 {{clean($status[$employee->employee_status])}}
																 </td>

																 <td data-label="@lang('app.employee_join_data')">
 																	 	{{ date("Y-m-d",strtotime($employee->employee_join_date))}}
 																 </td>

																 <td data-label="@lang('app.branch_name')">	{{ \App\branch::find($employee->branch_id)!=null? clean(\App\branch::find($employee->branch_id)->branch_title):""}}
																</td>

																 <td data-label="@lang('app.submit_user_name')">	{{$employee->users != null ?$employee->users->name:""	}}

																 </td>


															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("employee/{$employee->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$employee->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>

																 <div class="dropdown" style="top: -38px;right:89px;">
																		 <button type="button" class="btn btn-success dropdown-toggle top-controls" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				 @lang('app.operation')
																		 </button>
																		 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                         @if(Auth::user()->AllowToPath("manage_salary"))
																			 <a class='dropdown-item' href='{{url("employeemajor/{$employee->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
                                         @lang('app.manage_salary_of_employee')
																		  </a>
																			@endif

																			@if(Auth::user()->AllowToPath("add_salary"))
																				<a class='dropdown-item add_new_extra_salary'  href="#" data-title="{{$employee->id}}"  data-href='{{url("employeemajor/create/1")}}/{{$employee->id}}/{{app()->getLocale()}}'>
																					@lang('app.add_employee_salary')
																			  </a>
																		  @endif


																			 <a class='dropdown-item' href='{{url("transactions/employee/salary/{$employee->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																			  	@lang('app.Add_payments')
																			</a>

                                    	@if(Auth::user()->AllowToPath("manage_user"))
																			<a class='dropdown-item add_new_extra_salary' href="#"  data-href='{{url("ajax/emp/user/{$employee->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																				 @lang('app.related_user_employee')
																		 </a>
																		  @endif
																		 </div>
																	 </div>



															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$employees->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>


@endsection

@section('footerjscontent')

<script type="text/javascript">
								$(".deleted_btn").on("click",function(){

									var id = $(this).attr("data-title");
									var url_delete = '{{url("employee/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													 $.ajax({url: url_delete , success: function(result){

																result = JSON.parse(result);
																console.log(result);
																if(result.sucess)
																{
																		window.location.href = '{{url("/employee")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																}
														 }});

									});


									$(".add_new_extra_salary").on("click",function(){


												 var id = $(this).attr("data-title");
												 var create_form_url = $(this).attr('data-href');
												 $.ajax({url: create_form_url , success: function(result){
																	 $(".create_body_content").html(result);
																	 $('#pop_ups_modals').modal();

																	 $(".add_emp_major").on("click",function()
																	 {
																			$(".compond_emp_major").val($(".employee_val").val()+"-"+$(".major_val").val());
																			$(".compond_emp_major_current").val($(".employee_val").val()+"-"+$(".major_val").val()+"-"+$(".is_current").val());
																			$(".add_extra_salary_btn").submit();

																	 });

																	 $(".add_extra_salary_btn").submit(function(e){

																				e.preventDefault();
																				var submit_form_url = $(this).attr('action');
																				var formData = new FormData($(this)[0]);
																				$(".alert-success").css("display","none");
																				$(".alert-danger").css("display","none");
																				$.ajax({
																						 url: submit_form_url,
																						 type: 'POST',
																						 data: formData,
																						 async: false,
																						 dataType: 'json',
																						 success: function (response) {
																								 $(".alert-success").html("Sucessfully Added");
																								 $(".alert-success").css("display","block");
																								 setTimeout(function(){location.reload(); }, 2000);
																						 },
																						 error : function( data )
									                           {
									                               if( data.status === 422 )
									                               {
									                                   var $error_text = "";
									                                   var errors = $.parseJSON(data.responseText);
									                                   $.each(errors.errors, function (key, value) {
									                                        $error_text +=value+"<br>";
									                                    });

									                                   $(".alert-danger").html($error_text);
									                                   $(".alert-danger").css("display","block");

									                               }

									                           },
																						 cache: false,
																						 contentType: false,
																						 processData: false
																				 });

																				 return false;
																		});



												}});
									 });


 </script>

@endsection
