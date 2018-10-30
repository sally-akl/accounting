@extends('layouts.master')

@section('content')
<section id="manage-incom">
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="card" style="height:100% ;">
                                 <div class=" col-lg-12" style="padding-left: 30px;">
                                     <div class="row">
                                         <div class=" mg-top25">
                                             <label class=" form-control-label">	@if($trans_type == "income")
         																				 @lang('app.add_new_income')
         																			 @elseif($trans_type == "expense")
         																				 @lang('app.add_new_expense')
         																			 @elseif($trans_type == "transfer")
         																					 @lang('app.add_new_transaction')

         																			 @endif</label>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-12 mg-top30">
                                           @include("utility.error_messages")

                                             <form method="POST" action="{{ url('transactions/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" class="transactions_form" enctype="multipart/form-data">
                                                 @csrf



                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">@lang('app.date') </label>
                                                     <div class="col-sm-9">
                                                         <input   name= "transfer_d"  value="{{ old('transfer_d') }}" placeholder="{{ __('app.enter_date') }}" class="form-control {{ $errors->has('transfer_d') ? ' is-invalid' : '' }} form-control-success" type="date">
                                                     </div>
                                                 </div>

                                                 @if($trans_type == "expense")
                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">  @lang('app.from_person') </label>
                                                     <div class="col-sm-9">
                                                              <input   name= "from_person" value="{{ old('from_person') }}"  placeholder="{{ __('app.from_person') }}" class="form-control {{ $errors->has('from_person') ? ' is-invalid' : '' }} form-control-success" type="text">

                                                     </div>
                                                 </div>

                                                  @endif

                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">@lang('app.account_amount') <span id="current_currency_val"><?php  echo $currency;   ?></span></label>
                                                     <div class="col-sm-9">
                                                         <input id="tran_amount"  name= "amount" value="{{ old('amount') }}"  placeholder="{{ __('app.enter_amount') }}" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }} form-control-success" type="text">
                                                     </div>
                                                 </div>


                                                 @if($trans_type == "expense")
                                                   <div class="form-group row">
                                                      <label class="col-sm-3 form-control-label label-sm">@lang('app.cur_currency')</label>
                                                      <div class="col-sm-9">
                                                         <select name="currency" class="form-control  {{ $errors->has('currency') ? ' is-invalid' : '' }}">
                                                             <option value="SAR" >@lang('app.sar_currency')</option>
                                                             <option value="EGP" >@lang('app.egp_currency')</option>
                                                             <option value="USD" >@lang('app.usd_currency')</option>
                                                         </select>


                                                      </div>
                                                    </div>
                                                  @endif

                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">@lang('app.account_amount_in_character') </label>
                                                     <div class="col-sm-9">
                                                         <input id="inputHorizontalSuccess"  name= "amount_in_character" value="{{ old('amount_in_character') }}"  placeholder="{{ __('app.account_amount_in_character') }}" class="form-control {{ $errors->has('amount_in_character') ? ' is-invalid' : '' }} form-control-success" type="text">
                                                     </div>
                                                 </div>

                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">	@lang('app.desc')</label>
                                                     <div class="col-sm-9">

                                                          <textarea name="desc" rows="3" cols="70" class="form-control {{ $errors->has('desc') ? ' is-invalid' : '' }}  form-control-success">{{ old('desc') }}</textarea>
                                                     </div>
                                                 </div>


                                                 @if($trans_type == "income")
                                                     @if(Session::get('filtered_invoice') == null)


                                                          <div class="form-group row">
                                                              <label class="col-sm-3 form-control-label label-sm">  @lang('app.invoice')</label>
                                                              <div class="col-sm-9">
                                                                  <select name="invoice_val" id="invoice_val" class="form-control {{ $errors->has('invoice_val') ? ' is-invalid' : '' }}">
                                                                    @foreach ($invoices as $key => $inv)
                                                                     <option value="{{$inv->id}}" {{old('invoice_val') == $inv->id ?"selected":""}}>{{$inv->invoice_code_num}}</option>
                                                                    @endforeach

                                                                  </select>
                                                              </div>
                                                          </div>
                                                            <input type="hidden" name="check_invoice_income" id="check_invoice_income" />

                                                        @else
                                                        <input type="hidden" name="invoice_val" id="invoice_val" value="{{Session::get('filtered_invoice')}}" />

                                                        <input type="hidden" name="check_invoice_income" id="check_invoice_income" />
                                                     @endif
                                                     @elseif($trans_type == "expense")
                                                     <div class="form-group row">
                                                         <label class="col-sm-3 form-control-label label-sm">  @lang('app.expense') </label>
                                                         <div class="col-sm-9">
                                                             <select name="expense_val" class="form-control {{ $errors->has('expense_val') ? ' is-invalid' : '' }}">

                                                                    @foreach ($expense_type as $key => $exp)
                                                                     <option value="{{$exp->id}}" {{old('expense_val') == $exp->id ?"selected":""}}>{{$exp->title}}</option>
                                                                    @endforeach

                                                             </select>
                                                             <a href='{{ url("expense/create/{$trans_type}") }}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>@lang('app.new_expense_type')</a>
                                                         </div>
                                                     </div>

                                                     <div class="form-group row">
                                                            <label class="col-sm-3 form-control-label label-sm"> @lang('app.express_file')  </label>
                                                            <div class="col-sm-9">
                                                              <input  name="logo" type="file" id="imageInput">

                                                            </div>
                                                     </div>

                                                      @endif







                                                 <input type="hidden" name="transfer_type" value="{{$trans_type}}" />
                                                 <input type="hidden" name="action_type" value="" />
                                                 <input type="hidden" name="emp_id" value="" />


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


                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">	@lang('app.submit_user_name')</label>
                                                        <div class="col-sm-9">

                                                            {{ Auth::user()->name }}
                                                        </div>
                                                    </div>







                                                 <button type="submit" class="btn btn-primary">+ @lang('app.save') </button>
                                             </form>
                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="card" style="height: 100%;">

                                 <div class=" col-lg-12 custyle">
                                     <div class="row">
                                         <div class="col-lg-12 mg-top25">
                                             <label class="form-control-label"> @if($trans_type == "income")
               																 @lang('app.list_of_income')
               															 @elseif($trans_type == "expense")
               																 @lang('app.list_of_expense')
               															 @elseif($trans_type == "transfer")
               																	 @lang('app.list_of_transfer')

               															 @elseif($trans_type == "all")
               																		 @lang('app.all')

               															 @endif</label>

                                              @if($trans_type != "all")

                                        <!--      <a href='{{url("transactions/create/{$trans_type}")}}/{{app()->getLocale()}}?branch={{ Request::query("branch") }}' style="display:inline">
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

                                           -->


                                               @endif
                                         </div>
                                     </div>
                                     @include("utility.sucess_message")
                                     <table class="table table-striped custab mg-top25">
                                         <thead>
                                             <tr>
                                               <th scope="col">@lang('app.transfer_code')</th>
                                               <th scope="col">@lang('app.Date')</th>
                                               <th scope="col">@lang('app.Amount')</th>
                                               <th scope="col">@lang('app.amount_after_trans')</th>
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
                                                 <td data-label="@lang('app.transfer_code')">	{{clean($trans->transfer_code_num)}}</td>
                                                 <td data-label="@lang('app.Date')">{{date("Y-m-d",strtotime($trans->transfer_date))}}</td>
                                                 <td data-label="@lang('app.Amount')">{{clean($trans->transfer_amount)}} {{\App\classes\Common::getCurrencyText($trans->currancy)}}</td>
                                                 <td data-label="@lang('app.amount_after_trans')">	{{clean($trans->converted_transfer_amount)}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</td>
                                                 <td data-label="@lang('app.Description')">	{{clean($trans->transfer_desc)}}</td>
                                                 <td data-label="@lang('app.submit_user_name')">	{{$trans->users != null ?$trans->users->name:""	}}

                                                 </td>
                                                 <td class="text-center">

                                                     <a href="#" class="btn btn-danger btn-xs deleted_btn" data-title="{{$trans->id}}">
                                                         <i class="far fa-trash-alt"></i>
                                                     </a>

                                                     <a href="#" class="btn btn-primary btn-xs send_email_icon_btn" data-title="{{$trans->id}}">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                     </a>
                                                     <a href="#" class="btn btn-primary btn-xs print_icon_btn" data-title="{{$trans->id}}">
                                                        <i class="fa fa-print" aria-hidden="true"></i>
                                                     </a>
                                                 </td>
                                             </tr>
                                              @endforeach

                                         </tbody>
                                     </table>
                                      {{$transfers->links('vendor.pagination.default')}}

                                      <input type="hidden" id="hidden_trans_type" value="{{$trans_type}}" />

                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
             </section>


           <div style="display:none" id="transaction_type_content">


           </div>



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

                 });



                 $(".send_email_icon_btn").on("click",function(){
                     var id = $(this).attr("data-title");
                     var trans_type = $("#hidden_trans_type").val();
                     var url_send_email = '{{url("transactions/sendmail")}}'+"/"+id+"/"+trans_type+'/{{app()->getLocale()}}'
                     $.ajax({url: url_send_email , success: function(result){

                         result = JSON.parse(result);
                         if(result.sucess)
                         {

                         }

                     }});
                 });

                 $(".print_icon_btn").on("click",function(){
                     var id = $(this).attr("data-title");
                     var trans_type = $("#hidden_trans_type").val();
                     var url_print = '{{url("transactions/print")}}'+"/"+id+"/"+trans_type+'/{{app()->getLocale()}}'
                     $.ajax({url: url_print , success: function(result){

                          result = JSON.parse(result);
                          if(result.sucess)
                          {
                            $("#transaction_type_content").html(result.template_body);
                            setTimeout(function(){   var DocumentContainer = document.getElementById('transaction_type_content');
                              var WindowObject = window.open('', 'PrintWindow', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');

                              WindowObject.document.writeln('<!DOCTYPE html>');
                              WindowObject.document.writeln('<html><head><title></title>');
                              WindowObject.document.writeln('<link rel="stylesheet" type="text/css" href="http://localhost:8000/css/style.print.css" media="print">');
                              WindowObject.document.write('<style type="text/css">');
                              WindowObject.document.write('.table_x {width: 100%;float:right !important;}');
                              WindowObject.document.write('h3 {text-align:center}');
                              WindowObject.document.write('</style>');
                              WindowObject.document.writeln('</head><body>');
                              WindowObject.document.writeln(DocumentContainer.innerHTML);
                              WindowObject.document.writeln('</body></html>');

                              WindowObject.document.close();
                              WindowObject.focus();
                              WindowObject.print();
                              WindowObject.close();}, 200);


                          }
                        }});

                      });



            </script>

            @if($trans_type == "income")

            	  <script type="text/javascript">

            			 $(".transactions_form").submit(function() {
                        var amount = $("#tran_amount").val();
            						var invoice_val = $("#invoice_val").val();
            						$("#check_invoice_income").val(invoice_val+"-"+amount);

                   });
                   $("#invoice_val").on("change",function()
                   {
                       var id = $(this).val();
                       var url_get_currency = '{{url("ajax/invoice")}}'+"/"+id+"/"+'{{app()->getLocale()}}?branch={{ Request::query("branch") }}'
       								 $.ajax({url: url_get_currency , method:"get" , success: function(result){
                            result = JSON.parse(result);
       											if(result.msg == "sucess")
                            {
                                $("#current_currency_val").text(result.currancy);
                                $("input[name='amount']").val(result.price);
                            }
       									}});
                   });

            		</script>
            	@endif

@endsection
