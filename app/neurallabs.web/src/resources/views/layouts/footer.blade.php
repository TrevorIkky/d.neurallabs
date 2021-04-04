<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p>
            &copy; <span id="copy-year">{{ \Carbon\Carbon::now()->year}}</span> Copyright Neural Labs
        </p>
    </div>

</footer>

</div>
</div>


<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
<script src="{{asset('assets/plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/jekyll-search.min.js')}}"></script>


<script src="{{ asset('assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/data-tables/datatables.responsive.min.js') }}"></script>

<script src="{{ asset('assets/plugins/charts/Chart.min.js') }}"></script>
<script defer src="{{asset('assets/js/chart.js')}}"></script>


<script defer>
    window.addEventListener('load', function (wl) {
    const pathname = window.location.pathname
    if (pathname.includes('/dashboard')) {
        $('#request-details-data-table').DataTable({
            "aLengthMenu": [[20, 30, 50, 75, -1], [20, 30, 50, 75, "All"]],
            "pageLength": 20,
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            ajax: "{{ url('/requests/get_all_request_details') }}",
            "columnDefs": [
                {
                    "targets": [2, 4],
                    "className": "dt-center"

                },
                {
                    "targets": [5],
                    "className": "dt-center",
                    "width": "5%",
                    "data": "file.path",
                    "render": function (data, type, full, meta) {
                        return ` <div>
                                        <button type="button" class="mb-1 btn btn-sm btn-outline-success">
                                                <i class="mdi mdi-information-variant"></i>
                                                <a style="color:green;" href="${data}">Details?</a></button>
                                            <button type="button" class="mb-1 btn btn-sm btn-outline-danger">
                                                <i class="mdi mdi-file-image"></i>
                                                <a  style="color:red;" href="${data}">Image?</a></button>
                                               
                                        </div>`;
                    }
                },
            ],
            columns: [
                {
                    data: "request_id",
                    "render": function (data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                { data: "user.name" },
                { data: "request_result" },
                { data: "created_at" },
                { data: "stages.length" },

            ]
        });
    } else if (pathname.includes('/manage_users')) {
        const manageUsersTable = $('#manage-user-table').DataTable({
            "aLengthMenu": [[20, 30, 50, 75, -1], [20, 30, 50, 75, "All"]],
            "pageLength": 20,
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            ajax: "{{url('/users/get_all_users')}}",
            "columnDefs": [
                {
                    "targets": [2, 4],
                    "className": "dt-center"

                },
                {
                    "targets": [5],
                    "className": "dt-center",
                    "width": "18%",
                    "data": "suspended",
                    "render": function (data, type, full, meta) {
                        let details = data == 0 ? { color: "danger", icon: "mdi-account-remove-outline", text: "Suspend" }
                            : { color: "success", icon: "mdi-account-arrow-left-outline", text: "Resume" }
                        return `<td><div>
                                        <button type="button" data-suspend-status = ${data} class="suspend-action mb-1 btn btn-sm btn-block btn-outline-${details.color}">
                                                <i class="mdi ${details.icon}"></i>
                                                ${details.text} </button>
                                        </div></td>`;
                    }
                },
            ],
            columns: [
                {
                    data: "user_id",
                    "render": function (data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                { data: "name" },
                { data: "email" },
                { data: "telephone" },
                { data: "updated_at" },

            ]
        })


        $('#manage-user-table tbody').off('click').on('click', '.suspend-action',   async function () {
            var tbl_data = manageUsersTable.row($(this).parents('tr')).data();
            console.log(tbl_data)
            try {
                const isSuspended = tbl_data.suspended ? 0 : 1
                const patchData = { status: isSuspended, user_id: tbl_data.user_id }
                const response = await ajaxRequest('PATCH', "{{route('change_suspension')}}", patchData)
                if (response && response.msg) {
                    callToaster(true, response.msg)
                    manageUsersTable.ajax.reload()
                }
            } catch (error) {
                console.log(error)
                callToaster(false, "Unable to modify user!")
            }
        })
    } else if (pathname.includes('/manage_api_tokens')) {
        let dataAccessTokens = null
        const manageTokensTable = $('#manage-tokens-data-table').DataTable({
            "aLengthMenu": [[20, 30, 50, 75, -1], [20, 30, 50, 75, "All"]],
            "pageLength": 20,
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            ajax: "{{url('/users/get_users_with_token')}}",
            "initComplete": function (settings, json) {
             
            },
            "columnDefs": [
                {
                    "targets": [5],
                    "className": "dt-center",
                    "width": "18%",
                    "data": null,
                    "render": function (data, type, full, meta) {
                        let details = data.is_token_null ?   { color: "success", icon: "mdi-account-arrow-left-outline", text: "Generate Access Token" } :
                         { color: "danger", icon: "mdi-account-remove-outline", text: "Revoke Access" }
                        let attrData = JSON.stringify(data)
                        return data.is_token_null ?  ` <button data-user-details = ${attrData}  type="button" class="re-gen-action mb-1 btn btn-sm btn-block btn-outline-${details.color}">
                                                <i class="mdi ${details.icon}"></i>
                                                ${details.text}</button>` :  ` <button data-user-details = ${attrData} data-toggle="modal" data-target="#confirmRevokeToken" type="button" class="revoke-action mb-1 btn btn-sm btn-block btn-outline-${details.color}">
                                                <i class="mdi ${details.icon}"></i>
                                                ${details.text}</button>`;
                    }
                },
            ],
            columns: [
                {
                    data: "user_id",
                    "render": function (data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                { data: "name" },
                { data: "email" },
                { data: "telephone" },
                { data: "token" },

            ]
        })


       

        $('#manage-tokens-data-table tbody').off('click').on('click', '.revoke-action', function () {
            var tbl_data = manageTokensTable.row($(this).parents('tr')).data();
            dataAccessTokens = tbl_data
        })

        $('#manage-tokens-data-table tbody').on('click', '.re-gen-action', async function () {
            var tbl_data = manageTokensTable.row($(this).parents('tr')).data();
            console.log(tbl_data)
            try {
                    const response = await ajaxRequest('POST', "{{route('regen.access.token')}}", tbl_data)
                    if (response && response.msg) {
                        callToaster(true, response.msg)
                        manageTokensTable.ajax.reload()
                        $('#displayRenewedAccessToken').modal('show')
                        $('#display_token_name').html( 'Token Name: ' + response.token_name)
                        $('#display_token').html('Plain Text Token: ' + response.token)
                    }
                } catch (error) {
                    if (error && error.msg) {
                        callToaster(true, error.msg)
                    }
                    console.log(error)
                    callToaster(false, 'An error occurred. Unable to generate user access token.')
                }
           
        })

        $('#confirmRevoke').click(
            async function(e){
                try {
                    const response = await ajaxRequest('POST', "{{route('revoke.access.token')}}", dataAccessTokens )
                    if (response && response.msg) {
                        callToaster(true, response.msg)
                      
                        manageTokensTable.ajax.reload()
                    }
                } catch (error) {
                    if (error && error.msg) {
                        callToaster(true, error.msg)
                    }
                    console.log(error)
                    callToaster(false, 'An error occurred. Unable to revoke user access token.')
                }
                $('#confirmRevokeToken').modal('hide')
            }

        )

        $('#confirmSendMail').click( async function(e){
            try {
                console.log($('#api_access_email').val())
                $('#confirmSendMail').find('span').remove()
                $('#confirmSendMail').append('<span class="spinner-border spinner-border-sm ml-2 mr-2" role="status" aria-hidden="true"></span>')
                    const response = await ajaxRequest('POST', "{{route('api_access_mail')}}", {mail_to: $('#api_access_email').val()})
                    
                    if (response && response.msg) {
                        callToaster(true, response.msg)
                        $('#api_access_email').val('')
                        $('#apiAccessMail').modal('hide')
                        $('#confirmSendMail').find('span').remove()
                    }
                } catch (error) {
                    if (error && error.msg) {
                        callToaster(true, error.msg)
                    }
                    $('#apiAccessMail').modal('hide')
                    $('#confirmSendMail').find('span').remove()
                    callToaster(false, 'An error occurred. Unable to send mail.')
                }

               
               
        })

    }
})
</script>
<script src="{{ asset('assets/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ladda/ladda.min.js') }}"></script>

<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{asset('assets/js/sleek.bundle.js')}}"></script>

</body>

</html>