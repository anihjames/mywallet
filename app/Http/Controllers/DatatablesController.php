<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\MobileTopup;
use App\Models\Bill_payment;
use App\Models\Transaction;
use App\User;
use App\Models\Wallet;
use App\Models\Take_loan;
use Auth;
use DB;
use Carbon\Carbon;

class DatatablesController extends Controller
{
    public function getrecentTopups()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $topups = DB::table('mobile_topups')->where('wallet_key', $wallet->wallet_key)->select([ 'id', 'mobile_pid','toptype', 'mobile_number', 'network_provider', 'amount', 'status', 'created_at', 'updated_at']);
       
        
        return Datatables::of($topups)
                ->editColumn('created_at', '{!! $created_at !!}')
                
                ->addColumn('action', function($topup) {
                    if($topup->status == '0') {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.'failed'.'</a>';
                    }elseif($topup->status == '1') {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-info">'.'awaiting confirmation'.'</a>'; 
                    }elseif($topup->status == '2') {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.'successfull'.'</a>';
                    }
                    
                })
                ->addColumn('number', function($topup) {
                    return '0'.$topup->mobile_number;
                })
               
                ->make(true);
    }

    public function getTransaction()
    {
        
        return view('dashboard.transaction');
    }

    public function gettrans()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $trans = DB::table('transactions')->where('wallet_key', $wallet->wallet_key)->select([ 'id', 'trans_type', 'trans_status', 'trans_name', 'trans_amount', 'balance', 'created_at', 'updated_at']);
        //dd($trans->get());
        
        return Datatables::of($trans)
                ->editColumn('created_at', '{!! $created_at !!}')
               
                ->addColumn('action', function($tran) {
                    if($tran->trans_status == '0') {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.'failed'.'</a>';
                    }elseif($tran->trans_status == '1') {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-info">'.'awaiting approval'.'</a>';
                    }elseif($tran->trans_status == '2') {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.'successfull'.'</a>';
                    }
                
                })
                
                ->make(true);
    }

    public function Bill()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $bills = Bill_payment::where('wallet_key', $wallet->wallet_key)
                    ->select(['id','payment_pid','bills_type', 'bills_amount', 'type_code', 'status', 'created_at', 'bill_type_id']);
                    

        return Datatables::of($bills)
                ->editColumn('created_at', '{!! $created_at !!}')
                
                ->addColumn('action', function($bill) {
                    if($bill->status == '2'){
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.'successfull'.'</a>';
                       }else {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.'failed'.'</a>';
                       }
                })
                
                ->make(true);
    }

    public function Loans()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $loans = Take_loan::where('wallet_key', $wallet->wallet_key)
                        ->select(['id','loan_pid','loan_amount','loan_app_date', 'loan_length', 'verified', 'created_at']);
                        

        return Datatables::of($loans)
                    ->editColumn('created_at', function($loan) {
                        return $loan->created_at->diffForHumans();
                        
                    })
                    ->addColumn('status', function($loan) {
                        if($loan->verified == '2'){
                            //2 approved
                            return '<button class="btn btn-xs btn-primary">'.'Approved'.'</button>';
                        }elseif($loan->verified == '1') {
                            //1 awaiting approval
                            return '<button class="btn btn-xs btn-info">'.'Pending'.'</button>';
                        }elseif($loan->verified == '0') {
                            //0 not approved
                            return '<button class="btn btn-xs btn-danger">'.'Rejected'.'</button>';
                        }
                    })
                    ->editColumn('action', function($loan) {
                        $buttons= '';
                        if($loan->verified == '2'){
                            // $buttons = '<a href="#" class="btn btn-xs btn-primary viewloan" data-edit-id="'.$loan->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                            $buttons = '<a href="#" class="btn btn-xs btn-danger deleteloan"  data-edit-id="'.$loan->id.'" data-toggle="modal"><i class="fa fa-trash"></i></a>';
                        }else{
                            $buttons = '<a href="#" class="btn btn-xs btn-primary editloan" id="editloan" data-edit-id="'.$loan->id.'" data-toggle="modal"><i class="fa fa-edit"></i></a>';
                        $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-danger deleteloan"  data-edit-id="'.$loan->id.'" data-toggle="modal"><i class="fa fa-trash"></i></a>';
                        }
                        
                        return $buttons;
                    })
                   
                    
                    ->rawColumns(['status'=>'status','action' => 'action'])
                    ->make(true);


        
    }

    public function deleteloan(Request $request)
    {
       $loan = Take_loan::find($request['data']);
       $loan->delete();
       return response()->json(['message'=> 'success']);
    }
}
