@extends('layouts.master')

@section('content')

<section id="add-form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i> @lang('app.user_roles') {{$user->name}}</label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																			 @include("utility.error_messages")

																			 <form method="POST" action="{{ url('user/roles/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
 																		      @csrf

																					 <div class="form-group row">
																						<label class="col-sm-3 form-control-label label-sm">	@lang('app.role_title')</label>
																						<div class="col-sm-9">
																								<select name="role_name" class="form-control">

																									@foreach ($roles as $key => $role)
																								      <option value="{{$role->id}}">{{$role->title}}</option>
																							    @endforeach

																								</select>



																						</div>
																				</div>
																				  <input type="hidden" name="user_val" value="<?php  echo $user->id  ?>" />
                                          <button type="submit" class="btn btn-primary">+ {{ __('app.add_role') }} </button>
																			 </form>






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
														 <label class="form-control-label"> <i class="fas fa-cog"></i>  @lang('app.user_roles')</label>

													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th>
																 	@lang('app.user_name')
															 </th>

															 <th>
																	@lang('app.role_title')
															 </th>


														 </tr>
													 </thead>
													 <tbody>

                              @foreach ($user_roles as $key => $r)

														 <tr>
															 <td data-label="Account">	{{$user->name}}</td>
															 <td data-label="Account">	{{$r->title}}</td>


														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													 </div>
									 </div>
								 </div>
							 </section>

@endsection
