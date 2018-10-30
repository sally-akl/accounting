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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_expense')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action="{{ url('expense/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
                                                    @csrf



																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.expense_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "title" value="{{ old('title') }}"  placeholder="" class="form-control   {{ $errors->has('title') ? ' is-invalid' : '' }} form-control-success" type="text">
																															 </div>
																													 </div>
                                                          <input type="hidden" name="where_from" value="{{$where_from}}" />
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
@endsection
