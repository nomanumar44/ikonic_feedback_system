<?php

namespace App\Services;

use App\Models\SaleTaxes\Income;
use App\Models\SaleTaxes\PurchaseTax;
use App\Models\SaleTaxes\Purchase;
use Auth;

class IncomeService
{

    public function getincmoeNumber()
    {
        $vr_no = Income::orderBy('id', 'desc')->value('voucher_no');
        return $vr_no = $vr_no ? $vr_no + 1 : 1;
    }


}
