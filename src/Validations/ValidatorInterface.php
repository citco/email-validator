<?php

declare(strict_types=1);

namespace Citco\Validations;

interface ValidatorInterface
{
    public function getResultResponse();

    public function getValidatorName(): string;
}
