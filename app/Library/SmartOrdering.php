<?php
/**
 * Created by PhpStorm.
 * User: mnqf2zp
 * Date: 11/2/17
 * Time: 15:15
 */

namespace App\Library;


use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;

trait SmartOrdering
{
    public function moveToTail() {
        $repository = $this->createRepository();
        $orderIdCol = $this->orderIdColumn();
        $before = $repository->orderBy($orderIdCol, 'DESC')->first();
        if (null == $before) {
            $this->{$orderIdCol} = CoordinatesAllocator::firstId;
        } else {
            $this->{$orderIdCol}= CoordinatesAllocator::after($before->{$orderIdCol});
        }

        return $this;
    }

    /**
     * Return the ordering id column configuration for this model.
     *
     * @return string
     */
    abstract public function orderIdColumn(): string;

    abstract public function createRepository(): RepositoryInterface;
}