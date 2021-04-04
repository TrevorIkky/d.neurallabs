
const ajaxRequest = (reqType, uri, data, isFormdata = false) => {
    return new Promise((resolve, reject) => {
        let options = {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: reqType,
            url: uri,
            dataType: "json",
            data: isFormdata ? data : { ...data },
            processData: isFormdata ? false : true,
            success: function (resp) {
                resolve(resp);
            },
            error: err => {
                console.log(err)
                reject(new Error(err));
            }
        }
        if (isFormdata) {
            options = { ...options, enctype: 'multipart/form-data', contentType: false }
        }
        $.ajax(options);
    });
};


function callToaster(status, message) {
    if (document.getElementById("toaster")) {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        if (status) {
            toastr.success(message, "Success");
        } else {
            toastr.success(message, "Error");
        }
    }
}





