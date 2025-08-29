<?php

declare(strict_types=1);

namespace StephenIjeh\ProductNameValidation\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Catalog\Model\Product;

class ValidateProductData implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        /** @var Product $product */
        $product = $observer->getEvent()->getProduct();

        if (!$product instanceof Product) {
            return;
        }

        $this->validateName($product->getName());
        $this->validateSku($product->getSku());
    }

    private function validateName(?string $name): void
    {
        if (empty($name)) {
            return;
        }

        $invalidChars = $this->getInvalidCharacters(
            $name,
            '/^[a-zA-Z0-9\s\-\',\.:()\/]$/u'  // Updated pattern
        );

        if (!empty($invalidChars)) {
            throw new LocalizedException(__(
                'Product name contains invalid characters: %1. Allowed characters: letters (a-z, A-Z), numbers (0-9), spaces, and these symbols: - \' , . : ( ) /',
                implode(' ', array_unique($invalidChars))
            ));
        }
    }

    private function validateSku(?string $sku): void
    {
        if (empty($sku)) {
            return;
        }

        $invalidChars = $this->getInvalidCharacters(
            $sku,
            '/^[a-zA-Z0-9\-_]$/u'
        );

        if (!empty($invalidChars)) {
            throw new LocalizedException(__(
                'SKU contains invalid characters: %1. Only letters, numbers, hyphens (-), and underscores (_) are allowed.',
                implode(' ', array_unique($invalidChars))
            ));
        }
    }

    private function getInvalidCharacters(string $value, string $pattern): array
    {
        $invalidChars = [];
        $length = mb_strlen($value, 'UTF-8');

        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($value, $i, 1, 'UTF-8');
            if (!preg_match($pattern, $char)) {
                $invalidChars[] = $char === ' ' ? '[space]' : $char;
            }
        }

        return $invalidChars;
    }
}
