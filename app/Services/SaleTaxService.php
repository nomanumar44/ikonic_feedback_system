<?php

namespace App\Services;

use App\Models\SaleTaxes\SaleTax;
use App\Models\SaleTaxes\RetailSale;
use Auth;

class SaleTaxService
{

    public function getSaleTaxNumber()
    {
        $company_id = Auth::user()->company_id;
        $sub_company_id = Auth::user()->sub_comp_id;

        $sale_no = SaleTax::where('company_id',$company_id)->where('sub_comp_id',$sub_company_id)->orderBy('id', 'desc')->value('sale_tax_no');
        return $sale_no = $sale_no ? $sale_no + 1 : 1;
    }

    public function getSaleNumber()
    {
        $company_id = Auth::user()->company_id;
        $sub_company_id = Auth::user()->sub_comp_id;

        $sale_no = RetailSale::where('company_id',$company_id)->where('sub_comp_id',$sub_company_id)->orderBy('id', 'desc')->value('sale_no');
        return $sale_no = $sale_no ? $sale_no + 1 : 1;
    }

}
