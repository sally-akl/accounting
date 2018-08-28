@extends('layouts.master')

@section('content')

<!--begin::Portlet-->
														<div class="m-portlet countryContent">
															<div class="m-portlet__head">
																<div class="m-portlet__head-caption">
																	<div class="m-portlet__head-title titlle">
																		<h3 class="m-portlet__head-text">

                                      @lang('app.role_permissions_txt') {{$role->title}}
																		</h3>
																	</div>
																</div>
															</div>

                                @include("utility.sucess_message")

                                                            <div class="row toolss">

																															<div class="col-xl-6">

                                                                </div>


                                                                <div class="col-xl-6">
                                                                    <div class="btnAQ">
                                                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push toolsmenu" m-dropdown-toggle="hover" aria-expanded="true">
                                                                      <!--  <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" id="delett">
                                                                            <i class="la la-plus m--hide"></i>
                                                                            <i class="la la-ellipsis-h"></i>
                                                                        </a>
																																			-->
                                                                        <div class="m-dropdown__wrapper ">
                                                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                                            <div class="m-dropdown__inner deleteAllItem">
                                                                                <div class="m-dropdown__body deletebody">
                                                                                    <div class="m-dropdown__content">
                                                                                        <ul class="m-nav">
                                                                                            <li class="m-nav__section m-nav__section--first m--hide">
                                                                                                <span class="m-nav__section-text">
                                                                                                    Quick Actions
                                                                                                </span>
                                                                                            </li>
                                                                                            <li class="m-nav__item">
                                                                                                <a href="" class="m-nav__link">
                                                                                                    <span class="m-nav__link-text">
                                                                                                        <i class="la la-trash"></i> Delete All
                                                                                                    </span>
                                                                                                </a>
                                                                                            </li>

                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                </div>


																																<div class="row advancedSearch">

																										         	</div>


                                                            </div>
                                                            <div class="row dataTables">
																															<form method="POST" action="{{ url('roles/permissions/store') }}">
																																	@csrf

                                                                <table class="table table-striped m-table">
                                                                <tbody>
                                                                    <?php
																																		    $last_module = 0;
																																				$last_permission = 0;
                                                                        foreach($permissions as $key => $per)
																																				{

																																					 if($per->module_id !=  $last_module)
																																					 {
																																						   $last_module = $per->module_id;
																																							 ?>
                                                                                <tr>
																																									<td><?php echo  App\module::find($per->module_id)->title;  ?></td>
																																								</tr>
																																							 <?php

																																					 }

																																					 if($per->module_id !=  $last_permission)
																																					 {
																																						  $last_permission = $per->module_id;

																																					 ?>
                                                                            <tr>

																																					 <?php
                                                                            }

																																						?>

																																						<td>
                                                                            <input type="checkbox" name="permission[]" value="<?php  echo $per->id  ?>" <?php echo in_array($per->id,$permission)?"checked":""; ?> /><?php  echo $per->title;  ?>

																																						</td>

																																						<?php
																																						if($per->module_id !=  $last_permission)
																																						{

																																								?>
																																									</tr>
																																								<?php
																																						}


																																				}


																																		 ?>

                                                                   <tr>
                                                                     <td>
                                                                       <input type="hidden" name="role_val" value="{{$role->id}}" />
																																			 <input type="submit" class="btn btn-success m-btn m-btn--pill" data-toggle="modal" data-target="#m_markdown_modal" value="{{ __('app.save') }}">
                                                                      </td>
																																	 </tr>

                                                                </tbody>
                                                                </table>
                                                              </form>
                                                            </div>



														</div>
														<!--end::Portlet-->


@endsection


@section('subhead')

<!-- BEGIN: Subheader -->
								<div class="m-subheader ">
									<div class="d-flex align-items-center">
										<div class="mr-auto">
											<h3 class="m-subheader__title m-subheader__title--separator">
												@lang('app.role_permissions_txt')
											</h3>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- END: Subheader -->

@endsection
