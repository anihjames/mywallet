<?php

namespace App\Interfaces;

interface Loaninterface
{
    public function create($attributes);
    public function rate($level);
    public function all();
    public function delete($id);
    public function outstandingloans($key);
    public function getloan($pid);
    
}