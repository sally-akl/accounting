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
																			   @include("transaction.employee_search")

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
                                <label class="form-control-label">  @lang('app.Transaction_Details_of')
																			{{$employee->employee_name}}</label>
                              </div>
                            </div>
														  @include("utility.sucess_message")
                              <table class="table table-striped custab">
                              <thead>

                                  <tr>
																		<th scope="col">@lang('app.transfer_code')</th>
																		<th scope="col">@lang('app.transfer_type')</th>
																		<th scope="col">@lang('app.Date')</th>
																		<th scope="col">@lang('app.Amount')</th>
																		<th scope="col">@lang('app.Description')</th>
                                    <th scope="col">@lang('app.express_file')</th>
                                  </tr>
                              </thead>
															        @foreach ($transfers as $key => $trans)
                                      <tr style="text-align: center;">
																				<td data-label="@lang('app.transfer_code')">
																					{{clean($trans->transfer_code_num)}}
																				</td>
                                        <td data-label="@lang('app.transfer_type')">
																						{{clean($trans->transfer_type)}}
																				</td>

																				<td data-label="@lang('app.Date')">
																							{{$trans->transfer_date}}
																				</td>

																				<td data-label="@lang('app.Amount')">
																							{{clean($trans->transfer_amount)}}
																				</td>

																				<td data-label="@lang('app.Description')">
																					 	{{clean($trans->transfer_desc)}}
																				</td>

                                        <td data-label="@lang('app.express_file')">
                                          @if($trans->uploaded_file != "")
                                        <a class="express-popup-link" href="{{ url('/') }}/images/{{$trans->uploaded_file}}">  <img src="{{ url('/') }}/images/{{$trans->uploaded_file}}" width="50" height="50"/> </a>
                                          @endif
																				</td>

                                      </tr>
																			  @endforeach

                              </table>
															  {{$transfers->links('vendor.pagination.default')}}

                              </div>
                      </div>
                    </div>
                  </section>


@endsection

@section('footerjscontent')

<script type="text/javascript">
  $('.express-popup-link').magnificPopup({
    type: 'image'
  });
</script>

@endsection
