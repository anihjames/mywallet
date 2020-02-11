<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\MobileTopup;
use App\Models\Bill_payment;

class DatatablesController extends Controller
{
    public function getrecentTopups()
    {
        return Datatables::of(MobileTopup::query())->make(true);
    }
}
