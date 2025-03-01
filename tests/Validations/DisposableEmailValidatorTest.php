<?php

namespace Citco\Tests\Validations;

use Citco\EmailAddress;
use Citco\EmailDataProvider;
use Citco\Validations\DisposableEmailValidator;
use PHPUnit\Framework\TestCase;

class DisposableEmailValidatorTest extends TestCase
{
    /**
     * @dataProvider disposableEmailsDataProvider
     */
    public function testIsEmailDisposable(string $emailAddress, bool $expectedResult): void
    {
        $disposableEmailValidation = new DisposableEmailValidator(
            new EmailAddress($emailAddress),
            new EmailDataProvider()
        );

        $this->assertSame($expectedResult, $disposableEmailValidation->getResultResponse());
    }

    public function disposableEmailsDataProvider(): array
    {
        return [
            ['dave@gmail.com', false],
            ['dave@yahoo.com', false],
            ['dave@something.com', false],
            ['dave@bestvpn.top', true],
            ['dave@bel.kr', true],
            ['dave@10minutemail.de', true]
        ];
    }
}
