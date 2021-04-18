<?php
require_once './src/uconvert.php';

$convert = new vansales\Uconvert;


// Initial set of Unit Conversion
$baseUnit = 'ชิ้น';

$convrtSet = array(
    'unit1' => 'แพ็ค',
    'unit2' => 'โหล',
    'unit3' => '',
    'conv1' => 6,
    'conv2' => 12,
    'conv3' => 0,
);

$convert->init($baseUnit, $convrtSet);


$convert->setQty(59);
$result = $convert->from_baseUnit();
print_r($result);


$convert->setQty(15);
$convert->setUnit('ลัง');
$result = $convert->to_baseUnit();
print_r($result);


