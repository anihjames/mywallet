$(document).ready(function() {
    $('#tran-datatable').DataTable( {
        processing: true,
        serverside:true,
        ajax: "/datatable/trans",
        columns: [
            // {data: 'id', name:'Id', 'visiable': false},
            {data: 'trans_type', name:'Transaction Type'},
            {data: 'trans_name', name:'Name'},
            {data: 'trans_amount', name:'Amount'},
            {data: 'balance', name: 'Balance'},
            {data:'created_at', name:'Date/Time'},
            {data:'action', name:'Action',orderable: false, searchable: false}
        ],
        //order: [[1 , 'desc']],
        
    })

   
})