<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\User;
use App\Models\Bill_payment;
use App\Models\Bill_type;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\MobileTopup;
use App\Models\Take_loan;
use App\Models\Pay_loan_taken;
use App\Notifications\usersnotify;
use App\Services\BillService;
use App\Services\AdminServices;

class AdminController extends Controller
{
    public $status, $action, $created_at;
    protected $admin;
    public function __construct(AdminServices $adminservices)
    {
        $this->middleware(['auth']);
        $this->admin = $adminservices;

        
    }

    public function index()
    {

        
        $users = User::all()->count();
        $transactions = Transaction::all()->count();
        $topups = MobileTopup::all()->count();
        $loan = Take_loan::all()->count();
        $total = intVal($topups) + intVal($loan);
        
        return view('admin.home', [
                'users'=> $users,
                'transactions'=> $transactions,
                'topup'=> $topups,
                'loans'=> $loan,
                'total'=> $total,
                
            ]);
        
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

    public function TotalUsers()
    {
        return view('admin.total_user');
    }

    public function gettransactions(Request $request)
    {

        $trans = $this->admin->getTransactions();

        return Datatables::of($trans)
                            ->filter(function($query) use ($request) {
                                    if($request->has('sort')){
                                        $query->where('trans_type', 'like', "%{$request->get('sort')}%");
                                    }
                            })
                            ->addcolumn('status', function($tran) {
                                if($tran->trans_status == '0') {
                                    return 'Failed';
                                }elseif($tran->trans_status == '1'){
                                    return 'Pending';
                                }elseif($tran->trans_status == '2'){
                                    return 'successful';
                                }
                            })
                            
                            ->make(true);
    }

   
    public function viewusers($id)
    {
        $users = DB::table('users')
                        ->join('wallets', 'wallets.user_id', '=', 'users.id')
                        ->where('users.id', '=', $id)
                        ->select('users.fname', 'users.lname', 'users.email', 'users.phone','users.state', 'users.country', 'users.address', 'wallets.wallet_key', 'wallets.wallet_balance', 'wallets.credit_total', 'wallets.debit_total','wallets.loan_taken_amount', 'wallets.loan_amount_left')
                        ->first();

            return view('modals.viewuser')->with('users', $users);
                    
    }
    public function viewBills($id)
    {
        $bills= DB::table('bill_payments')
                        ->join('wallets', 'wallets.wallet_key', '=', 'bill_payments.wallet_key')
                        ->join('users', 'users.id', '=', 'wallets.user_id')
                        ->join('transactions', 'transactions.trans_pid', '=', 'bill_payments.payment_pid')
                        ->where('bill_payments.id', '=', $id)
                        ->select('bill_payments.id','bill_payments.payment_pid', 'bill_payments.bills_type', 'bill_payments.bills_amount', 'bill_payments.type_code', 'bill_payments.created_at', 'bill_payments.status','bill_payments.wallet_key', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'transactions.balance')
                        ->first();
        return view('modals.viewbills')->with('bills', $bills);
    }

    public function viewloans($id)
    {
        $loans = DB::table('take_loans')
                        ->join('wallets', 'wallets.wallet_key', '=', 'take_loans.wallet_key')
                        ->join('users', 'users.id', '=', 'wallets.user_id')
                        ->join('transactions', 'transactions.trans_pid', '=', 'take_loans.loan_pid')
                        ->where('take_loans.id', '=', $id)
                        ->select('take_loans.id','take_loans.loan_pid','take_loans.loan_amount', 'take_loans.loan_length', 'take_loans.created_at','take_loans.wallet_key', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'transactions.balance')
                        ->first();
        return view('modals.viewloans')->with('loans', $loans);
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

    public function getBills(Request $request)
    {
        
        $bills = $this->admin->getbills();

        return Datatables::of($bills)
                    ->filter(function($query) use ($request) {
                        if($request->has('sort')){
                            $query->where('status', 'like', "%{$request->get('sort')}%");
                        }
                    })
                    ->editColumn('bill_payments.created_at', '{!! $created_at !!}')
                    ->addColumn('fullname',  function($bill) {
                        return $bill->fname. ' '. $bill->lname;
                    })
                    ->addColumn('action', function($bill) {
                        $buttons = '';
                        if($bill->status == '2'){
                            $buttons =  '<button class="btn btn-xs btn-primary">'.'Completed'.'</button>';
                            $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-primary viewbill" data-edit-id="'.$bill->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                        }else {
                            $buttons =  '<button class="btn btn-xs btn-danger">'.'Failed'.'</button>';
                            $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-primary viewbill" data-edit-id="'.$bill->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                        }

                        return $buttons;
                    })
                    //->addColumn('fullname')
                    ->make(true);
            
    }

    public function getTopups(Request $request)
    {
        $topups = $this->admin->gettopups();
        
            return Datatables::of($topups)
                        ->filter(function($query) use ($request) {
                            if($request->has('sort')){
                                $query->where('status', 'like', "%{$request->get('sort')}%");
                            }
                        })
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

    public function getLoans(Request $request)
    {
        $loans = $this->admin->getloans();

        return Datatables::of($loans)
                        ->filter(function($query) use ($request) {
                            if($request->has('sort')){
                                $query->where('verified', 'like', "%{$request->get('sort')}%");
                            }
                        })
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
                            $loanpid = $loan->loan_pid;
                            if($loan->verified == 1){
                                //$buttons = '<button class="btn btn-sm btn-primary"> Pending </button>';
                                $buttons = '<select class="btn btn-sm btn-primary approveloan" name="action">';
                                $buttons .= '<option value="" selected>'. 'choose action' . '</option>';
                                $buttons .= '<option value="1'. '-' .$loanpid . ' ">Approve Loan </option>';
                                $buttons .= '<option value="0'. '-' .$loanpid . ' ">Reject Loan </option>';
                                $buttons .= '</select>';

                                 $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-primary viewloan" data-edit-id="'.$loan->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                            }else{
                                $buttons = '&nbsp;&nbsp;<a href="#" class="btn btn-sm btn-primary viewloan" data-edit-id="'.$loan->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                            }
                            return $buttons;
                        })  
                        ->make(true);

    }

    public function getUsers(Request $request)
    {
        $users = DB::table('users')
                    ->join('wallets', 'wallets.user_id', '=', 'users.id')
                    ->select('users.id','users.fname', 'users.lname', 'users.phone','users.email', 'users.verified_email', 'users.state', 'users.country', 'users.address','users.access','users.created_at', 'wallets.wallet_key', 'wallets.wallet_balance')
                    ->orderBy('users.created_at', 'desc');
            return Datatables::of($users)
                                ->filter(function($query) use ($request) {
                                        if($request->has('sort')){
                                            $query->where('users.access', 'like', "%{$request->get('sort')}%");
                                        }
                                })
                                ->addColumn('fullname', function($user){
                                    return $user->fname. ' ' .$user->lname;
                                })
                                ->addColumn('email_verified', function($user) {
                                    if($user->verified_email == 1) {
                                        return "Verified";
                                    }else {
                                        return "Not verified";
                                    }
                                })
                                ->addColumn('status', function($user){
                                    if($user->access == '1'){
                                        return 'Active user';
                                    }elseif($user->access =='0'){
                                        return 'Blocked user';
                                    }
                                })
                                ->editColumn('phone', function($user) {
                                    return "0". $user->phone;
                                })
                                ->addColumn('action', function($user){
                                    $buttons = '';
                                    $userid = $user->id;
                                    if($user->access == 1){
                                        //$buttons = '<button class="btn btn-sm btn-primary"> Pending </button>';
                                        $buttons = '<select class="btn btn-sm btn-primary useractions" name="action">';
                                        $buttons .= '<option value="" selected>'. 'choose action' . '</option>';
                                        $buttons .= '<option value="0'. '-' .$userid . ' ">Block user </option>';
                                        $buttons .= '<option value="3'. '-' .$userid . ' ">Delete user </option>';
                                        $buttons .= '<option value="4'. '-' .$userid. '">recent activites </option>';
                                        $buttons .= '</select>';

                                        $buttons .= '&nbsp;<a href="#" class="btn btn-xs btn-primary viewuser" data-edit-id="'.$user->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                                        // $buttons .= '&nbsp;<a href="#" class="btn btn-xs btn-danger deleteuser"  data-edit-id="'.$user->id.'" data-toggle="modal"><i class="fa fa-trash"></i></a>';
                                        }elseif($user->access == 0){
                                            $buttons = '<select class="btn btn-sm btn-primary useractions" name="action">';
                                            $buttons .= '<option value="" selected>'. 'choose action' . '</option>';
                                            $buttons .= '<option value="1'. '-' .$userid . ' ">Reactivate user </option>';
                                            $buttons .= '<option value="3'. '-' .$userid . ' ">Delete user </option>';
                                            $buttons .= '<option value="4'. '-' .$userid. '">recent activites </option>';
                                            $buttons .= '</select>';
    
                                            $buttons .= '&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-primary viewuser" data-edit-id="'.$user->id.'" data-toggle="modal"> <i class="fa fa-eye"></i></a>';
                                            // $buttons .= '&nbsp;<a href="#" class="btn btn-xs btn-danger deleteuser"  data-edit-id="'.$user->id.'" data-toggle="modal"><i class="fa fa-trash"></i></a>';
                                        }
                                    return $buttons;
                                })
                                ->make(true);
    }

    public function loanActions(Request $request, User $user)
    {
        $data = $request['data'];
        
        $newdata = explode('-',$data);


        $wallet_key = DB::table('take_loans')->where('loan_pid', $newdata[1])->value('wallet_key');
        $userdata= Wallet::where('wallet_key', $wallet_key)->first()->user;
        // $user->notify(new usersnotify($userdata));
        // dd('$user');

        if($newdata[0] == '1') {
            $updateloan = DB::table('take_loans')->where('loan_pid', $newdata[1])->update([
                'verified'=> 2,
            ]);
            $updatetransaction = DB::table('transactions')->where('trans_pid', $newdata[1])->update([
                'trans_status'=> '2',
            ]) ;

        }elseif($newdata[0] == '0') {
            //dd($newdata[0]);
            $loan = DB::table('take_loans')->where('loan_pid', $newdata[1])->update([
                'verified'=> 0,
            ]);
            $updatetransaction = DB::table('transactions')->where('trans_pid', $newdata[1])->update([
                'trans_status'=> '0',
            ]) ;
        }

        

        return response()->json(['success'=> 'success']);
    }

    public function useractions(Request $request)
    {
        $data = $request['data']; 
        $newdata = explode('-',$data);

        if($newdata[0] == '0') {
            $user = User::find($newdata[1]);
            $user->access = 0;
            $user->save();
           
        }elseif($newdata[0] == '3') {
            $user = User::find($newdata[1])->wallet;
            if($user->owing == 1){
                return response()->json(['msg'=> false]);
            }
            $user_trans = Transaction::where('wallet_key', $user->wallet_key)->delete();
            $user_bills = Bill_payment::where('wallet_key', $user->wallet_key)->delete();
            $user_loans = Take_loan::where('wallet_key', $user->wallet_key)->delete();
            $user_paylaons = Pay_loan_taken::where('wallet_key', $user->wallet_key)->delete();
            $user_mobiletopup = MobileTopup::where('wallet_key', $user->wallet_key)->delete();
            $deleteuser = User::where('id', $newdata[1])->delete();
            $deletewallet = Wallet::where('wallet_key', $user->wallet_key)->delete();
            
            
        }elseif($newdata[0] == '1') {
            $user = User::find($newdata[1]);
            $user->access = 1;
            $user->save();
        }

        return response()->json(['msg'=> true]);
    }

}
