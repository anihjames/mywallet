<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\MobileTopup;
use App\Models\Bill_payment;
use App\Models\Transaction;
use App\User;
use App\Models\Wallet;
use Auth;
use DB;
use Carbon\Carbon;

class DatatablesController extends Controller
{
    public function getrecentTopups()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $topups = DB::table('mobile_topups')->where('wallet_key', $wallet->wallet_key)->select([ 'id','toptype', 'mobile_number', 'network_provider', 'amount', 'status', 'created_at', 'updated_at']);
        //dd($trans);
        
        return Datatables::of($topups)
                ->editColumn('created_at', '{!! $created_at !!}')
                // ->addColumn('action', function($tran) { 
                //     return '<a href="#more-'.$tran->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>more details</a>';
                // })
                ->addColumn('action', function($topup) {
                   if($topup->status == 'successfull'){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.$topup->status.'</a>';
                   }else {
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$topup->status.'</a>';
                   }
                })
                // ->editColumn('id', 'ID: {{$id}}')
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
        //dd($trans);
        
        return Datatables::of($trans)
                ->editColumn('created_at', '{!! $created_at !!}')
                // ->addColumn('action', function($tran) { 
                //     return '<a href="#more-'.$tran->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>more details</a>';
                // })
                ->addColumn('action', function($tran) {
                   if($tran->trans_status == 'successfull'){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.$tran->trans_status.'</a>';
                   }else {
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$tran->trans_status.'</a>';
                   }
                })
                // ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }

    public function Bill()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $bills = Bill_payment::where('wallet_key', $wallet->wallet_key)
                    ->select(['payment_pid','bills_type', 'bills_amount', 'type_code', 'status', 'created_at', 'bill_type_id']);
                    

        return Datatables::of($bills)
                ->editColumn('created_at', '{!! $created_at !!}')
                // ->addColumn('action', function($tran) { 
                //     return '<a href="#more-'.$tran->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>more details</a>';
                // })
                ->addColumn('action', function($bill) {
                   if($bill->status == 'successfull'){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.$bill->status.'</a>';
                   }else {
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$bill->status.'</a>';
                   }
                })
                // ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }

    public function Loans()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $loans = DB::table('take_loans')
                        ->select(['loan_amount','loan_app_date', 'loan_length', 'verified', 'created_at']);

        return Datatables::of($loans)
                    ->editColumn('created_at', function($loan) {
                        return  $loan->created_at->diffForHumans();
                    })
                    ->addColumn('action', function($loan) {
                        if($loan->verified == '2'){
                            //2 approved
                            return '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.'Approved'.'</a>';
                        }elseif($loan->verified == '1') {
                            //1 awaiting approval
                            return '<a href="javascript:void(0)" class="btn btn-xs btn-info">'.'Awaiting Approval'.'</a>';
                        }elseif($loan->verified == '0') {
                            //0 not approved
                            return '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.'Disapproved'.'</a>';
                        }
                    })
                    ->editColumn('edit', function($loan) {
                        return '<a href="#more-'.$loan->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>edit</a>';
                    })
                    ->editColumn('delete', function ($loan) {
                        return '<a href="#more-'.$loan->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-danger"></i>cancel loan</a>';
                    })
                    
                    ->rawColumns(['edit'=>'edit','delete' => 'delete','action' => 'action'])
                    ->make(true);
    }
}
