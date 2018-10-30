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
																							 <label class=" form-control-label"><i class="far fa-edit"></i> @lang('app.update_system_template')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">
																						   @include("utility.error_messages")
																							 <form method="POST" action='{{url("templates/{$template->id}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
                                                  @csrf



																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">@lang('app.template_name')</label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess"  name= "title"   placeholder="{{ __('app.enter_category_name') }}" class="form-control form-control-success" type="text" value="{{$template->title}}">
																															 </div>
																													 </div>


																													 <div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">@lang('app.template_body')</label>
																																	 <div class="col-sm-9">
																																			 <textarea rows="30" cols="60" class="template_body"  name="body">{{$template->content}}</textarea>
																																	 </div>
																															 </div>

																									 <button type="submit" class="btn btn-primary">{{ __('app.save') }} </button>
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


@section('footerjscontent')

<script type="text/javascript">

						ClassicEditor.create( document.querySelector( '.template_body' ) )
											.catch( error => {
													console.error( error );
												});
						</script>

@endsection
