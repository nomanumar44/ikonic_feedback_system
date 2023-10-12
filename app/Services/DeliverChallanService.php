<?php

namespace App\Services;

use App\Models\SaleTaxes\DeliveryChallan;
use Auth;

class DeliverChallanService
{
    public function getDeliveryNo()
    {
        $company_id = Auth::user()->company_id;
        $sub_company_id = Auth::user()->sub_comp_id;

        $sale_no = DeliveryChallan::where('company_id',$company_id)->where('sub_comp_id',$sub_company_id)->orderBy('id', 'desc')->value('vr_no');
        return $sale_no = $sale_no ? $sale_no + 1 : 1;
    }

}
