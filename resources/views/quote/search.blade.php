<form method="get" action="{{ url('quote/search') }}" class="form-inline">
    @csrf

<div class="col-xs-3">
  <select class="form-control m-input" name="customer_val" >
        @foreach ($customers as $key => $c)
          <option value="{{$c->id}}">{{$c->full_name}}</option>
        @endforeach
  </select>
</div>

<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
