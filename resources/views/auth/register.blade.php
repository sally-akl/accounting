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
																							 <label class=" form-control-label"> @lang('app.add_new_user')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
	                                                    @csrf


																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.customer_name')</label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name="name" value="{{ old('name') }}" required autofocus   class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " type="text">
																																	 @if ($errors->has('name'))
																																			<span class="invalid-feedback" role="alert">
																																					<strong>{{ $errors->first('name') }}</strong>
																																			</span>
																																	@endif
																															 </div>
																													 </div>


																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   @lang('app.customer_email')</label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name="email" value="{{ old('email') }}" required  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} " type="text">
																																			 @if ($errors->has('email'))
																																				 <span class="invalid-feedback" role="alert">
																																						 <strong>{{ $errors->first('email') }}</strong>
																																				 </span>
																																		 @endif
																																	 </div>
																															 </div>


																															 <div class="form-group row">
																																			<label class="col-sm-3 form-control-label label-sm">  @lang('app.Password') </label>
																																			<div class="col-sm-9">
																																					<input id="inputHorizontalSuccess" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} " type="password">
																																					@if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
																																			</div>
																																	</div>


																																	<div class="form-group row">
	 																																			<label class="col-sm-3 form-control-label label-sm"> @lang('app.Confirm_Password') </label>
	 																																			<div class="col-sm-9">
	 																																					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

	 																																			</div>
	 																																	</div>

																																		<div class="form-group row">
		 																																<label class="col-sm-3 form-control-label label-sm">	@lang('app.branch_name')</label>
		 																																<div class="col-sm-9">
		 																																		<select name="branch_name[]" multiple class="form-control {{ $errors->has('branch_name') ? ' is-invalid' : '' }}">


		 																																								@foreach ($branches as $key => $branch)
		 																																									<option value="{{$branch->id}}" {{old('branch_name') == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
		 																																								@endforeach

		 																																		</select>

		 																																</div>
		 																														</div>


																																		<input type="hidden" name="action" value="{{$action}}" />
																																		<input type="hidden" name="role" value="{{$role}}" />





																									 <button type="submit" class="btn btn-primary">+  @lang('app.Register')</button>
																							 </form>
																					 </div>
																			 </div>

																	 </div>
															 </div>
													 </div>
											 </div>
									 </div>
							 </section>

@endsection
