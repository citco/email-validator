<?php

declare(strict_types=1);

namespace Citco;

use Citco\Validations\DisposableEmailValidator;
use Citco\Validations\EmailHostValidator;
use Citco\Validations\FreeEmailServiceValidator;
use Citco\Validations\MisspelledEmailValidator;
use Citco\Validations\MxRecordsValidator;
use Citco\Validations\RoleBasedEmailValidator;
use Citco\Validations\Validator;
use Citco\Validations\ValidFormatValidator;

class EmailValidatorFactory
{
    /** @var Validator[] */
    protected static array $defaultValidators = [
        ValidFormatValidator::class,
        MxRecordsValidator::class,
        MisspelledEmailValidator::class,
        FreeEmailServiceValidator::class,
        DisposableEmailValidator::class,
        RoleBasedEmailValidator::class,
        EmailHostValidator::class
    ];

    public static function create(string $emailAddress): EmailValidator
    {
        $emailAddress = new EmailAddress($emailAddress);
        $emailDataProvider = new EmailDataProvider();
        $emailValidationResults = new ValidationResults();
        $emailValidator = new EmailValidator($emailAddress, $emailValidationResults, $emailDataProvider);

        foreach (self::$defaultValidators as $validator) {
            $emailValidator->registerValidator(new $validator);
        }

        return $emailValidator;
    }
}
