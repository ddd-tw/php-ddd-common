<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

abstract class ValueObject
{
    /**
     * Flat your value object implementation into an array, then you can use equals method to compare two value objects
     *  Example:
     *     // abstract public function getEqualityComponents(): array { return [$this->name, $this->amount];}
     *
     *  $orderItem1 = new OrderItem('item_name', 100);
     *  $orderItem2 = new OrderItem('item_name', 100);
     *
     *  $orderItem1->equals($orderItem2); // return true
     *
     * @return array
     */
    abstract public function getEqualityComponents(): array;

    public function equals(?ValueObject $vo): bool
    {
        if ($vo === null) {
            return false;
        }

        $equalityComponents = $this->getEqualityComponents();
        foreach ($vo->getEqualityComponents() as $index => $value) {
                if ($equalityComponents[$index] !== $value) {
                    return false;
                }
        }

        return true;
    }
}