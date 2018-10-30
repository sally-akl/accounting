@extends('layouts.master')

@section('content')
<section id="add-form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i> @lang('app.add_new_emp_salary')</label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																				  @include("salaries.sub_add")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> {{\App\employee::find($emp_id)->employee_name}}   @lang('app.list_of_salaries') @lang('app.related_to_employee') </label>
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
																		  @lang('app.major_name')
																 </th>
																 <th scope="col">
																	 @lang('app.employee_code')
																 </th>
																 <th scope="col">
																		@lang('app.employee_salary')
																 </th>
																 <th scope="col">
																	 @lang('app.submit_user_name')
																</th>


															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                                  @foreach ($employee_major as $key => $emp_major)

														 <tr>
															 <td data-label="@lang('app.employee_name')">	{{clean($emp_major->emplyeeData->employee_name)}}</td>
															 <td data-label="@lang('app.major_name')">
																		{{clean($emp_major->majorData->title)}}
                                </td>
																<td data-label="@lang('app.employee_code')">
																	{{clean($emp_major->employee_code)}}
																																							<a href='{{url("employeemajor/{$emp_major->id}/editcode")}}/{{$emp_id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="margin-left: 5px;color: red;">  @lang('app.edit')</a>

																 </td>

																 <td data-label="@lang('app.employee_salary')">
 																	 	{{clean($emp_major->current_salary)}} {{\App\classes\Common::getCurrencyText($emp_major->currancy)}}
 																 </td>
																 <td data-label="@lang('app.submit_user_name')">	{{$emp_major->users != null ?$emp_major->users->name:""	}}

																 </td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("employeemajor/{$emp_major->id}/edit")}}/{{$emp_id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$emp_major->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>


																 <div class="dropdown" style="top: -38px;right:89px;">
																		 <button type="button" class="btn btn-success dropdown-toggle top-controls" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				 @lang('app.operation')
																		 </button>
																		 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                       @if(Auth::user()->AllowToPath("manage_extra_salary"))
																			<a class='dropdown-item' href='{{url("extrasalary/{$emp_major->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>

																			   @lang('app.manage_extra_salary_of_employee')
																		   </a>
																			   @endif

                                        @if(Auth::user()->AllowToPath("manage_bouns"))
																				<a class='dropdown-item' href='{{url("bouns/{$emp_major->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>

																				   @lang('app.manage_bouns_of_employee')
																			   </a>
																				  @endif

                                           @if(Auth::user()->AllowToPath("manage_discount"))
																			   <a class='dropdown-item' href='{{url("discount/{$emp_major->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>

																			     @lang('app.manage_discount_of_employee')
																		     </a>
																				 @endif



																				 @if(Auth::user()->AllowToPath("add_extra_salary"))
																					 <a class='dropdown-item add_new_extra_salary' href='#' data-title="{{$emp_major->id}}" data-istype="extra_salary">
																						 @lang('app.add_manage_extra_salary_of_employee')
																					 </a>
																				 @endif

																				 @if(Auth::user()->AllowToPath("add_bouns"))
																					<a class='dropdown-item add_new_extra_salary' href='#' data-title="{{$emp_major->id}}" data-istype="bouns">
																						 @lang('app.add_manage_bouns_of_employee')
																					</a>
																				@endif


																				@if(Auth::user()->AllowToPath("add_extra_salary"))
																					<a class='dropdown-item add_new_extra_salary' href='#' data-title="{{$emp_major->id}}" data-istype="discount">
																					   @lang('app.add_manage_discount_of_employee')
																					</a>
																				@endif



																		 </div>
																	 </div>
															 </td>
														 </tr>
														   @endforeach
													 </tbody>
												 </table>

													  {{$employee_major->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>


							@include("utility.common_modal")
@endsection


@section('footerjscontent')

<script type="text/javascript">
		 $(".deleted_btn").on("click",function(){

					var id = $(this).attr("data-title");
					var url_delete = '{{url("employeemajor/index")}}'+"/"+id+'/{{app()->getLocale()}}'
					$.ajax({url: url_delete , success: function(result){

								result = JSON.parse(result);
								if(result.sucess)
								{
										window.location.href = '{{url("/employeemajor")}}/{{$emp_id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
								}
					}});
		});

		$(".add_new_extra_salary").on("click",function(){


           var id = $(this).attr("data-title");
					 var type = $(this).attr("data-istype");
					 var create_form_url = '{{url("extrasalary/create/")}}'+"/"+id+'/{{app()->getLocale()}}'
					 if(type == "bouns")
					    create_form_url = '{{url("bouns/create/")}}'+"/"+id+'/{{app()->getLocale()}}'
					 if(type == "discount")
	 					  create_form_url = '{{url("discount/create/")}}'+"/"+id+'/{{app()->getLocale()}}'

					 $.ajax({url: create_form_url , success: function(result){
                     $(".create_body_content").html(result);
										 $('#pop_ups_modals').modal();

										 assignBeforeSubmit.setClickButton($(".save_bouns_btn")).setSubmitForm($(".add_extra_salary_btn")).setKey("input[name='majoremployee_month_year']").setValues("input[name='emp_m_id']").setValues("input[name='month_year']")
											.Execute({
													 before : function()
													 {
															var date = $("input[name='bdate']").val();
															date_splites = date.split("-");
															if(date_splites.length > 0)
																$("input[name='month_year']").val(date_splites[1]+"-"+date_splites[0]);
													 },
													 after : function()
													 {

													 }
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



		 $(".add_emp_major").on("click",function()
		 {
				 $(".compond_emp_major").val($(".employee_val").val()+"-"+$(".major_val").val());
				 $(".compond_emp_major_current").val($(".employee_val").val()+"-"+$(".major_val").val()+"-"+$(".is_current").val());
				 $(".add_emp_major_form").submit();

		 });


</script>

@endsection
