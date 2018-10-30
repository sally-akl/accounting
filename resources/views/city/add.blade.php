@extends('layouts.master')

@section('content')


<section id="manage-incom">
									 <div class="container-fluid">
											 <div class="row">
													 <div class="col-lg-12">
															 <div class="card">
																	 <div class="card col-lg-12 padding20">
																			 <div class="row">

																					 <div class=" col-lg-8  mg-top25">
																							  <label class=" form-control-label"><i class="far fa-plus-square"></i> {{\App\country::find($c)->title}}  @lang('app.add_new_city') {{ __('app.under') }} </label>
																					 </div>

																			  </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						 @include("city.add_sub")
																					 </div>
																			 </div>

																	 </div>
															 </div>
													 </div>
											 </div>
									 </div>
							 </section>


@endsection
