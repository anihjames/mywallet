$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#loans').DataTable({
          processing: true,
          serverside: true,
          ajax: '/admin/getloans',
          columns: [
              {data: 'fullname', name:'Fullname'},
              {data: 'loan_amount', name:'Loan Amount'},
              {data:'loan_length', name:'Loan tenure'},
              {data:'created_at', name:'Date'},
              {data:'status', name: 'Status'},
              {data:'action' , name: 'action'}
          ],
          order: [[1, 'desc']]
      })
});