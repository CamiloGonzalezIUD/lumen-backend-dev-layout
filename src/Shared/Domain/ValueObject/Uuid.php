<?php

declare(strict_types=1);

namespace GS\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Stringable;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid implements Stringable
{

    public function __construct(protected string $value)
    {
        $this->ensureIsValidUuid($this->value);
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public static function random() : self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function value() : string
    {
        return $this->value;
    }

    public function equals(Uuid $other) :  bool
    {
        return $this->value() === $other->value();
    }

    private function ensureIsValidUuid(string $id) : void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.',
                    static::class,
                    $id));
        }
    }
}