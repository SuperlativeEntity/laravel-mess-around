<?php

namespace App\Http\Controllers;

use App\Repositories\ISmsRepository;

class LayoutController extends Controller
{
    private $smsRepository;

    public function __construct(ISmsRepository $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    public function getIndex()
    {
        return view('index')->with(['sms_credits' => $this->smsRepository->getCredits()]);
    }
}