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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.new_branch')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						  @include("branch.sub_add")
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
							 $(".country_name").on("change",function(){

								 var val = $(this).val();
								 var url_cities = '{{url("city/country")}}'+"/"+val+'/{{app()->getLocale()}}'
													$.ajax({url: url_cities , success: function(result){

															 result = JSON.parse(result);
															 $(".city_name").html(result.cities);

														}});

								 })



						</script>

@endsection
