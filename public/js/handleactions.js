$(document).ready(function(){
    $('#users').on('change', 'select.useractions', function(){
        var values = $(this).val()
        var newvalue = values.split('-')
        if(newvalue[0] == '0'){

            Swal.fire({
                title: 'You About Block user',
                text: "",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, block user!'
                }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/admin/useractions',
                        type: 'POST',
                        data: {data:values},
                        success(res) {
                          if(res.success == 'success') {
                            Swal.fire(
                              'Approved!',
                              'user blocked.',
                              'success'
                            )
    
                            $('#users').DataTable().ajax.reload();
                          }
                            
                    
                        },
                        error(err) {
                            
                        }
                    })
                    
                }
                })
        }else if(newvalue[0] == '3') {
            Swal.fire({
                title: '',
                text: 'You About Delete user',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete user!'
                }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/admin/useractions',
                        type: 'POST',
                        data: {data:values},
                        success(res) {
                          if(res.success == 'success') {
                            Swal.fire(
                              'Approved!',
                              'user blocked.',
                              'success'
                            )
    
                            $('#users').DataTable().ajax.reload();
                          }
                            
                    
                        },
                        error(err) {
                            
                        }
                    })
                    
                }
                })
        }else if(newvalue[0] == '1'){
          Swal.fire({
            title: '',
            text: "You About Reactivate this user",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, activate the  user!'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:'/admin/useractions',
                    type: 'POST',
                    data: {data:values},
                    success(res) {
                      if(res.success == 'success') {
                        Swal.fire(
                          'Approved!',
                          'user activated.',
                          'success'
                        )

                        $('#users').DataTable().ajax.reload();
                      }
                        
                
                    },
                    error(err) {
                        
                    }
                })
                
            }
            })
        }
        
    })


    $('#users').on('click', 'a.viewuser', function() {
        $('#users_modal_body').load('/admin/viewusers/' + $(this).data("edit-id"), function(responseTxt, statusTxt, xh) {
            $('#users_modal').modal({
               backdrop: 'static',
               keyboard: true
            }, "show");
          });
          return false;
        })
    

    
})


$('#users').on('click', 'a.deleteuser', function() {
    alert('0');
})