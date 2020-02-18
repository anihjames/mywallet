<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public $status, $action, $created_at;
    public function __construct() 
    {
        $this->middleware(['auth']);
        
    }

    public function index()
    {
        return view('admin.home');
    }

    public function Totalbills()
    {
        return view('admin.total_bill');
    }

    public function Toptops()
    {
        return view('admin.total_topup');
    }

    public function TotalLoans()
    {
        return view('admin.applied_loans');
    }

    public function viewTops($id)
    {

        $topups = DB::table('mobile_topups')
                        ->join('wallets', 'wallets.wallet_key', '=', 'mobile_topups.wallet_key')
                        ->join('users', 'users.id', '=', 'wallets.user_id')
                        ->join('transactions', 'transactions.trans_pid', '=', 'mobile_topups.mobile_pid')
                        ->where('mobile_topups.id', '=', $id)
                        ->select('mobile_topups.id','mobile_topups.toptype','mobile_topups.dataplan','mobile_topups.mobile_number','mobile_topups.network_provider', 'mobile_topups.amount', 'mobile_topups.status','mobile_topups.mobile_pid', 'mobile_topups.created_at','mobile_topups.wallet_key', 'users.fname', 'users.lname', 'transactions.balance')
                        ->first();

        //dd($topups);

        return view('modals.viewtopup')->with('topups', $topups);
    }

    public function getBills()
    {
        
        $bills = DB::table('bill_payments')
                    ->join('wallets', 'wallets.wallet_key', '=', 'bill_payments.wallet_key')
                    ->join('users', 'users.id', '=', 'wallets.user_id')
                    ->select('bill_payments.payment_pid', 'bill_payments.bills_type', 'bill_payments.bills_amount', 'bill_payments.type_code', 'bill_payments.created_at', 'bill_payments.status', 'users.fname', 'users.lname', 'users.email', 'users.phone');
                   

        return Datatables::of($bills)
                    ->editColumn('bill_payments.created_at', '{!! $created_at !!}')
                    ->addColumn('fullname',  function($bill) {
                        return $bill->fname. ' '. $bill->lname;
                    })
                    ->addColumn('action', function($bill) {
                        
                        if($bill->status == '2'){
                            return '<button class="btn btn-xs btn-primary">'.'Completed'.'</button>';
                        }else {
                            return '<button class="btn btn-xs btn-danger">'.'Failed'.'</button>';
                        }
                    })
                    //->addColumn('fullname')
                    ->make(true);
            
    }

    public function getTopups()
    {
        $topups = DB::table('mobile_topups')
                ->join('wallets', 'wallets.wallet_key', '=', 'mobile_topups.wallet_key')
                ->join('users', 'users.id', '=', 'wallets.user_id')
                ->select('mobile_topups.id','mobile_topups.toptype','mobile_topups.mobile_number','mobile_topups.network_provider', 'mobile_topups.amount', 'mobile_topups.status','mobile_topups.mobile_pid', 'mobile_topups.created_at', 'users.fname', 'users.lname');

            return Datatables::of($topups)
                        ->editColumn('mobile_topups.created_at', '{!! $created_at !!}')
                        ->addColumn('mobile_number', function($topup) {
                            return '0'.$topup->mobile_number;
                        })
                        ->addColumn('fullname',  function($topup) {
                            return $topup->fname. ' '. $topup->lname;
                        })
                        ->addColumn('action', function($topup) {
                            $buttons = '';
                            if($topup->status == '2'){
                                $buttons = '<button class="btn btn-xs btn-primary">'.'Completed'.'</button>';
                                $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-primary viewtopup" data-edit-id="'.$topup->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                            }else {
                                $buttons =  '<button class="btn btn-xs btn-danger">'.'Failed'.'</button>';
                                $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-primary viewtopup" data-edit-id="'.$topup->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                            }
                            return $buttons;
                        })
                        ->make(true);
    }

    public function getLoans()
    {
        $loans = DB::table('take_loans')
                    ->join('wallets', 'wallets.wallet_key', '=', 'take_loans.wallet_key')
                    ->join('users', 'users.id', '=', 'wallets.user_id')
                    ->select('take_loans.id','take_loans.loan_pid','take_loans.loan_amount','take_loans.loan_length', 'take_loans.verified', 'take_loans.created_at', 'users.fname', 'users.lname');

        return Datatables::of($loans)
                        ->editColumn('take_loans.created_at', '{!! $created_at !!}')
                        ->addColumn('fullname', function($loan){
                            return $loan->fname. ' ' .$loan->lname;
                        })
                        ->addColumn('status', function($loan) {
                            $buttons = '';
                            if($loan->verified == 2){
                               return 'Approved';
                            }elseif($loan->verified == 0)  {
                                return 'Rejected';
                            }elseif($loan->verified == 1){
                                return 'Pending';

                            }
                            
                        })
                        ->addColumn('action', function($loan) {
                            $buttons = '';
                            if($loan->verified == 1){
                                $buttons = '<button class="btn btn-xs btn-primary"> Pending </button>';
                                $buttons = '<select class="btn btn-xs btn-primary" name="action" id="approveloan">';
                                $buttons .= '<option value="" selected>'. 'choose action' . '</option>';
                                $buttons .= '<option value="1">Approve Loan </option>';
                                $buttons .= '<option value="0">Reject Loan </option>';
                                $buttons .= '</select>';

                                 $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-primary viewtopup" data-edit-id="'.$loan->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                            }
                            return $buttons;
                        })  
                        ->make(true);

    }
}
