@extends('layouts.master')

@section('content')

<section id="manage-incom">
									 <div class="container-fluid">
											 <div class="row">
													 <div class="col-lg-12">
															 <div class="card">
																	 <div class="card col-lg-12 padding20">
																			 <div class="row">
																					 <div class=" mg-top25">
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_emp_salary')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																					   @include("salaries.sub_add")
																					 </div>
																			 </div>

																	 </div>
															 </div>
													 </div>
											 </div>
									 </div>
							 </section>



@endsection

@section('footerjscontent')

<script type="text/javascript">
					 $(".add_emp_major").on("click",function()
					 {
							 $(".compond_emp_major").val($(".employee_val").val()+"-"+$(".major_val").val());
							 $(".compond_emp_major_current").val($(".employee_val").val()+"-"+$(".major_val").val()+"-"+$(".is_current").val());
							 $(".add_emp_major_form").submit();

					 });

					</script>

@endsection
