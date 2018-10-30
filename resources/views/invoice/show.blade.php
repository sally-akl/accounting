@extends('layouts.master')

@section('content')
<section id="invoice-info">
									 <div class="container-fluid">

											 <div class="card" style="height: auto;padding-bottom:35px;">
													 <h2 class="head">@lang('app.view_invoice') </h2>
													 <div class=" row">
															 <div class="col-lg-3">
																	 <h1 class="padding20"></h1>
															 </div>
															 <div class="col-lg-9 padding20">
																	 <!-- Example single danger button -->
																	 <div class="btn-group drop-action">
																		 <div class="dropdown">
																				 <button type="button" class="btn btn-success dropdown-toggle top-controls" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																						 @lang('app.send_email')
																				 </button>
																				 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																						 <a class="dropdown-item send_email" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"  data-value="invoice_create" href="#">@lang('app.invoice_created')</a>
																						 <a class="dropdown-item send_email" href="#" data-value="payment_reminder">@lang('app.payment_reminder')</a>
																						 <a class="dropdown-item send_email" href="#" data-value="payment_overdue">@lang('app.payment_overdue')</a>

																				 </div>
																			 </div>

                                       <div class="dropdown">
																				 <button type="button" id="dropdownMenuButton2" class="btn btn-info dropdown-toggle top-controls" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																							 @lang('app.mark_as')
																				 </button>
																				 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
																						 <a class="dropdown-item" href='{{url("invoice/change/status/{$invoice->id}/paid")}}/{{app()->getLocale()}}'>@lang('app.paid')</a>
																						 <a class="dropdown-item"  href='{{url("invoice/change/status/{$invoice->id}/unpaid")}}/{{app()->getLocale()}}'>@lang('app.unpaid')</a>
																						 <a class="dropdown-item" href='{{url("invoice/change/status/{$invoice->id}/pending")}}/{{app()->getLocale()}}'>@lang('app.pending')</a>
																						 <a class="dropdown-item"  href='{{url("invoice/change/status/{$invoice->id}/stoped")}}/{{app()->getLocale()}}'>@lang('app.stoped')</a>

																				 </div>
																			  </div>

																			 <form method="GET" action='{{url("transactions/create/income")}}/{{app()->getLocale()}}' class="add_payment_form">
																				 @csrf
																				 <input type="hidden" name="action" value="add_payment" />
																				 <input type="hidden" name="invoice_id" value="{{$invoice->id}}" />


																				<button type="button" class="btn btn-danger dropdown-toggle top-controls add_payment" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																						 @lang('app.add_payments')
																				</button>

																			 </form>

                                       <div class="dropdown">
																				 <button type="button" class="btn btn-warning dropdown-toggle top-controls" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																							@lang('app.pdf')
																				 </button>
																				 <div class="dropdown-menu">
																						<a class="dropdown-item" href='{{url("invoice/{$invoice->id}/show/{app()->getLocale()}?pdf_type=download")}}'>@lang('app.download_invoice')</a>
																						<a class="dropdown-item" href='{{url("invoice/{$invoice->id}/show/{app()->getLocale()}?pdf_type=viewpdf")}}'>@lang('app.view_invoice')</a>

																				</div>
																			</div>




	 																						<button type="button" class="btn btn-secondary dropdown-toggle top-controls print" data-toggle="dropdown" aria-haspopup="true"
	  																							 aria-expanded="false">
	  																							  @lang('app.print')
	  																					 </button>




																	 </div>
															 </div>
													 </div>
													 <!-- end comtrols  -->
                                 @include('invoice.invoice')

																	 <div class=" col-lg-12 custyle">
																	 <table class="table table-striped custab">
																			 <thead>
																				 <tr>
																					  <th>@lang('app.transfer_code')</th>
																						<th>@lang('app.Date')</th>
																						<th>@lang('app.Amount')</th>
																						<th>@lang('app.Description')</th>
																				 </tr>
																			 </thead>
																			 <tbody>
																				  @foreach ($transfers as $key => $trans)
																				 <tr>
																					 <td data-label="Account"> {{$trans->transfer_code_num}}</td>
																					 <td data-label="Due Date"> {{$trans->transfer_date}}</td>
																					 <td data-label="Amount"> {{$trans->transfer_amount}}</td>
																					 <td data-label="Amount"> {{$trans->transfer_desc}}</td>

																				 </tr>
																				 	 @endforeach



																			 </tbody>
																		 </table>
															 </div>


															 </div>
											 </div>


											 <div class="modal " id="send_email_modal" tabindex="-1" role="dialog">
 																  <div class="modal-dialog" role="document">
 																    <div class="modal-content">
 																			<form method="POST" action='{{url("invoice/email/send")}}/{{app()->getLocale()}}' class="send_email_form">

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


							 </section>


@endsection


@section('footerjscontent')

<script type="text/javascript">
	 $(".edit_btn").on("click",function(){
				$(".edit_form_press").submit();
		 });

		 $(".add_payment").on("click",function(){
				 
					$(".add_payment_form").submit();
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
			 var url_template = '{{url("invoice/template/{$invoice->id}")}}'+"/"+val+'/{{app()->getLocale()}}';
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
						 url: '{{url("invoice/email/send")}}/{{app()->getLocale()}}',
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
