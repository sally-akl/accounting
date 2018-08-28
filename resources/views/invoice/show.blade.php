@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet contentAdd" style="width:100%">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">
																		 @lang('app.view_invoice')
																		</h3>
																	</div>
																</div>
															</div>

                              <div class="row" style="margin-top: 15px;">
															   <div class="col-sm-5">

																 </div>

																 <div class="col-sm-7">

																	 <div class="dropdown" style="float:left;">
																			<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			 @lang('app.send_email')
																			</button>
																			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																				<a class="dropdown-item send_email" data-value="invoice_create" href="#">@lang('app.invoice_created')</a>
																				<a class="dropdown-item send_email" data-value="payment_reminder" href="#">@lang('app.payment_reminder')</a>
																				<a class="dropdown-item send_email" data-value="payment_overdue" href="#">@lang('app.payment_overdue')</a>
																			</div>
																		 </div>

																		 <div class="dropdown" style="float:left;">
																				<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				 @lang('app.mark_as')
																				</button>
																				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																					<a class="dropdown-item" href='{{url("invoice/change/status/{$invoice->id}/paid")}}' >@lang('app.paid')</a>
																					<a class="dropdown-item" href='{{url("invoice/change/status/{$invoice->id}/unpaid")}}' >@lang('app.unpaid')</a>
																					<a class="dropdown-item" href='{{url("invoice/change/status/{$invoice->id}/pending")}}' >@lang('app.pending')</a>
																					<a class="dropdown-item"  href='{{url("invoice/change/status/{$invoice->id}/stoped")}}'>@lang('app.stoped')</a>
																				</div>
																			 </div>

																			 <div class="dropdown" style="float:left;">
																				 <form method="GET" action='{{url("transactions/create/income")}}' class="edit_form_press">

																						 @csrf
																						 <input type="hidden" name="action" value="add_payment" />
																						 <input type="hidden" name="invoice_id" value="{{$invoice->id}}" />
																						<button class="btn btn-danger"   aria-haspopup="true" aria-expanded="false">
																						 @lang('app.add_payments')
																						</button>
                                          </form>
																				 </div>


																				 <div class="dropdown" style="float:left;">
																					 <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																						@lang('app.pdf')
																					 </button>
																					 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																						 <a class="dropdown-item" href='{{url("invoice/{$invoice->id}/show?pdf_type=download")}}'>@lang('app.download_invoice')</a>
																						 <a class="dropdown-item" href='{{url("invoice/{$invoice->id}/show?pdf_type=viewpdf")}}'>@lang('app.view_invoice')</a>

																					 </div>
																					</div>

																				 <div class="dropdown" style="float:left;">
																					 <form method="GET" action='{{url("invoice/{$invoice->id}/edit")}}' class="edit_form_press">
																						 @csrf
																						<button class="btn btn-warning edit_btn"    aria-haspopup="true" aria-expanded="false">
																						 @lang('app.edit')
																						</button>
																					</form>
																					 </div>


																					 <div class="dropdown" style="float:left;">
																							<button class="btn btn-inverse print"   aria-haspopup="true" aria-expanded="false">
																							 @lang('app.print')
																							</button>

																						 </div>

																 </div>




															</div>

                           @include('invoice.invoice')

													 <div class="row dataTables">

															 <table class="table table-striped m-table">
															 <tbody>
																	 <tr>
																			 <th>

																			 </th>
																			 <th>@lang('app.transfer_code')</th>
																			 <th>@lang('app.Date')</th>
																			 <th>@lang('app.Amount')</th>
																			 <th>@lang('app.Description')</th>


																			 <th></th>
																			 <th></th>
																	 </tr>

																			 @foreach ($transfers as $key => $trans)

																			 <tr>
																					 <th scope="row">
																					 </th>

																					 <td>
																							 {{$trans->transfer_code_num}}
																					 </td>

																					 <td>
																							 {{$trans->transfer_date}}
																					 </td>

																					 <td>
																						 {{$trans->transfer_amount}}
																					 </td>

																					 <td>
																					 {{$trans->transfer_desc}}
																					 </td>

																					 <td>

																					 </td>

																			 </tr>

																			 @endforeach
															 </tbody>
															 </table>

													 </div>






														</div>
														<!--end::Portlet-->

														<div class="modal " id="send_email_modal" tabindex="-1" role="dialog">
																  <div class="modal-dialog" role="document">
																    <div class="modal-content">
																			<form method="POST" action='{{url("invoice/email/send")}}' class="send_email_form">

																					@csrf
																      <div class="modal-header">
																        <h5 class="modal-title">Modal title</h5>
																        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																          <span aria-hidden="true">&times;</span>
																        </button>
																      </div>
																      <div class="modal-body">

																				<div class="alert alert-danger in_form" style="display:none">

																				</div>
																				<div class="alert alert-success" style="display:none">

																				</div>


																							<div class="form-group m-form__group">
																									<label for="exampleInputEmail1">
																										@lang('app.To')  :
																									</label>
																									<input type="text"  name= "email_to"  class="form-control m-input email_to"  placeholder="{{ __('app.enter_email_to') }}">
																							</div>

																							<div class="form-group m-form__group">
																									<label for="exampleInputEmail1">
																										@lang('app.cc')  :
																									</label>
																									<input type="text"  name= "email_cc" class="form-control m-input"  placeholder="{{ __('app.enter_email_cc') }}">
																							</div>

																							<div class="form-group m-form__group">
																									<label for="exampleInputEmail1">
																										@lang('app.subject')  :
																									</label>
																									<input type="text"  name= "email_subject" class="form-control m-input"  placeholder="{{ __('app.enter_email_subject') }}">
																							</div>

																							<div class="form-group m-form__group">
																									<label for="exampleInputEmail1">
																										@lang('app.message_body')  :
																									</label>
																									<textarea rows="30" cols="60" class="message_content"  name="message_content"></textarea>

																							</div>


																      </div>
																      <div class="modal-footer">
																        <button type="submit" class="btn btn-primary send_email_btn">Send</button>
																        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																      </div>

																			  </form>
																    </div>
																  </div>
																</div>


														<script type="text/javascript">
															 $(".edit_btn").on("click",function(){
																    $(".edit_form_press").submit();
																 });

																$(".print").on("click",function()
																{
																		printJS('invoice_content', 'html')
																});

																ClassicEditor.create( document.querySelector( '.message_content' ) )
																.then( editor => {
																				window.myEditor = editor
																				})
																				 .catch( error => {
																						 console.error( error );
																           });


															 $(".send_email").on("click",function()
																{
																	 console.log("click email");
																	 var val = $(this).attr("data-value");
																	 var url_template = '{{url("invoice/template/{$invoice->id}")}}'+"/"+val;
																	 $.ajax({url: url_template , success: function(result){

																				 result = JSON.parse(result);

																				 if(result.sucess)
																				 {
																					   $(".email_to").val(result.customer_email);
																						 console.log( window.myEditor);
                                            // $(".message_content").append(result.template_body);
																						 window.myEditor.setData(result.template_body);

																						 $('#send_email_modal').modal();
																				 }
																		}});

																});
																$(".send_email_form").on("submit",function()
																{
																	  var formData = new FormData($(this)[0]);
																		$(".alert-success").css("display","none");
																		$(".alert-danger").css("display","none");
																		$.ajax({
																				 url: '{{url("invoice/email/send")}}',
																				 type: 'POST',
																				 data: formData,
																				 async: false,
																				 dataType: 'json',
																				 success: function (response) {

																				  	//response = JSON.parse(response);
																						if(!response.sucess)
																						{
																							 var $error_text = "";
																							 var keys = Object.keys(response.errors);
																							 var errors = response.errors;

																							 for(var i=0;i<keys.length;i++)
																							 {
																								   var key = keys[i];

																									 for(var j=0;j<errors[key].length;j++)
																									 {
																										  $error_text +=errors[key][j]+"<br>";
																									 }

																							 }
																							 $(".alert-danger").html($error_text);
																							 $(".alert-danger").css("display","block");
																						}
																						else {

																							$(".alert-success").html("Email sucessfully send");
																							$(".alert-success").css("display","block");
																						}

																				 },
																				 cache: false,
																				 contentType: false,
																				 processData: false
																		 });

																		 return false;


																});



														</script>



@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.view_invoice')
											</h3>
											<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
												<li class="m-nav__item m-nav__item--home">
													<a href="#" class="m-nav__link m-nav__link--icon">
														<i class="m-nav__link-icon la la-home"></i>
													</a>
												</li>
												<li class="m-nav__separator">
													-
												</li>
												<li class="m-nav__item">
													<a href='{{url("/invoice")}}'  class="m-nav__link">
														<span class="m-nav__link-text">
															@lang('app.invoice')
														</span>
													</a>
												</li>


											</ul>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
