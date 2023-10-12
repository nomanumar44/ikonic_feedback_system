<?php

namespace App\Services;

use App\Models\SaleTaxes\UreaSaleTax;
use Auth;

class UreaSaleTaxService
{

    public function getUreaSaleTaxNumber()
    {
        $company_id = Auth::user()->company_id;
        $sub_company_id = Auth::user()->sub_comp_id;

        $sale_no = UreaSaleTax::where('company_id',$company_id)->where('sub_comp_id',$sub_company_id)->orderBy('id', 'desc')->value('sale_tax_no');
        return $sale_no = $sale_no ? $sale_no + 1 : 1;
    }


}
