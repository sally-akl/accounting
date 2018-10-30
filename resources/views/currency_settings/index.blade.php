@extends('layouts.master')

@section('content')


<section id="add-form">
										 <div class="container-fluid">
												 <div class="row align-items-center justify-content-center">
														 <div class="card col-lg-12 padding20">
															 <div class="row">
															 <div class="col-lg-6">
																		 <label class=" form-control-label"><i class="fa fa-search" aria-hidden="true"></i> @lang('app.Search')</label>
																	 </div>
																	 </div>
																	 <div class="row">
																		 <div class="col-lg-12 mg-top25">
																			   	@include("currency_settings.search")
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
														 <label class="form-control-label"><i class="fas fa-cog"></i> @lang('app.currency_settings')</label>

													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																	 @lang('app.curr_date')
															</th>

															<th scope="col">
																		@lang('app.cur_currency')
															</th>

															<th scope="col">
																		@lang('app.price_egp')
															 </th>

															 <th scope="col">
 																		@lang('app.price_sar')
 															 </th>

															 <th scope="col">
																		 @lang('app.price_usd')
																</th>

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                               @foreach ($currency_settings as $key => $currency)
														 <tr>
															 <td data-label="@lang('app.curr_date')">	{{clean($currency->currency_date)}}</td>
															 <td data-label="	@lang('app.cur_currency')">	{{clean($currency->current_currency)}}</td>
															 <td data-label="	@lang('app.price_egp')">	{{clean($currency->EGP)}}</td>
															 <td data-label="	@lang('app.price_sar')">	{{clean($currency->SAR)}}</td>
															 <td data-label="	@lang('app.price_usd')">	{{clean($currency->USD)}}</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("currency/{$currency->id}/edit")}}/{{app()->getLocale()}}'>
																	 <i class="far fa-edit"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach

													 </tbody>
												 </table>

													  {{$currency_settings->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection
