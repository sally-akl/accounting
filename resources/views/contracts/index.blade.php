@extends('layouts.master')

@section('content')

<section id="add-form" class="search_switch_form">
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
																			   @include("contracts.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> @lang('app.manage_contracts')</label>
														 <a href='{{url("contracts/create")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="display:inline">
														     <button type="button" class="btn btn-primary" style="margin-right: 5px;"><i class="fas fa-plus" style="margin-right: 6px;"></i> @lang('app.add_new_contract')</button>
														  </a>
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																	 @lang('app.contract_title')
															  </th>

																<th scope="col">
																	 @lang('app.begin_date')
																</th>

																<th scope="col">
																	 @lang('app.submit_user_name')
																</th>

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                              @foreach ($contracts as $key => $contract)

														 <tr>
															 <td data-label="@lang('app.contract_title')">	{{clean($contract->title)}}</td>
															 <td data-label="@lang('app.begin_date')">	{{date("Y-m-d",strtotime($contract->begin_date))}}</td>

															 <td data-label="@lang('app.submit_user_name')">	{{$contract->users != null ?$contract->users->name:""	}}

															 </td>

															 <td class="text-center">

																 <a href="#"  class="contract_view"  data-title="{{$contract->id}}">
                                     @lang('app.contract_view')
															   </a>

																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$contract->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$contracts->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

							 @include("utility.common_modal")

@endsection


@section('footerjscontent')

	<script type="text/javascript">
				$(".deleted_btn").on("click",function(){
							var id = $(this).attr("data-title");
							var url_delete = '{{url("contracts/index")}}'+"/"+id+'/{{app()->getLocale()}}'
							$.ajax({url: url_delete , success: function(result){
                  result = JSON.parse(result);
									if(result.sucess)
									{
										 window.location.href = '{{url("/contracts")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
									}
							 }});
					});

					$(".contract_view").on("click",function()
					{
						 	 var val = $(this).attr("data-title");
							 $.ajax({url: '{{url("ajax/contract")}}'+"/"+val+'/{{app()->getLocale()}}' , success: function(result){
                  $(".create_body_content").html(result);
									$("#pop_ups_modals").modal();

 							 }});

					});




		</script>
@endsection
