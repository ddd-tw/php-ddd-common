<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

abstract class Specification
{
    protected $entity;

    /**
     * return a function including the condition for verifying properties
     * Example:
     *  abstract public function predicate(): callable {
            return function() {
     *          return !empty($this->someProp);
     *      }
     *  }
     *
     * @return callable
     */
    abstract public function predicate(): callable;

    public function isSatisfy(): bool {
        return $this->predicate()($this->entity);
    }
}