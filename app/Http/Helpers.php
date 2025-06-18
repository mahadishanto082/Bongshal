<?php

use App\Models\Category;
use App\Models\Setting;
use App\Models\Order;
use App\Models\UserPoint;

if (!function_exists('numberFormatBD')) {
    function numberFormatBD($number, $decimals=0) {
        if (strpos($number,'.')!=null) {
            $decimalNumbers = substr($number, strpos($number,'.'));
            $decimalNumbers = substr($decimalNumbers, 1, $decimals);
        } else {
            $decimalNumbers = 0;
            for ($i = 2; $i <=$decimals ; $i++) {
                $decimalNumbers = $decimalNumbers.'0';
            }
        }

        $number = (int) $number;
        $number = strrev($number);
        $n = '';
        $stringlength = strlen($number);
        for ($i = 0; $i < $stringlength; $i++) {
            if ($i%2==0 && $i!=$stringlength-1 && $i>1) {
                $n = $n.$number[$i].',';
            } else {
                $n = $n.$number[$i];
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
