<form method="get" action="{{ url('job/search') }}" class="form-inline">
    @csrf
<div class="col-xs-3">
    <input type="text" name="title" class="form-control m-input inputt" placeholder="{{ __('app.enter_job_name') }}">
</div>

<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
