@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3 mb-3">
                <button type="button" data-toggle="modal" data-target="#apiAccessMail" class="mb-1 btn btn-outline-primary">
                    <i class=" mdi mdi-star-outline mr-1"></i> Send Api Access Mail</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between">
                        <h2>Api Token Details</h2>
                    </div>

                    <div class="card-body">
                        <div class="responsive-data-table">
                            <table id="manage-tokens-data-table" class="table dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Token Name</th>
                                        <th class="dt-head-center">Actions</th>

                                    </tr>
                                </thead>

                                <tbody>


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



<div class="modal fade" id="confirmRevokeToken" tabindex="-1" role="dialog" aria-labelledby="confirmRevokeTokenLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmRevokeTokenLabel">Revoke Access Token</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to revoke this user's access token. This change cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">No</button>
                <button id="confirmRevoke" type="button" class="btn btn-primary btn-pill">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="apiAccessMail" tabindex="-1" role="dialog" aria-labelledby="apiAccessMailLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="apiAccessMailLabel">Send Access Token Mail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-group col-md-12 mt-3">
                <input type="email" class="form-control input-lg" id="api_access_email" name="email"
                    placeholder="Email to send to..." required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">CANCEL</button>
                <button id="confirmSendMail" type="button" class="btn btn-primary btn-pill">
                    SEND</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="displayRenewedAccessToken" tabindex="-1" role="dialog"
    aria-labelledby="displayRenewedAccessTokenLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="displayRenewedAccessTokenLabel">Access Token</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 id="display_token_name">Token Name</h6>
                <p id="display_token">Token Goes Here</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">No</button>
                <button id="confirmRevoke" type="button" class="btn btn-primary btn-pill">Yes</button>
            </div>
        </div>
    </div>
</div>

@endsection