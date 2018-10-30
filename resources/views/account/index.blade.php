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
																			   	@include("account.search")

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
														 <label class="form-control-label"><i class="fas fa-cog"></i> @lang('app.list_of_accounts')</label>
														 <a href="{{ url('account/create/0') }}/{{app()->getLocale()}}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i> @lang('app.new_account')</button>
													   </a>
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th scope="col">
																																				 @lang('app.account_num')
																																			 </th>

																																			 <th scope="col">
																																				@lang('app.bank_name')
																																			 </th>

																																			 <th scope="col">
																																				@lang('app.account_open_balance')
																																			 </th>

															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                               @foreach ($accounts as $key => $account)

														 <tr>
															 <td data-label="@lang('app.account_num')">	{{$account->account_number}}</td>
															 <td data-label="	@lang('app.bank_name')">	{{$account->bank_name}}</td>
															 <td data-label="	@lang('app.bank_name')">	{{$account->open_balance}}</td>

															 <td class="text-center">
																 <a class='btn btn-info btn-xs' href='{{url("account/{$account->id}/edit")}}/{{app()->getLocale()}}'>
																	 <i class="far fa-edit"></i>
																 </a>
																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$account->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$accounts->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>

@endsection


@section('footerjscontent')

<script type="text/javascript">
								$(".deleted_btn").on("click",function(){

									var id = $(this).attr("data-title");
									var url_delete = '{{url("account/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													 $.ajax({url: url_delete , success: function(result){

																result = JSON.parse(result);
																console.log(result);
																if(result.sucess)
																{
																		window.location.href = '{{url("/account")}}/{{app()->getLocale()}}';
																}
														 }});

									})



						 </script>

@endsection
