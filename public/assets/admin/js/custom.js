function notify(status,message){
    console.log(status,message)
    if(status=='success'){
        new PNotify({
            title: 'Success!',
            text: message,
            addclass: 'bg-success border-success'
        });
    }else if(status=='error'){
        new PNotify({
            title: 'Danger',
            text: message,
            addclass: 'bg-danger border-danger'
        });
    }
}

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // var validator = $('.form-validate').validate({
    //     ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
    //     errorClass: 'validation-invalid-label',
    //     successClass: 'validation-valid-label',
    //     validClass: 'validation-valid-label',
    //     highlight: function(element, errorClass) {
    //         $(element).removeClass(errorClass);
    //     },
    //     unhighlight: function(element, errorClass) {
    //         $(element).removeClass(errorClass);
    //     },
    //     success: function(label) {
    //         label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
    //     },

    //     // Different components require proper error label placement
    //     errorPlacement: function(error, element) {

    //         // Unstyled checkboxes, radios
    //         if (element.parents().hasClass('form-check')) {
    //             error.appendTo( element.parents('.form-check').parent() );
    //         }

    //         // Input with icons and Select2
    //         else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
    //             error.appendTo( element.parent() );
    //         }

    //         // Input group, styled file input
    //         else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
    //             error.appendTo( element.parent().parent() );
    //         }

    //         // Other elements
    //         else {
    //             error.insertAfter(element);
    //         }
    //     },
    // });

    if (typeof $.validator !== 'undefined') {
        console.log('Yes');
        // Default Settings for jQuery Validator
        $.validator.setDefaults({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function (error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                    if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo(element.parent().parent().parent().parent());
                    }
                    else {
                        error.appendTo(element.parent().parent().parent().parent().parent());
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo(element.parent().parent().parent());
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent());
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function (label) {
                label.addClass("validation-valid-label").text("")
            },
        });
    }


    $(".city_code").change(function () {
        var id= $(this).val();
        $.ajax({
            method:"get",
            url: base_url+"/ajaxrequest",
            data: {id:id}, 
            success:function (data) {
                console.log(data);
                $('#District').val(data.district);
                $('#PinCode').val(data.code);
                $('#StateName').val(data.statename);
                $('#Country').val(data.country);
            },
            error:function () {
            }
        })
    });

    $('.modal').on('hidden.bs.modal', function (e) {
        $(this).find('form').trigger('reset');
    })

     $(".ProgramCode").change(function () {
        var program_code= $(this).val();
        var id = $('#mlevel_id').val();
        $.ajax({
            method:"POST",
            url: base_url+"/admin/filter-program",
            data: {program_code:program_code,id:id}, 
            dataType:'JSON',
            success:function (data) {
                if(data.status){
                    var html = '';
                    var class_name='';
                    $.each(data.items,function(index,item){
                        class_name='';
                        if(id!='' && data.item_codes){
                            if($.inArray(item.ItemCode,data.item_codes)>=0){
                                class_name='selected';
                            }
                        }
                        html += '<option value="'+item.ItemCode+'" '+class_name+'>'+item.ItemName+'</option>';
                    });
                    $('#items').html(html);
                    $('#items').multiselect('rebuild');
                }
                
            },
            error:function () {
            }
        })
    });
});

function change_program(program_code,key,short_name){
    
    console.log(program_code);
    $.ajax({
        method:"POST",
        url: base_url+"/admin/change_program",
        data: {program_code:program_code,short_name}, 
        dataType:'JSON',
        success:function (data) {
            if(data.status){
                $('.program-details .media').removeClass('active');
                $('#program_media_'+key).addClass('active');
                if($('.dataTable').length > 0){
                    $('.dataTable').DataTable().ajax.reload(false,null);
                }

                $('#sel_program_name').text($('#program_media_'+key+' span').text());
            }
        }
    });
}

