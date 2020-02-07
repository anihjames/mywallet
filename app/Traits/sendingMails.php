<?php

namespace App\Traits;


use Mail;
use App\Models\User;
trait sendingMails{
    
    //public $data;
    public function notifyadmin($newfirstname, $newlastname , $newemail, $admin)
    {
        $data['first_name'] = $newfirstname;
        $data['last_name'] = $newlastname;
        $data['email'] = $newemail;
        //dd($this->data, $admin);
   
        Mail::send(['emails.adminnotify'], $data, function($message) use($admin) {
            $message->to($admin, 'admin');
            $message->from('myWallet@gmail.com','myWallet');
        });
        return true;
    }
}
