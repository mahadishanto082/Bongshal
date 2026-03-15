<?php

use App\Models\Category;
use App\Models\Setting;
use App\Models\Order;
use App\Models\UserPoint;

if (!function_exists('numberFormatBD')) {
    function numberFormatBD($number, $decimals=0) {
        if (is_string($number)) {
            $number = str_replace(',', '', $number);
        }
        $number = (float) $number;
        $number_str = (string) $number;

        if (strpos($number_str,'.')!==false) {
            $decimalNumbers = substr($number_str, strpos($number_str,'.') + 1);
            $decimalNumbers = str_pad(substr($decimalNumbers, 0, $decimals), $decimals, '0');
        } else {
            $decimalNumbers = str_repeat('0', $decimals);
        }

        $intNumber = (int) $number;
        $number_rev = strrev((string)$intNumber);
        $n = '';
        $stringlength = strlen($number_rev);
        for ($i = 0; $i < $stringlength; $i++) {
            if ($i%2==0 && $i!=$stringlength-1 && $i>1) {
                $n = $n.$number_rev[$i].',';
            } else {
                $n = $n.$number_rev[$i];
            }
        }
        $number = $n;
        $number = strrev($number);
        ($decimals!=0)? $number=$number.'.'.$decimalNumbers : $number ;
        return $number;
    }
}
if (!function_exists('discountCal')) {
    function discountCal($price, $type, $value) {
        if ($type == 'Taka') {
            return $price - $value;
        } else if ($type == 'Percentage') {
            return $price * ((100 - $value) / 100);
        }
        return 0;
    }
}

if (!function_exists('getDiscountAmount')) {
    function getDiscountAmount($price, $type, $value) {
        if ($type == 'Taka') {
            return $value;
        } else if ($type == 'Percentage') {
            $dAmount = $price * ((100 - $value) / 100);
            return $price - $dAmount;
        }
        return 0;
    }
}

if (!function_exists('getCategories')) {
    function getCategories($limit = 0) {
        $sql = Category::with('products')->where('status', 'Active')->orderBy('created_at', 'DESC');
        if ($limit > 0) {
            $categories = $sql->take($limit)->get();
        } else {
            $categories = $sql->get();
        }

        return $categories;
    }
}

if (!function_exists('getSetting')) {
    function getSetting() {
       return Setting::first();
    }
}

if (!function_exists('newOrderCount')) {
    function newOrderCount() {
       return Order::where('status', 'Pending')->get();
    }
}

if (!function_exists('withdrawRequest')) {
    function withdrawRequest() {
       return UserPoint::where('status', 'Pending')
           ->where('flag', 'Withdraw')->get();
    }
}
