<?php
require __DIR__.'/vendor/autoload.php';

use Puzzle9\Kuaidi100\Express;

/*
把官方的 excel 表格转为 json
 */
// $path = __DIR__.'/数据.xlsx';
// $datas = Excel::toCollection(collect(), $path)->first()->splice(2);
// $infos = [];
// foreach ($datas as $info) {
//     $infos[$info[1]] = $info[0];
// }
// echo json_encode($infos);

/*
测试
 */
$info = new Express('key', 'customer', 'callbackurl');
// echo $info->autonumber(75149178280661);
// echo $info->synquery('zhongtong', 75149178280661);
// echo $info->subscribe('zhongtong', 75149178280661);

// print_r($info->kdbm('yuantong'));
// print_r($info->kdbm('圆通速递', false));
// print_r($info->kdbm('这是没得快递啊', false, '没有'));