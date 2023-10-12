<?php

namespace App\Services;

use App\Models\SaleTaxes\PurchaseTax;
use App\Models\SaleTaxes\Purchase;
use Auth;

class PurchaseTaxService
{

    public function getPurchaseTaxNumber()
    {
        $company_id = Auth::user()->company_id;
        $sub_company_id = Auth::user()->sub_comp_id;

        $sale_no = PurchaseTax::where('company_id',$company_id)->where('sub_comp_id',$sub_company_id)->orderBy('id', 'desc')->value('purchase_tax_no');
        return $sale_no = $sale_no ? $sale_no + 1 : 1;
    }
    public function getPurchaseNumber()
    {
        $company_id = Auth::user()->company_id;
        $sub_company_id = Auth::user()->sub_comp_id;

        $sale_no = Purchase::where('company_id',$company_id)->where('sub_comp_id',$sub_company_id)->orderBy('id', 'desc')->value('purchase_no');
        return $sale_no = $sale_no ? $sale_no + 1 : 1;
    }

}
