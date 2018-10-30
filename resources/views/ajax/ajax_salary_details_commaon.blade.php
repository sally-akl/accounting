
<label class=" form-control-label">
     @lang('app.extra_salary')
</label>

<table class="table table-striped custab">

  <thead>
    <tr>

        <th scope="col">
            @lang('app.sal_manage_extra_slary')
         </th>
         <th scope="col">
            @lang('app.extra_salary_increase_amount')
         </th>


    </tr>
  </thead>

  <tbody>
    <?php
      $total_increase = 0;
      $employee_salary = 0;
     ?>
    @foreach($extra as $e)
   <tr>
     <td data-label="@lang('app.sal_manage_extra_slary')">
      {{clean($e->extra_min->title)}} ( {{clean($e->extra_min->percentage)}}% )
     </td>
    <td data-label="@lang('app.extra_salary_increase_amount')">
      <?php
          $per = clean($e->extra_min->percentage);
          $after = $per;
          if($e->extra_min->val_type == "percentage")
            $after = (($per/100) * $basic_salary);
          $total_increase += $after;
          echo  $after." ".\App\classes\Common::getCurrencyText($employee_major->currancy);
       ?>

     </td>

    <tr>
      @endforeach
      <?php  $employee_salary = $basic_salary + $total_increase;  ?>
    <tr>
      <td></td>
      <td><?php echo $total_increase." ".\App\classes\Common::getCurrencyText($employee_major->currancy);   ?></td>
    </tr>
  </tbody>

</table>



<label class=" form-control-label">
     @lang('app.bouns')
</label>


<table class="table table-striped custab">

  <thead>
    <tr>

        <th scope="col">
            @lang('app.sal_manage_extra_slary')
         </th>
         <th scope="col">
            @lang('app.extra_salary_increase_amount')
         </th>


    </tr>
  </thead>

  <tbody>
    <?php
      $total_increase = 0;

     ?>
    @foreach($bouns as $b)
   <tr>
     <td data-label="@lang('app.sal_manage_extra_slary')">
      {{clean($b->extra_min->title)}} ( {{clean($b->extra_min->percentage)}}% )
     </td>
    <td data-label="@lang('app.extra_salary_increase_amount')">
      <?php
          $per = clean($b->extra_min->percentage);
          $after = $per;
          if($b->extra_min->val_type == "percentage")
             $after = (($per/100) * $basic_salary);
          $total_increase += $after;
          echo  $after." ".\App\classes\Common::getCurrencyText($employee_major->currancy);

       ?>

     </td>

    <tr>
      @endforeach
      <?php  $employee_salary += $total_increase;  ?>
    <tr>
      <td></td>
      <td><?php echo $total_increase." ".\App\classes\Common::getCurrencyText($employee_major->currancy);   ?></td>
    </tr>
  </tbody>

</table>


<label class=" form-control-label">
     @lang('app.discount')
</label>


<table class="table table-striped custab">

  <thead>
    <tr>

        <th scope="col">
            @lang('app.sal_manage_extra_slary_decrease')
         </th>
         <th scope="col">
            @lang('app.extra_salary_after_decrease_amount')
         </th>


    </tr>
  </thead>

  <tbody>
    <?php
      $total_increase = 0;
     ?>
    @foreach($discount as $b)
   <tr>
     <td data-label="@lang('app.sal_manage_extra_slary_decrease')">
      {{clean($b->extra_min->title)}} ( {{clean($b->extra_min->percentage)}}% )
     </td>
    <td data-label="@lang('app.extra_salary_after_decrease_amount')">
      <?php
          $per = clean($b->extra_min->percentage);
          $after = $per;
          if($b->extra_min->val_type == "percentage")
             $after = (($per/100) * $basic_salary);
          $total_increase += $after;
          echo  $after." ".\App\classes\Common::getCurrencyText($employee_major->currancy);
       ?>

     </td>

    <tr>
      @endforeach
    <tr>
      <?php  $employee_salary -= $total_increase;  ?>
      <td></td>
      <td><?php echo $total_increase." ".\App\classes\Common::getCurrencyText($employee_major->currancy);   ?></td>
    </tr>
  </tbody>

</table>


<table class="table table-striped">
  <tr>
    <td>@lang('app.all_amount')</td>
    <td>{{$employee_salary}} {{\App\classes\Common::getCurrencyText($employee_major->currancy)}}</td>
  </tr>

</table>
