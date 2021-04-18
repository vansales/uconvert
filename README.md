# vansales/uconvert
[![Build Status](https://travis-ci.org/vansales/uconvert.svg?branch=master)](https://travis-ci.org/vansales/uconvert)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

PHP Library :: Unit Conversions for product packing

## Requirement
- PHP 7.2+

## Composer
This package available on [Packagist](https://packagist.org/packages/vansales/uconvert), Install the latest version with composer 

```
composer require vansales/uconvert
```

## Usage

```php
$convert = new vansales\Uconvert;


// Initial set of Unit Conversion
$baseUnit = 'ชิ้น';

$convrtSet = array(
    'unit1' => 'แพ็ค',
    'unit2' => 'โหล',
    'unit3' => '',
    'conv1' => 6,
    'conv2' => 12,
    'conv3' => 0,
);

$convert->init($baseUnit, $convrtSet);


$convert->setQty(59);
$result = $convert->from_baseUnit();
print_r($result);


$convert->setQty(15);
$convert->setUnit('ลัง');
$result = $convert->to_baseUnit();
print_r($result);
```

## Contributing
Feel free to contribute on this project, We'll be happy to work with you.

## License
This bundle is under the MIT license. For the full copyright and license information please view the LICENSE file that was distributed with this source code.
