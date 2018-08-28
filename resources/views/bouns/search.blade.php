<form method="get" action="{{ url('bouns/search') }}" class="form-inline">
    @csrf
<div class="col-xs-3">
  <select class="form-control m-input" name="emp_m_id" >

        @foreach ($employee_major as $key => $empmaj)
          <option value="{{$empmaj->id}}">	{{App\employee::find($empmaj->emplyee_id)->employee_name}} - {{App\major::find($empmaj->major_id)->title}}</option>
        @endforeach
  </select>
</div>

<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
