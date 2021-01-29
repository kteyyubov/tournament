<?php

declare(strict_types=1);

namespace App\Domain\Model;

trait EnumTrait
{
    public function toString(): string
    {
        return $this->__toString();
    }

    public static function fromString(string $string)
    {
        return new static($string);
    }
}