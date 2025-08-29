<?php

declare(strict_types=1);

namespace StephenIjeh\ProductNameValidation\Model;

use Magento\Catalog\Model\Product;
use Magento\Framework\Validator\AbstractValidator;

class ProductNameValidator extends AbstractValidator
{
    public function isValid($product)
    {
        if (!$product instanceof Product) {
            return true;
        }

        $name = (string)$product->getName();
        if ($name === '') {
            return true;
        }

        // Check each character individually
        $length = strlen($name);
        $invalidChars = [];

        for ($i = 0; $i < $length; $i++) {
            $char = $name[$i];
            if (!$this->isAllowedCharacter($char)) {
                $invalidChars[] = $char === ' ' ? '[space]' : $char;
            }
        }

        if (!empty($invalidChars)) {
            $this->_addMessages([
                __(
                    'Invalid characters found: %1. Only letters (a-z, A-Z), numbers (0-9), spaces, hyphens (-), apostrophes (\'), and commas (,) are allowed...',
                    implode(' ', array_unique($invalidChars))
                )
            ]);
            return false;
        }

        return true;
    }

    private function isAllowedCharacter(string $char): bool
    {
        $code = ord($char);
        return ($code >= 65 && $code <= 90) ||  // A-Z
            ($code >= 97 && $code <= 122) || // a-z
            ($code >= 48 && $code <= 57) ||  // 0-9
            $code === 32 ||                   // space
            $code === 45 ||                   // hyphen
            $code === 39 ||                   // apostrophe
            $code === 44;                     // comma
    }
}
