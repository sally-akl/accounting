<form method="get" action="{{ url('employeemajor/search') }}" class="form-inline">
    @csrf
<div class="col-xs-3">
  <select class="form-control m-input" name="employee_val" >

        @foreach ($employees as $key => $emp)
          <option value="{{$emp->id}}">{{$emp->employee_name}}</option>
        @endforeach
  </select>
</div>

<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
