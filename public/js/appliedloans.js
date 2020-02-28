$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var table = $('#loans').DataTable({
          processing: true,
          serverside: true,
          ajax: {
            url:'/admin/getloans',
            data: function(d) {
              d.sort = $('#sort').val();
            }
          },
          columns: [
              {data: 'loan_pid', name:'ID'},
              {data: 'fullname', name:'Fullname'},
              {data: 'loan_amount', name:'Loan Amount'},
              {data:'loan_length', name:'Loan tenure'},
              {data:'created_at', name:'Date'},
              {data:'status', name: 'Status'},
              {data:'action' , name: 'action'}
          ],
          ordering:false,
      })

      $('#sort').on('change',function(){
        table.ajax.reload();
      })

      $('#loans').on('click', 'a.viewloan', function() {

        $('#loan_modal_body').load('/admin/viewloans/' + $(this).data("edit-id"), function(responseTxt, statusTxt, xh) {
           $('#loan_modal').modal({
             backdrop: 'static',
             keyboard: true
           }, "show")
        });
        return false;
      })

      $('#loans').on('change', 'select.approveloan', function(){
        var values = $(this).val();
        var newvalue = values.split('-');
       
        
        
        if(newvalue[0] == '1') {
          Swal.fire({
            title: 'You About Approve Loan',
            text: "",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:'/admin/loanactions',
                    type: 'POST',
                    data: {data:values},
                    success(res) {
                      if(res.success == 'success') {
                        Swal.fire(
                          'Approved!',
                          'Loan as been approved.',
                          'success'
                        )

                        $('#loans').DataTable().ajax.reload();
                      }
                        
                
                    },
                    error(err) {
                        
                    }
                })
                
            }
            })
        }else if(newvalue[0] == '0') {
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reject loan!'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:'/admin/loanactions',
                    type: 'POST',
                    data: {data:values},
                    success(res) {
                      if(res.success == 'success') {
                              Swal.fire(
                                'Rejected!',
                                'Loan rejected.',
                                'success'
                          )

                          $('#loans').DataTable().ajax.reload();

                      }
                        
                    },
                    error(err) {
                        
                    }
                })
                
            }
            })
        }
        
      })
});