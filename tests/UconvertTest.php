<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Uconvert.php';

use PHPUnit\Framework\TestCase;


/**
 * @property vansales\Uconvert convert
 */
class UconvertTest extends TestCase
{

    private $uconvert;

    public function __construct()
    {
        parent::__construct();
        $this->uconvert = new vansales\Uconvert;

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

        $this->uconvert->init($baseUnit, $convrtSet);
    }


    public function test_toBaseUnit()
    {
        $this->uconvert->setQty(15);
        $this->uconvert->setUnit('แพ็ค');
        $result = $this->uconvert->to_baseUnit();

        $expected = array(
            'qty' => 90,
            'baseUnit' => 'ชิ้น'
        );
        $this->assertEquals($expected, $result);


        // ทดสอบ แปลงหน่วยที่ไม่ใน structure จะต้อง return ค่าเป็นหน่วยพื้นฐาน
        $this->uconvert->setQty(15);
        $this->uconvert->setUnit('ลัง');
        $result = $this->uconvert->to_baseUnit();

        $expected = array(
            'qty' => 15,
            'baseUnit' => 'ชิ้น'
        );
        $this->assertEquals($expected, $result);
    }

    public function test_fromBaseUnit()
    {
        $this->uconvert->setQty(59);
        $result = $this->uconvert->from_baseUnit();
        $expected = array(
            'qty1' => 4,
            'qty2' => 11,
            'unit1' => 'โหล',
            'unit2' => 'ชิ้น',
        );
        $this->assertEquals($expected, $result);
    }
}
