# Product Name SKU Validator for Magento 2

![Magento 2](https://img.shields.io/badge/Magento-2.4%2B-brightgreen)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue)
![License](https://img.shields.io/badge/License-MIT-green)

A Magento 2 extension that automatically validates product names and SKUs to prevent special characters, ensuring data integrity and preventing integration issues.

## Features

- ✅ Prevents special characters in product names and SKUs
- ✅ Real-time validation during product saves
- ✅ Clear error messages with specific character identification
- ✅ Works with admin edits, imports, and API operations
- ✅ Zero configuration required
- ✅ No performance impact

## Supported Platforms

- Magento Open Source 2.4.4+
- Adobe Commerce 2.4.4+
- PHP 8.2, 8.3, 8.4

## Installation

```bash
composer require stephen_ijeh/product-name-validation
bin/magento setup:upgrade
bin/magento cache:clean
```

## Manual Installation

1.  Download the extension files
2.  Upload to app/code/StephenIjeh/ProductNameValidation/
3.  Run:

```bash
bin/magento setup:upgrade
bin/magento cache:clean
```

## Usage

#### Product Name Rules

Allowed Characters:

- Letters: A-Z, a-z
- Numbers: 0-9
- Spaces
- Symbols: - ' , . : ( ) /
- Trademarks: Use (C), (R), (TM) instead of special symbols

#### SKU Rules

Allowed Characters:

- Letters: A-Z, a-z
- Numbers: 0-9
- Hyphen: -
- Underscore: \_

#### Examples

| Field        | Valid Example                      | Invalid Example    |
| ------------ | ---------------------------------- | ------------------ |
| Product Name | Men's T-Shirt 2.0 (Summer Edition) | Product@Name#2024! |
| SKU          | TSHIRT-123_BLUE                    | SKU 123#ABC        |

#### Steps to Use

1. Navigate to **Catalog > Products** in Admin
2. Create new product or edit existing product
3. Enter product name and SKU following the rules
4. Click Save - validation occurs automatically
5. If invalid characters are found, you'll see a clear error message

## Troubleshooting

#### Common Error Messages

| Error                                       | Solution                    |
| ------------------------------------------- | --------------------------- |
| Product name contains invalid characters: @ | Remove @ symbol             |
| SKU contains invalid characters: space      | Replace spaces with - or \_ |
| Product name contains invalid characters: ® | Use (R) instead             |

![screenshot](https://github.com/Stephenice/Product_And_SKU_Validator/blob/main/Screenshot.jpg)
![screenshot](/Screenshot.jpg)