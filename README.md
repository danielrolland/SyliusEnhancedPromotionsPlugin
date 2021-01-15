[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/danielrolland/SyliusEnhancedPromotionsPlugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/danielrolland/SyliusEnhancedPromotionsPlugin/?branch=master)

# Sylius Enhanced Promotions Plugin

This plugin adds some promotion rules/actions which are not provided by Sylius out of the box. For now it only adds the following Promotion Rules :

- Promotion rule based on minimal quantity of a particular product

## Installation

```bash
composer require danielrolland/sylius-enhanced-promotions-plugin
```
## Configuration

Enable this plugin :

```php
<?php

# config/bundles.php

return [
    // ...
    DanielRolland\SyliusEnhancedPromotionsPlugin\DanielRollandSyliusEnhancedPromotionsPlugin::class => ['all' => true],
    // ...
];
```


[ico-version]: https://img.shields.io/packagist/v/danielrolland/sylius-enhanced-promotions-plugin.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/danielrolland/sylius-enhanced-promotions-plugin/master.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/danielrolland/sylius-enhanced-promotions-plugin.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/danielrolland/sylius-enhanced-promotions-plugin
[link-travis]: https://travis-ci.org/DanielRolland/SyliusEnhancedPromotionsPlugin
[link-scrutinizer]: https://scrutinizer-ci.com/g/DanielRolland/SyliusEnhancedPromotionsPlugin/code-structure
