<?php

namespace App\Traits;


use Mail;
use App\User;
trait sendingMails{
    
    //public $data;
    public function notifyadmin($data)
    {
        //dd($data);
        $admin = User::where('role', 'admin')->first();
        $admin_email = $admin->email;
        //dd($admin_email);
        //$data = $loandetails;
   
        Mail::send('emails.loan_notify_admin', $data, function($message) use($admin_email) {
            $message->to($admin_email)
                    ->from('myWallet@gmail.com')
                        ->subject('Applied Loan Notification');
        });
        return true;
    }
}
