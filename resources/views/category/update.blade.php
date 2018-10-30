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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_category')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("category/{$category->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																                 @csrf

																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">	@lang('app.category_parent')</label>
																										<div class="col-sm-9">
																												<select name="parent" class="form-control">

																													<option value="0">No Parent</option>

																														@foreach ($categories as $key => $cat)
																															<option value="{{$cat->id}}"  {{$cat->id == $category->parent_id ?"selected":""}}>{{$cat->title}}</option>
																														@endforeach

																												</select>

																										</div>
																								</div>


																								@if(is_int($branches))
																									<input type="hidden" name="branch_name" value="{{$category->branch_id}}" />

																									 @else

																									 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
																														<div class="col-sm-9">
																												<select name="branch_name" class="form-control">


																																		 @foreach ($branches as $key => $branch)
																																			 <option value="{{$branch->id}}" {{$category->branch_id == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
																																		 @endforeach

																													</select>
																													</div>
																											</div>

																									 @endif

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.category_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "title"  placeholder="{{ __('app.enter_category_name') }}" class="form-control form-control-success" type="text" value="{{$category->title}}">
																															 </div>
																													 </div>



																									 <button type="submit" class="btn btn-primary">{{ __('app.update_category') }} </button>
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
