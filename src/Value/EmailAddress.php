<?php

declare(strict_types=1);

namespace GSteel\Listless\Value;

use GSteel\Listless\Assert;
use GSteel\Listless\EmailAddress as EmailAddressContract;

use function strtolower;

/**
 * @psalm-immutable
 */
final class EmailAddress implements EmailAddressContract
{
    private string $email;
    private ?string $name;

    private function __construct(
        string $email,
        ?string $name
    ) {
        $this->email = $email;
        $this->name = $name;
    }

    public static function fromString(string $email, ?string $displayName = null): self
    {
        Assert::email($email, 'Invalid email address: "%s"');
        if ($displayName !== null) {
            Assert::notEmpty($displayName, 'Provide a non-empty value for the display name or null');
        }

        return new self(strtolower($email), $displayName);
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function displayName(): ?string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function isEqualTo(EmailAddressContract $other): bool
    {
        return $this->email === strtolower($other->toString());
    }
}
