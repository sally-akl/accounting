@extends('layouts.master')

@section('content')


<section id="add-form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i>@lang('app.add_new_bouns') </label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																				 	 @include("bouns.sub_add")

																					 </div>
																				 </div>

														 </div>
												 </div>
										 </div>
								 </section>
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
																				 	@include("bouns.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> 	{{App\major::find(App\emplyee_major::find($emp_id)->major_id)->title}}  @lang('app.for_major') {{App\employee::find(App\emplyee_major::find($emp_id)->emplyee_id)->employee_name}}  @lang('app.list_of_bouns') @lang('app.for_employee')</label>

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
 																		@lang('app.salary')
 																 </th>
																 <th scope="col">
																		 @lang('app.sal_manage_extra_slary')
																	</th>
																	<th scope="col">
 																		 @lang('app.extra_salary_increase_amount')
 																	</th>
																 <th scope="col">
																	@lang('app.extra_salary_after_increase_amount')
																 </th>
																 <th scope="col">
																	 @lang('app.submit_user_name')
																</th>


															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                              @foreach ($bouns as $key => $b)

														 <tr>
															 <td data-label="@lang('app.employee_name')">{{clean(App\employee::find($b->employeeMajorData->emplyee_id)->employee_name)}}</td>
															 <td data-label="@lang('app.major_name')">
																			{{clean(App\major::find($b->employeeMajorData->major_id)->title)}}
                                </td>
																<td data-label="@lang('app.salary')">
																	{{clean(App\emplyee_major::find($b->emp_major_id)->current_salary)}}  {{\App\classes\Common::getCurrencyText($b->employeeMajorData->currancy)}}
																 </td>

																 <td data-label="@lang('app.sal_manage_extra_slary')">
 																	{{clean(App\extra_mis_salaries::find($b->extra_minus_id)->title)}} ( {{App\extra_mis_salaries::find($b->extra_minus_id)->percentage}}% )
 																 </td>
																<td data-label="@lang('app.extra_salary_increase_amount')">
																	<?php
                                      $current_salary = clean(\App\emplyee_major::find($b->emp_major_id)->current_salary);
																			$per = clean(\App\extra_mis_salaries::find($b->extra_minus_id)->percentage);
																			$after = $per;
																			if(\App\extra_mis_salaries::find($b->extra_minus_id)->val_type == "percentage")
																			    $after = (($per/100) * $current_salary);

																			$cu = \App\classes\Common::getCurrencyText($b->employeeMajorData->currancy);
																			echo  $after." ".$cu;
																	 ?>

																 </td>
																 <td data-label="@lang('app.extra_salary_after_increase_amount')">
 																	<?php

 																			$salary_after = $current_salary+$after;
 																			echo  $salary_after." ".$cu;
 																	 ?>

 																 </td>

																 <td data-label="@lang('app.submit_user_name')">	{{$b->users != null ?$b->users->name:""	}}

																 </td>



															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("bouns/{$b->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$b->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$bouns->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>


@endsection

@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("bouns/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/bouns")}}/{{$emp_id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});

								 })

                 assignBeforeSubmit.setClickButton($(".save_bouns_btn")).setSubmitForm($(".save_bouns_form")).setKey("input[name='majoremployee_month_year']").setValues("input[name='emp_m_id']").setValues("input[name='month_year']")
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

						</script>

@endsection
