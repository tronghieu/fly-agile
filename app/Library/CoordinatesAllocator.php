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
    protected $before;
    protected $after;

    /**
     * CoordinatesAllocator constructor.
     * @param $before
     * @param $after
     */
    public function __construct($before, $after)
    {
        $this->before = $before;
        $this->after = $after;
    }
}