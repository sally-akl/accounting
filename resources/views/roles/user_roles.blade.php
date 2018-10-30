@extends('layouts.master')

@section('content')

<section id="add-form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i>  @lang('app.user_roles') {{$role->title}}</label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																			 @include("utility.error_messages")

																			 <form method="POST" action="{{ url('user/roles/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
																	          @csrf

																					 <div class="form-group row">
																						<label class="col-sm-3 form-control-label label-sm">@lang('app.user_name')</label>
																						<div class="col-sm-9">
																								<select name="user_val[]" multiple class="form-control">

																									@foreach ($users as $key => $u)
																										<option value="{{$u->id}}">{{$u->name}}</option>
																									@endforeach

																								</select>

																									<a href="{{ url('register') }}?action=new_user&role={{$role->id}}&branch={{ Request::query('branch') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>@lang('app.new_user')</a>

																						</div>
																				</div>
																				    <input type="hidden" name="role_name" value="<?php  echo $role->id  ?>" />
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
															 <td data-label="Account">	{{$r->name}}</td>
															 <td data-label="Account">	{{$role->title}}</td>


														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													 </div>
									 </div>
								 </div>
							 </section>

@endsection
