<?php
declare(strict_types=1);

namespace RevolutPHP;

final class ApiVersion
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function V1(): self
    {
        return new self('1.0');
    }

    public static function V2(): self
    {
        return new self('2.0');
    }
}