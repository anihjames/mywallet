$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

       $('#users').DataTable({
          processing: true,
          serverside: true,
          ajax: {
            url:'/admin/getusers',
            data: function(d) {
              d.sort = $('#sort').val();
            }
          },
          columns: [
              {data: 'fullname', name: 'Fullname'},
              {data: 'email', name: 'Email'},
              {data: 'phone', name: 'Mobile number'},
              {data: 'email_verified', name:'Email Verified'},
              {data:'status', name: 'user access'},
              {data: 'action', name: 'Action'},
          ],
          searching: false,
          ordering:false,
      })

      $('#sort').on('change',function(){
        $('#users').DataTable().ajax.reload();
      })


      

})