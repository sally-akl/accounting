@extends('layouts.master')

@section('content')
<section id="user-roles">
                    <div class="container-fluid">
											<div class="row">
											<div class="col-lg-6">
														<label class=" form-control-label">@lang('app.role_permissions_txt') {{$role->title}}</label>
													</div>
													</div>
                        <div class="row card">
                            <div class=" role-options padding20">
															<form method="POST" action="{{ url('roles/permissions/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
																@csrf


																<?php

                                    $last_module = 0;
																	  $last_permission = 0;

																		foreach($permissions as $key => $per)
																		{

                                        ?>



                                                  <?php

																									    if($per->module_id !=  $last_module)
																											{
                                                            if($key != 0) echo '</div> <hr>';
                                                            echo '	<div class="form-group row">';
																														$last_module = $per->module_id;
																												 ?>
																											   	 <label class="col-sm-3 form-control-label"><?php echo  App\module::find($per->module_id)->title;  ?></label>
																											   <?php

																										  }


																									 ?>

																									<div class="i-checks roles">
																												<input id="checkboxCustom1 " type="checkbox" name="permission[]" value="<?php  echo $per->id  ?>" <?php echo in_array($per->id,$permission)?"checked":""; ?> class="checkbox-template">
																												<label class="checkbox-inline" for="checkboxCustom1"><?php  echo $per->title;  ?>  </label>
																											</div>



																				<?php



																		}

																?>

                              </div>
                                <div class="form-group row">
                                <input type="hidden" name="role_val" value="{{$role->id}}" />
                               	<input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.save') }}">
                              </div>

																						</form>
                            </div>
                            </div>
                    </div>
                </section>
@endsection
