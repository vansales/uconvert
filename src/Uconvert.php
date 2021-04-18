<?php

namespace vansales;

class Uconvert
{

    private $qty;
    private $baseUnit;
    private $currentUnit;

    private $unit1;
    private $unit2;
    private $unit3;

    private $conv1;
    private $conv2;
    private $conv3;


    /**
     * Initial UnitConversion
     *
     * จะต้อสใส่ข้อมูลใน Array ให้ถูกต้อง!!
     * 
     * $convrtSet = array(
     *      'unit1' => 'แพ็ค',
     *      'unit2' => 'โหล',
     *      'unit3' => 'ลัง',
     *      'conv1' => 6,
     *      'conv2' => 12,
     *      'conv3' => 60,
     * );
     * 
     * @param string        $baseUnit หน่วยพื้นฐาน
     * @param mixed|array   $conversion [string:unit1, string:unit2, string:unit3, int:conv1, int:conv2, int:conv3]
     */
    public function init($baseUnit, $conversion)
    {

        $this->baseUnit = $baseUnit;
        $this->unit1    = $conversion['unit1'];
        $this->unit2    = $conversion['unit2'];
        $this->unit3    = $conversion['unit3'];
        $this->conv1    = $conversion['conv1'];
        $this->conv2    = $conversion['conv2'];
        $this->conv3    = $conversion['conv3'];
    }

    public function setQty($qty = 0)
    {
        $this->qty = $qty;
    }

    public function setUnit($unit = '')
    {
        $this->currentUnit = $unit;
    }

    /**
     * แปลงจำนวน หน่วยอื่นๆ เป็นหน่วยพื้นฐาน baseUnit
     */
    public function to_baseUnit()
    {
        $_convertedQty = 0;

        switch ($this->currentUnit) {
            case $this->unit3:
                $_convertedQty = $this->qty * $this->conv3;
                break;

            case $this->unit2:
                $_convertedQty = $this->qty * $this->conv2;
                break;

            case $this->unit1:
                $_convertedQty = $this->qty * $this->conv1;
                break;

            default:
                $_convertedQty = $this->qty;
                break;
        }

        $result['qty'] = $_convertedQty;
        $result['baseUnit'] = $this->baseUnit;

        return $result;
    }


    /**
     * แปลงจำนวนในหน่วยพื้นฐาน (baseUnit) เป็นหน่วยแสดงผล หน่ยใหญ่/หน่วยเล็ก
     */
    public function from_baseUnit()
    {
        // gmp_div_qr — Divide numbers and get quotient and remainder
        // https://www.php.net/manual/en/function.gmp-div-qr.php

        if (!empty($this->unit3)) {

            $res = gmp_div_qr($this->qty, $this->conv3);
            $result['qty1'] = gmp_strval($res[0]);
            $result['qty2'] = gmp_strval($res[1]);

            $result['unit1'] = $this->unit3;
            $result['unit2'] = $this->baseUnit;
        } elseif (!empty($this->unit2)) {

            $res = gmp_div_qr($this->qty, $this->conv2);
            $result['qty1'] = gmp_strval($res[0]);
            $result['qty2'] = gmp_strval($res[1]);

            $result['unit1'] = $this->unit2;
            $result['unit2'] = $this->baseUnit;
        } elseif (!empty($this->unit1)) {

            $res = gmp_div_qr($this->qty, $this->conv1);
            $result['qty1'] = gmp_strval($res[0]);
            $result['qty2'] = gmp_strval($res[1]);

            $result['unit1'] = $this->unit1;
            $result['unit2'] = $this->baseUnit;
        } else {
            $result['qty1'] = $this->qty;
            $result['unit1'] = $this->baseUnit;
        }

        return $result;
    }
}
