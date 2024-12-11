<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected string|int $companyId;
    public function __construct(

    )
    {
        if (Auth::check()) {
            $this->companyId = request()->user()->id;
        }
    }
}
