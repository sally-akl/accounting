<section id="manage-incom">
									 <div class="container-fluid">
											 <div class="row">
													 <div class="col-lg-12">
															 <div class="card">
																	 <div class="card col-lg-12 padding20">
																			 <div class="row">
																					 <div class=" mg-top25">
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i>	 @lang('app.add_new_city')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">

                                             <form method="POST" class="add_extra_salary_btn" action="{{ url('city/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
                                                @csrf
                                                   @include("city.common_add_content")
                                                  <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
                                             </form>



																					 </div>
																			 </div>

																	 </div>
															 </div>
													 </div>
											 </div>
									 </div>
</section>
