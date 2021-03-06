@extends('layouts.master')

@section('content')


<section id="add-form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i>@lang('app.add_new_extra_salary')</label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																				 	 @include("extra_salary.sub_add")

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
																				 	 @include("extra_salary.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> 	{{App\major::find(App\emplyee_major::find($emp_id)->major_id)->title}}  @lang('app.for_major') {{App\employee::find(App\emplyee_major::find($emp_id)->emplyee_id)->employee_name}}  @lang('app.list_of_extra_salary') @lang('app.for_employee')</label>
													<!--	 <a href="{{ url('extrasalary/create') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_extra_salary')</button>
													   </a>
													 -->
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

                                @foreach ($extra_salary as $key => $salary)

														 <tr>
															 <td data-label="@lang('app.employee_name')">		{{clean(App\employee::find($salary->employeeMajorData->emplyee_id)->employee_name)}}</td>
															 <td data-label="@lang('app.major_name')">
																			{{clean(App\major::find($salary->employeeMajorData->major_id)->title)}}
                                </td>
																<td data-label="@lang('app.salary')">
																	{{clean(App\emplyee_major::find($salary->emp_major_id)->current_salary)}}  {{\App\classes\Common::getCurrencyText($salary->employeeMajorData->currancy)}}
																 </td>

																 <td data-label="@lang('app.sal_manage_extra_slary')">
 																	{{clean(App\extra_mis_salaries::find($salary->extra_minus_id)->title)}} ( {{clean(App\extra_mis_salaries::find($salary->extra_minus_id)->percentage)}}% )
 																 </td>
																<td data-label="@lang('app.extra_salary_increase_amount')">
																	<?php
                                      $current_salary = clean(\App\emplyee_major::find($salary->emp_major_id)->current_salary);
																			$per = clean(\App\extra_mis_salaries::find($salary->extra_minus_id)->percentage);
																			$after = $per;
																			if(\App\extra_mis_salaries::find($salary->extra_minus_id)->val_type == "percentage")
																		    	$after = (($per/100) * $current_salary);

                                       $cu = \App\classes\Common::getCurrencyText($salary->employeeMajorData->currancy);
																			echo  $after." ".$cu;
																	 ?>

																 </td>
																 <td data-label="@lang('app.extra_salary_after_increase_amount')">
 																	<?php
                                    
 																			$salary_after = $current_salary+$after;
 																			echo  $salary_after." ".$cu;
 																	 ?>

 																 </td>
																 <td data-label="@lang('app.submit_user_name')">		{{$salary->users != null ?$salary->users->name:""	}}

																 </td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("extrasalary/{$salary->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$salary->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach
													 </tbody>
												 </table>

													  {{$extra_salary->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>



@endsection

@section('footerjscontent')

<script type="text/javascript">
							 $(".deleted_btn").on("click",function(){

								 var id = $(this).attr("data-title");
								 var url_delete = '{{url("extrasalary/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													$.ajax({url: url_delete , success: function(result){

															 result = JSON.parse(result);
															 console.log(result);
															 if(result.sucess)
															 {
																	 window.location.href = '{{url("/extrasalary")}}/{{$emp_id}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
															 }
														}});

								 })



						</script>

@endsection
