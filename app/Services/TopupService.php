<?php

namespace App\Services;

use App\Repositories\TopupsRepository;
use Illuminate\Http\Request;

class TopupService
{
    protected $topup;

    public function __construct(TopupsRepository $topups)
    {
        $this->topup = $topups;
    }

    public function wallettopup()
    {

    }

    public function mobiletopup()
    {

    }

    public function gettopup()
    {
        return $this->topup->getTopup();
    }
}


