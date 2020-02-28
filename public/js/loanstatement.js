$(document).ready(function() {

    $('#loan-datatable').DataTable({
        processing: true,
        serverside: true,
        ajax: '/datatable/loantaken',
        columns: [
             {data: 'loan_pid', name: 'id'},
            {data: 'loan_amount', name:'Loan Amount'},
            {data: 'loan_length', name:'Loan Tenure'},
            {data: 'repayment_amount', name:'Repayment amount'},
            {data: 'loan_status', name:'Loan status'},
            {data: 'amount_paid', name:'Amount Paid'},
            {data: 'amount_left', name: 'Amount Left'},
            {data:'expiration_date', name: 'Expiration Date'},
            {data:'payment_status', name:'Payment Status'},
            {data: 'created_at', name:'created_at'},
            // {data: 'action', name:'Action'},
        ],

        ordering:false,
         
    })


    $("#loan-datatable").on("click", "a.viewloan", function () {
                
        $("#loan_modal_body").load("/user/editloan/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
            {
                 $("#loan_modal").modal({
                                backdrop: 'static',
                                keyboard: true
                            }, "show");
                           // bindForm(this);
            });
        return false;
        });

})