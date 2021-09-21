<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NumberController extends Controller
{
    public function index() {
        return view('number');
    }

    public function number (Request $request) {
        App::setLocale($request->lang);
        return $this->numberToString($request->number);
    }

    public function numberToString($number, $gender='m') {
        switch($number){
            case 0: return __("numbers.0");
            case $number<20: return $this->lessNineteen($number, $gender);
            case $number<100: return $this->lessOneHundred($number, $gender);
            case $number<1000: return $this->lessOneThousand($number, $gender);
            case $number<1000000: return $this->lessMillion($number);
            case $number<1000000000: return $this->bigNumbers($number,1000000);
            case $number<1000000000000: return $this->bigNumbers($number, 1000000000);
            case $number<1000000000000000: return $this->bigNumbers($number, 1000000000000);
        }
    }

    public function lessNineteen($number, $gender='m') {
        if($gender=='w') return __("numbers.$number".'w');
        return __("numbers.$number");
    }

    public function lessOneHundred($number, $gender='m') {
        $ten = intdiv($number, 10);
        $digit = $number%10;
        if($digit==0) return __('numbers.'.$ten.'0');
        if(__('numbers.firstDigit')==='true') return $this->numberToString($digit, $gender).__('numbers.separatorTens').__('numbers.'.$ten.'0');
        return __('numbers.'.$ten.'0').__('numbers.separatorTens').$this->numberToString($digit, $gender);
    }

    public function lessOneThousand($number, $gender='m')
    {
        $hundred = intdiv($number, 100);
        $ten = $number%100;
        if($ten==0)
            return __('numbers.'.$hundred.'00');
        if($ten>19)
            return __('numbers.'.$hundred.'00').__('numbers.separatorHundreds').$this->lessOneHundred($ten, $gender);
        return __('numbers.'.$hundred.'00').__('numbers.separatorHundreds').$this->numberToString($ten, $gender);
    }

    public function lessMillion($number)
    {
        $hundreds = $number%1000;
        $thousands = intdiv($number, 1000);

        $digit = $this->lastDigit($thousands);
        $thousand = trans_choice('numbers.1000', $digit);

        if(strripos(__('numbers.w-gender'), $digit)!==false)
            return $this->numberToString($thousands, 'w').__('numbers.separatorHundreds').$thousand.__('numbers.separatorHundreds').$this->numberToString($hundreds);
        return $this->numberToString($thousands).__('numbers.separatorHundreds').$thousand.__('numbers.separatorHundreds').$this->numberToString($hundreds);
    }

    public function bigNumbers($number, $min)
    {
        $thousands = $number%$min;
        $millions = intdiv($number, $min);

        $digit = $this->lastDigit($millions);
        $million = trans_choice("numbers.$min", $digit);

        return $this->numberToString($millions).' '.$million.' '.$this->numberToString($thousands);
    }

    public function lastDigit($number) {
        $tens = $number%100;
        if($tens<20) {
            $digit = $tens;
        } else {
            $digit = $tens%10;
        }
        return $digit;
    }
}
