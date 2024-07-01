$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// for editing event
$(document).on('click', '.event-edit', function(e) {
    e.preventDefault()
    $('#modal_remote').modal('toggle');
    var id = $(this).data('id');

    $('.calendar-modal-event').modal('hide');
    $('#modalCreateEvent').modal('show');

    var url = '/calendars/' + id +'/edit';
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
            $('.remote-modal-content').html('<div class="modal-body text-center"><img style="width:250px;" src="images/loader.gif"></div>')
        },
        success: function(html){
            $('.remote-modal-content').html(html);

            $('.date').datetimepicker({
                timepicker:false,
                format:'Y-m-d',
                formatDate:'Y-m-d',
                scrollMonth : false
            });
            $('.tags').tagsinput();

            $('.time').datetimepicker({
                datepicker:false,
                format:'H:i',
                step:15
            });
            _modalFormValidation();
        }
    });
});

// For deleting event
$(document).on('click', '#delete_item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');

    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: true,
        closeOnCancel: true
    }).then((isConfirm) => {
        if (isConfirm) {
            $.ajax({
                url: url,
                method: 'Delete',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'danger') {
                        toastr.error(data.message);
                    } else {
                        toastr.success(data.message);

                        if (data.load) {
                            setTimeout(function () {

                                window.location.href = "";
                            }, 2500);
                        }
                    }
                },
                error: function (data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors
                    var i = 0;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                        i++;
                    });
                }
            });
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
});

// Modern Form Validation
var _modalFormValidation = function () {
    if ($('.content_form').length > 0) {
        $('.content_form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }
    $('.content_form').on('submit', function (e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submitting').show();
        $(".ajax_error").remove();
        var submit_url = $('.content_form').attr('action');
        var formData = new FormData($(".content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);
                } else {
                    toastr.success(data.message);

                    $('#modal_remote').modal('toggle');

                    if (data.load) {
                        setTimeout(function () {
                            window.location.href = "";
                        }, 1500);
                    }

                    $('#submit').show();
                    $('#submitting').hide();
                }
            },
            error: function (data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function (key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.error(value);
                        i++;
                    });
                } else {
                    toastr.error(jsonValue.message);

                }
                $('#submit').show();
                $('#submitting').hide();
            }
        });
    });
};

// For Modal Opening 
$(document).on('click', '.content_management', function(e) {
    e.preventDefault();
    $('#modal_remote').modal('toggle');
    
    let url = $(this).data('url');

    $('.remote-modal-content').html('');
    $('#modal-loader').show();
    
    $.ajax({
        url: url,
        type: 'Get',
        dataType: 'html',
        beforeSend: function () {
            $('.remote-modal-content').html('<div class="modal-body text-center"><img style="width:250px;" src="images/loader.gif"></div>')
        }
    })
    .done(function (data) {
        $('.remote-modal-content').html(data);

        $('.date').datetimepicker({
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d',
            scrollMonth : false
        });

        $('.tags').tagsinput();

        $('.time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15
        });
        _modalFormValidation();
    })
    .fail(function (data) {
        $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
        $('#modal-loader').hide();
    });
})

// For service worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
    .then(function(registration) {
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(error) {
        console.log('ServiceWorker registration failed: ', error);
    });
}