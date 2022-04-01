<?php

namespace Citco\Tests\Validations;

use Citco\EmailAddress;
use Citco\EmailDataProvider;
use Citco\Validations\FreeEmailServiceValidator;
use PHPUnit\Framework\TestCase;

class FreeEmailProviderValidatorTest extends TestCase
{
    /**
     * @dataProvider freeEmailsDataProvider
     */
    public function testIsEmailAProvider(string $emailAddress, bool $expectedResult): void
    {
        $freeEmailServiceValidator = new FreeEmailServiceValidator(
            new EmailAddress($emailAddress),
            new EmailDataProvider()
        );

        $this->assertSame($expectedResult, $freeEmailServiceValidator->getResultResponse());
    }

    public function freeEmailsDataProvider(): array
    {
        return [
            ['dave@gmail.com', true],
            ['dave@yahoo.com', true],
            ['dave@hotmail.com', true],
            ['dave@something.com', false],
            ['dave@anonfreeemailservice.com', false],
            ['dave@reddit.com', false],
        ];
    }
}
