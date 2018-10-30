@extends('layouts.master')

@section('content')
  @if($trans_type == "all")
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
																			   @include("transaction.search")

																					 </div>
																				 </div>

														 </div>
												 </div>
										 </div>
								 </section>
								 	@endif

							 <section id="add-table">
								 <div class="container-fluid">
									 <div class="row align-items-center justify-content-center">
											 <div class="card col-lg-12 custyle">
												 <div class="row">
													 <div class="col-lg-12 mg-top25">
														 <label class="form-control-label"> <i class="fas fa-cog"></i>
															 @if($trans_type == "income")
																 @lang('app.list_of_income')
															 @elseif($trans_type == "expense")
																 @lang('app.list_of_expense')
															 @elseif($trans_type == "transfer")
																	 @lang('app.list_of_transfer')

															 @elseif($trans_type == "all")
																		 @lang('app.all')

															 @endif


														 </label>
														   @if($trans_type != "all")
														 <a href='{{url("transactions/create/{$trans_type}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>
																	 @if($trans_type == "income")
																			  @lang('app.add_new_income')
																	 @elseif($trans_type == "expense")
																				 @lang('app.add_new_expense')
															     @elseif($trans_type == "transfer")
																				 @lang('app.add_new_transaction')

																	 @endif



																 </button>
													   </a>
														   @endif
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">

																																			 </th>
																																			 <th scope="col">@lang('app.transfer_code')</th>
																																			 <th scope="col">@lang('app.Date')</th>
																																			 <th scope="col">@lang('app.Amount')</th>
																																			 <th scope="col">@lang('app.Description')</th>
                                                                       <th scope="col">
                                                                         @lang('app.submit_user_name')
                                                                      </th>

																																			 <th scope="col"></th>



														 </tr>
													 </thead>
													 <tbody>

                                @foreach ($transfers as $key => $trans)

														 <tr>
															 <th scope="row">


																																					 </th>
															 <td data-label="@lang('app.transfer_code')">	{{clean($trans->transfer_code_num)}}</td>
															 <td data-label="@lang('app.Date')">{{$trans->transfer_date}}
                               </td>

															 <td data-label="@lang('app.Amount')">{{clean($trans->transfer_amount)}} {{Auth::user()->currency}}
                               </td>

															 <td data-label="@lang('app.Description')">	{{clean($trans->transfer_desc)}}
                               </td>
                               <td data-label="@lang('app.submit_user_name')">	{{$trans->users->name	}}

                               </td>



															 <td class="text-center">
																 @if($trans_type != "all")
															<!--	 <a class='btn btn-info btn-xs' href='{{url("category/{$trans->id}/show")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>
                               -->
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$trans->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
																 	@endif
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$transfers->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>
@endsection

@section('footerjscontent')

<script type="text/javascript">
               $(".deleted_btn").on("click",function(){

                 var id = $(this).attr("data-title");
                 var url_delete = '{{url("transactions/index")}}'+"/"+id+'/{{app()->getLocale()}}'
                          $.ajax({url: url_delete , success: function(result){

                               result = JSON.parse(result);
                               console.log(result);
                               if(result.sucess)
                               {
                                   window.location.href = '{{url("/transactions/{$trans_type}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
                               }
                            }});

                 })



            </script>

@endsection
