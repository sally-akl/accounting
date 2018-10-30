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
																			  @include("expenseType.search")

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
														 <label class="form-control-label"> <i class="fas fa-cog"></i> @lang('app.list_of_expense_type')</label>
														 <a href="{{ url('expense/create/0') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="display:inline">
														     <button type="button" class="btn btn-primary"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.new_expense_type')</button>
													   </a>
													 </div>
												 </div>
												 @include("utility.sucess_message")
												 <table class="table table-striped custab">

													 <thead>
														 <tr>
															 <th>
                                  @lang('app.expense_name')
                               </th>


															 <th scope="col"></th>

														 </tr>
													 </thead>
													 <tbody>

                            @foreach ($expenses as $key => $e)
														 <tr>

															<td data-label="@lang('app.expense_name')">	{{clean($e->title)}}</td>

															 <td class="text-center">
																  @if($e->un_deleted == 0)
																 <a class='btn btn-info btn-xs' href='{{url("expense/{$e->id}/edit")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}'>
																	 <i class="far fa-edit"></i>
																 </a>

																 <a href="#" class="btn btn-danger btn-xs deleted_btn"  data-title="{{$e->id}}">
																	 <i class="far fa-trash-alt"></i>
																 </a>
																 @endif
															 </td>
														 </tr>
														   @endforeach



													 </tbody>
												 </table>

													  {{$expenses->links('vendor.pagination.default')}}
													 </div>
									 </div>
								 </div>
							 </section>


@endsection

@section('footerjscontent')

<script type="text/javascript">
								$(".deleted_btn").on("click",function(){

									var id = $(this).attr("data-title");
									var url_delete = '{{url("expense/index")}}'+"/"+id+'/{{app()->getLocale()}}'
													 $.ajax({url: url_delete , success: function(result){

																result = JSON.parse(result);
																console.log(result);
																if(result.sucess)
																{
																		window.location.href = '{{url("/expense")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}';
																}
														 }});

									})
						 </script>
@endsection
