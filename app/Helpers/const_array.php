<?php

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\States;

function currency_array($currency = null)
{
    if ($currency == null) {
        return Currency::get();
    } else {
        return Currency::where('currency', '!=', $currency)->get();
    }
}

function country($input = null)
{
    if (is_null($input)) {
        return Countries::all();
    } else {
        return Countries::where('code', $input)->get();
    }
}

function status($input = null)
{
    if (is_null($input)) {
        return States::all();
    } else {
        return States::where('country_id', $input)->where('Status', 1)->get();
    }
}


function cities($input = null)
{
    if (is_null($input)) {
        return Cities::all();
    } else {
        return Cities::where('state_id', $input)->where('Status', 1)->get();
    }
}
