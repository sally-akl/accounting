<section id="manage-incom">
									 <div class="container-fluid">
											 <div class="row">
													 <div class="col-lg-12">
															 <div class="card">
																	 <div class="card col-lg-12 padding20">
																			 <div class="row">
																					 <div class=" mg-top25">
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i>	 @lang('app.add_new_extra_salary')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">

                                             <form method="POST" class="add_extra_salary_btn" action="{{ url('bouns/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
                                                @csrf
                                                   @include("bouns.common_add_content")
                                                  <button type="submit" class="btn btn-primary save_bouns_btn">+ {{ __('app.save') }} </button>
                                             </form>



																					 </div>
																			 </div>

																	 </div>
															 </div>
													 </div>
											 </div>
									 </div>
</section>
