@if(Auth::user()->AllowToPath("add_customer"))
  <a href="#" style="display:inline" class="add_new_customer">
     <button type="button" class="btn btn-primary" style="margin-right: 5px;"><i class="fas fa-plus" style="margin-right: 6px;"></i>@lang('app.add_new_customer')</button>
  </a>
@endif
@include("utility.common_modal")


@section('footerjsplugin')

 <script type="text/javascript">
$(".add_new_customer").on("click",function(){


       var create_form_url = '{{url("customer/create")}}/{{app()->getLocale()}}'
       $.ajax({url: create_form_url , success: function(result){
                 $(".create_body_content").html(result);
                 $('#pop_ups_modals').modal();

                 $(".add_extra_salary_btn").submit(function(e){

                      e.preventDefault();
                      var submit_form_url = $(this).attr('action');
                      var formData = new FormData($(this)[0]);
                      $(".alert-success").css("display","none");
                      $(".alert-danger").css("display","none");
                      $.ajax({
                           url: submit_form_url,
                           type: 'POST',
                           data: formData,
                           async: false,
                           dataType: 'json',
                           success: function (response) {

                             $(".alert-success").html("Sucessfully Added");
                             $(".alert-success").css("display","block");
                               setTimeout(function(){location.reload(); }, 2000);

                           },
                           error : function( data )
                           {
                               if( data.status === 422 )
                               {

                                   var $error_text = "";
                                   var errors = $.parseJSON(data.responseText);
                                   $.each(errors.errors, function (key, value) {
                                        $error_text +=value+"<br>";
                                    });

                                   $(".alert-danger").html($error_text);
                                   $(".alert-danger").css("display","block");

                               }

                           },
                           cache: false,
                           contentType: false,
                           processData: false
                       });

                       return false;
                  });

      }});
 });

 </script>

@endsection
