<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

abstract class ValueObject
{
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