<?php

declare(strict_types=1);

namespace Citco\Validations;

class ValidFormatValidator extends Validator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'valid_format'; // @codeCoverageIgnore
    }

    public function getResultResponse(): bool
    {
        return $this->getEmailAddress()->isValidEmailAddressFormat();
    }
}
