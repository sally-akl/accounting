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
																							 <label class=" form-control-label"><i class="far fa-plus-square"></i> @lang('app.add_new_contract')</label>
																					 </div>
																			 </div>
																			 <div class="row">
																					 <div class="col-lg-12 mg-top30">

																						 @include("utility.error_messages")

																						 <form method="POST" action="{{ url('contracts/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" enctype="multipart/form-data">
																						    @csrf


																						         <div class="form-group row">
																						                 <label class="col-sm-3 form-control-label label-sm">   @lang('app.contract_title') </label>
																						                 <div class="col-sm-9">
																						                     <input id="inputHorizontalSuccess" name= "ti"  value="{{ old('ti') }}"  placeholder="{{ __('app.contract_title') }}" class="form-control {{ $errors->has('ti') ? ' is-invalid' : '' }} form-control-success" type="text">
																						                 </div>
																						             </div>

																												 <div class="form-group row">
																																<label class="col-sm-3 form-control-label label-sm">   @lang('app.begin_date') </label>
																																<div class="col-sm-9">
																																		<input id="inputHorizontalSuccess" name= "b_date"  value="{{ old('b_date') }}"  placeholder="{{ __('app.begin_date') }}" class="form-control {{ $errors->has('b_date') ? ' is-invalid' : '' }} form-control-success" type="date">
																																</div>
																													</div>

																													<div class="form-group row">
																																	 <label class="col-sm-3 form-control-label label-sm">   @lang('app.end_date') </label>
																																	 <div class="col-sm-9">
																																			 <input id="inputHorizontalSuccess" name= "e_date"  value="{{ old('e_date') }}"  placeholder="{{ __('app.end_date') }}" class="form-control {{ $errors->has('e_date') ? ' is-invalid' : '' }} form-control-success" type="date">
																																	 </div>
																													</div>

																													<div class="form-group row">
																																	<label class="col-sm-3 form-control-label label-sm">@lang('app.contract_content')</label>
																																	<div class="col-sm-9">
																																			<textarea rows="150" cols="60" class="template_body"  name="cont"></textarea>
																																	</div>
																															</div>




																																 <div class="form-group row">
																																					<label class="col-sm-3 form-control-label label-sm">@lang('app.contract_second_type')</label>
																																					<div class="col-sm-9">
																																			<select name="ft" class="form-control sign_type">

																																					<option value="customers" {{old('ft') == "customers" ?"selected":""}}>@lang('app.customers')</option>
																																					<option value="employees" {{old('ft') == "employees" ?"selected":""}}>@lang('app.employees')</option>
																																					<option value="other" {{old('ft') == "other" ?"selected":""}}>@lang('app.other')</option>

																																				</select>
																																				</div>
																																		</div>


																																		<div class="form-group row sel_sign_types" id="customers_cont">
	 																																					<label class="col-sm-3 form-control-label label-sm">@lang('app.customers')</label>
	 																																					<div class="col-sm-9">
	 																																			<select name="cut" class="form-control">

																																						@foreach ($customers as $key => $customer)
																																							<option value="{{$customer->id}}" >{{$customer->full_name}}</option>
																																						@endforeach
	 																																				</select>
	 																																				</div>
	 																																		</div>

																																			<div class="form-group row sel_sign_types" id="employees_cont" style="display:none">
		 																																					<label class="col-sm-3 form-control-label label-sm">@lang('app.employees')</label>
		 																																					<div class="col-sm-9">
		 																																			<select name="emp" class="form-control">

																																							@foreach ($employees as $key => $emp)
																																								<option value="{{$emp->id}}">{{$emp->employee_name}}</option>
																																							@endforeach
		 																																				</select>
		 																																				</div>
		 																																		</div>


																																				<div class="form-group row">
																																								 <label class="col-sm-3 form-control-label label-sm">@lang('app.signiture_type')</label>
																																								 <div class="col-sm-9">
																																						 <select name="signature_type" class="form-control type_of_signature">

																																								 <option value="by_signature" {{old('signature_type') == "by_signature" ?"selected":""}}>@lang('app.by_signature')</option>
																																								 <option value="digital_sign" {{old('signature_type') == "digital_sign" ?"selected":""}}>@lang('app.digital_sign')</option>
                                                                                  <option value="other" {{old('signature_type') == "other" ?"selected":""}}>@lang('app.other')</option>
																																							 </select>
																																							 </div>
																																					 </div>



																																					 <div class="form-group row sign_type_all by_signature_cont">
	 																																								 <label class="col-sm-3 form-control-label label-sm">@lang('app.signiture_first_person')</label>
	 																																								 <div class="col-sm-9">
	 																																						        <div id="signature"></div>
																																											<a href="#" class="remove_signature" data-val="signature">@lang('app.remove_sign')</a>
	 																																							 </div>
	 																																					 </div>

																																						 <div class="form-group row sign_type_all by_signature_cont">
		 																																								 <label class="col-sm-3 form-control-label label-sm">@lang('app.signiture_second_person')</label>
		 																																								 <div class="col-sm-9">
		 																																						        <div id="signature_second"></div>
																																												<a href="#" class="remove_signature" data-val="signature_second">@lang('app.remove_sign')</a>
		 																																							 </div>
		 																																					 </div>


																																							 <div class="form-group row sign_type_all digital_sign_cont" style="display:none">
																																											 <label class="col-sm-3 form-control-label label-sm"> @lang('app.digital_sign')  </label>
																																											 <div class="col-sm-9">
																																												 <input  name="logo" type="file" id="imageInput">


																																											 </div>
																																									 </div>




																																					@if(is_int($branches))
																																					<input type="hidden" name="branch_name" value="{{$branches}}" />

																																					@else

																																					 <div class="form-group row">
																																										<label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
																																										<div class="col-sm-9">
																																													<select name="branch_name" class="form-control">

																																																 @foreach ($branches as $key => $branch)
																																																			<option value="{{$branch->id}}" {{old('branch_name') == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
																																																	@endforeach

																																														</select>
																																											</div>
																																							</div>

																																						@endif


																																						<input type="hidden" name="sign_one" value="" />
																																						<input type="hidden" name="sign_two" value="" />



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

@section('footerjscontent')

<script type="text/javascript">

						ClassicEditor.create( document.querySelector( '.template_body' ) )
											.catch( error => {
													console.error( error );
												});

						$(".sign_type").on("change",function()
						{
							     var val = $(this).val();
                   $(".sel_sign_types").css("display","none");
									 $("#"+val+"_cont").css("display","");

						});
						$(".type_of_signature").on("change",function()
						{
							     var val = $(this).val();
                   $(".sign_type_all").css("display","none");
									 $("."+val+"_cont").css("display","");

						});

						var sinature_one = $("#signature");
						var signature_two = $("#signature_second");
						sinature_one.jSignature();
					  signature_two.jSignature();

						$(".remove_signature").on("click",function()
						{
							  var val = $(this).attr("data-val");
								if(val == "signature")
								{
									 sinature_one.jSignature("reset");
									 $("input[name='sign_one']").val("");
								}
								else
								{
									  signature_two.jSignature("reset");
										$("input[name='sign_two']").val("");
								}

               return false;
						});

						$("#signature").bind('change', function(e){
							  var datapair = sinature_one.jSignature("getData");
								$("input[name='sign_one']").val(datapair);
						});

						$("#signature_second").bind('change', function(e){
							  var datapair = signature_two.jSignature("getData");
						    $("input[name='sign_two']").val(datapair);
						});

 </script>

@endsection
