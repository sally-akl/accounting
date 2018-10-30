@extends('layouts.master')

@section('content')

							 <section id="add-table">
								 <div class="container-fluid">
									 <div class="row align-items-center justify-content-center">
											 <div class="card col-lg-12 custyle">
												 <div class="row">
													 <div class="col-lg-12 mg-top25">
														 <label class="form-control-label"> <i class="fas fa-cog"></i>  @lang('app.list_of_system_template')</label>

													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																																				   @lang('app.template_name')
																																			 </th>

																																			 <th scope="col">
																																			  @lang('app.template_code')
																																			 </th>



															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                                @foreach ($templates as $key => $template)

														 <tr>
															 <td data-label="@lang('app.template_name')">{{$template->title}}</td>
															 <td data-label="@lang('app.template_code')">	{{$template->code}}</td>


															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("templates/{$template->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>

															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$templates->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>


@endsection
