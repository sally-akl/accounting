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

                                             <form method="POST" class="add_extra_salary_btn" action="{{ url('ajax/employeeuser/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
                                                @csrf
																								<div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">@lang('app.user_name')</label>
																										<div class="col-sm-9">
																											 <select name="user_val" class="form-control  {{ $errors->has('user_val') ? ' is-invalid' : '' }}">
																												 @foreach ($users as $key => $us)
																																	<option value="{{$us->id}}">{{$us->name}}</option>
																												 @endforeach

																											 </select>

																											 <input type="hidden" name="emp_id" value="{{$id}}"  />


																										</div>
																								</div>
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
