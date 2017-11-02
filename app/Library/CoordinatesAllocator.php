<?php
/**
 * Created by PhpStorm.
 * User: mnqf2zp
 * Date: 10/30/17
 * Time: 21:34
 */

namespace App\Library;


class CoordinatesAllocator
{
    const firstId = 1000000;
    protected $first;
    protected $second;

    protected $firstValue;
    protected $firstTenPower;

    protected $secondValue;
    protected $secondTenPower;

    /**
     * CoordinatesAllocator constructor.
     * @param null $first
     * @param null $second
     */
    public function __construct($first = null, $second = null)
    {
        $this->first = $first;
        $this->second = $second;
    }

    public function calculate() : int
    {
        if ($this->first !== null) {
            $split = preg_split("/([1-9]+)/", $this->first);
            $this->firstTenPower = strlen(end($split));
            $this->firstValue = substr($this->first, 0, strlen($this->first) - $this->firstTenPower);
        }

        if ($this->second !== null) {
            $split = preg_split("/([1-9]+)/", $this->second);
            if ($split) {
                $this->secondTenPower = strlen(end($split));
            }
            $this->secondValue = substr($this->second, 0, strlen($this->second) - $this->secondTenPower);
        }

        if ($this->second === null) {
            //calculate next number
            return ($this->firstValue+1)*pow(10, $this->firstTenPower);
        }

        return static::firstId;
    }

    public static function after($before) : int
    {
        $allocator = new self($before);
        return $allocator->calculate();
    }
}