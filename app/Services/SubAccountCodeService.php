<?php

namespace App\Services;

use App\Models\SaleTaxes\PurchaseTax;
use App\Models\SaleTaxes\Purchase;
use App\Models\SaleTaxes\SubAccount;
use Auth;

class SubAccountCodeService
{

    public function getSubAccNumber($nature_id)
    {
        // $company_id = Auth::user()->company_id;
        // $sub_company_id = Auth::user()->sub_comp_id;

        $sub_acc_code = SubAccount::where('nature_id',$nature_id)->orderBy('id', 'desc')->value('sub_accounts_code');
        return $sub_acc_code = $sub_acc_code ? $sub_acc_code + 1 : 1;
    }


}
