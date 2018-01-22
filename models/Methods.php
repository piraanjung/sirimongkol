<?php

namespace app\models;

use Yii;
use yii\base\Model;
class Methods extends Model
{
    public function print_array($arr){
        echo  "<pre>";
        print_r($arr);
        die();
    }

    public function getMonthLists(){
        $months =[
            '01'=>'มกราคม',
            '02'=>'กุมภาพันธ์',
            '03'=>'มีนาคม',
            '04'=>'เมษายน',
            '05'=>'พฤษภาคม',
            '06'=>'มิถุนายน',
            '07'=>'กรกฎาคม',
            '08'=>'สิงหาคม',
            '09'=>'กันยายน',
            '10'=>'ตุลาคม',
            '11'=>'พฤศจิกายน',
            '12'=>'ธันวาคม',
        ];
        return $months;
    }
    public function getMonth($index){
        $months =[
            '01'=>'มกราคม',
            '02'=>'กุมภาพันธ์',
            '03'=>'มีนาคม',
            '04'=>'เมษายน',
            '05'=>'พฤษภาคม',
            '06'=>'มิถุนายน',
            '07'=>'กรกฎาคม',
            '08'=>'สิงหาคม',
            '09'=>'กันยายน',
            '10'=>'ตุลาคม',
            '11'=>'พฤศจิกายน',
            '12'=>'ธันวาคม',
        ];
        return $months[$index];
    }

}

?>