$(document).ready(function() {
    $('.text-left').on('submit', function(e) {
        e.preventDefault();
        //formValidate();
        
        let values = $('.text-left').serialize();
        let action = $('.text-left').attr('action');
        console.log(values)
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: values,
            success(res) {
                console.log(res)
            },
            error(error) {
                let errorData = error.responseJSON.errors
                $.each(errorData, function(key, value){
                    console.log(key)
                })
                //console.log(error.responseJSON.errors)
            }
        })
    })
});

function formValidate() {
    $('.text-left').each(function() {  
        $(this).validate({
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote),.note-editable.card-block',
            errorPlacement: function (error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                //console.log(element);
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                } 
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler() {
                alert('submit')
            }
        });
    });
}

