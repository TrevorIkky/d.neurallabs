@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">Requests per month</h2>
                    </div>
                    <div class="card-body" style="height: 450px;">
                        <canvas id="linechart" class="chartjs"></canvas>
                    </div>
                </div>
            </div>


            @can('viewAdminDashboardElements', Auth::user())
            <div class="col-12">
                <div class="card card-default pb-5">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">User summary</h2>
                    </div>
                    <div class="card-body" style="height: 300px;">
                        <canvas id="bar3"></canvas>
                        <div id='customLegend' class='customLegend'></div>
                    </div>
                </div>
            </div>
            @endcan



            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between">
                        <h2>Api Request Details</h2>
                    </div>

                    <div class="card-body">
                        <div class="responsive-data-table">
                            <table id="request-details-data-table" class="table dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Request By</th>
                                        <th>Image Result</th>
                                        <th>Request Made At</th>
                                        <th>Request Stages</th>
                                        <th class="dt-head-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>
                                            <div>
                                                <button type="button" class="mb-1 btn btn-sm btn-outline-primary">
                                                    <i class="mdi mdi-file-image"></i>
                                                    View Image</button>
                                            </div>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="right-sidebar-2">
        <div class="right-sidebar-container-2">
            <div class="slim-scroll-right-sidebar-2">

                <div class="right-sidebar-2-header">
                    <h2>Layout Settings</h2>
                    <p>User Interface Settings</p>
                    <div class="btn-close-right-sidebar-2">
                        <i class="mdi mdi-window-close"></i>
                    </div>
                </div>

                <div class="right-sidebar-2-body">
                    <span class="right-sidebar-2-subtitle">Header Layout</span>
                    <div class="no-col-space">
                        <a href="javascript:void(0);"
                            class="btn-right-sidebar-2 header-fixed-to btn-right-sidebar-2-active">Fixed</a>
                        <a href="javascript:void(0);" class="btn-right-sidebar-2 header-static-to">Static</a>
                    </div>

                    <span class="right-sidebar-2-subtitle">Sidebar Layout</span>
                    <div class="no-col-space">
                        <select class="right-sidebar-2-select" id="sidebar-option-select">
                            <option value="sidebar-fixed">Fixed Default</option>
                            <option value="sidebar-fixed-minified">Fixed Minified</option>
                            <option value="sidebar-fixed-offcanvas">Fixed Offcanvas</option>
                            <option value="sidebar-static">Static Default</option>
                            <option value="sidebar-static-minified">Static Minified</option>
                            <option value="sidebar-static-offcanvas">Static Offcanvas</option>
                        </select>
                    </div>

                    <span class="right-sidebar-2-subtitle">Header Background</span>
                    <div class="no-col-space">
                        <a href="javascript:void(0);"
                            class="btn-right-sidebar-2 btn-right-sidebar-2-active header-light-to">Light</a>
                        <a href="javascript:void(0);" class="btn-right-sidebar-2 header-dark-to">Dark</a>
                    </div>

                    <span class="right-sidebar-2-subtitle">Navigation Background</span>
                    <div class="no-col-space">
                        <a href="javascript:void(0);"
                            class="btn-right-sidebar-2 btn-right-sidebar-2-active sidebar-dark-to">Dark</a>
                        <a href="javascript:void(0);" class="btn-right-sidebar-2 sidebar-light-to">Light</a>
                    </div>

                    <span class="right-sidebar-2-subtitle">Direction</span>
                    <div class="no-col-space">
                        <a href="javascript:void(0);"
                            class="btn-right-sidebar-2 btn-right-sidebar-2-active ltr-to">LTR</a>
                        <a href="javascript:void(0);" class="btn-right-sidebar-2 rtl-to">RTL</a>
                    </div>

                    <div class="d-flex justify-content-center" style="padding-top: 30px">
                        <div id="reset-options" style="width: auto; cursor: pointer"
                            class="btn-right-sidebar-2 btn-reset">Reset
                            Settings</div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
@endsection