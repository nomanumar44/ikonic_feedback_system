<?php

namespace App\Services;

use App\Models\SaleTaxes\UreaPurchaseTax;
use Auth;

class UreaPurchaseTaxService
{

    public function getUreaPurchaseTaxNumber()
    {
        $company_id = Auth::user()->company_id;
        $sub_company_id = Auth::user()->sub_comp_id;

        $sale_no = UreaPurchaseTax::where('company_id',$company_id)->where('sub_comp_id',$sub_company_id)->orderBy('id', 'desc')->value('urea_purchase_tax_no');
        return $sale_no = $sale_no ? $sale_no + 1 : 1;
    }
   

}
