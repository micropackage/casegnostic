# Casegnostic

[![BracketSpace Micropackage](https://img.shields.io/badge/BracketSpace-Micropackage-brightgreen)](https://bracketspace.com)
[![Latest Stable Version](https://poser.pugx.org/micropackage/casegnostic/v/stable)](https://packagist.org/packages/micropackage/casegnostic)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/micropackage/casegnostic.svg)](https://packagist.org/packages/micropackage/casegnostic)
[![Total Downloads](https://poser.pugx.org/micropackage/casegnostic/downloads)](https://packagist.org/packages/micropackage/casegnostic)
[![License](https://poser.pugx.org/micropackage/casegnostic/license)](https://packagist.org/packages/micropackage/casegnostic)

<p align="center">
    <img src="https://bracketspace.com/extras/micropackage/micropackage-small.png" alt="Micropackage logo"/>
</p>

## 🧬 About Casegnostic

Package that simplifies transition from one coding standard to other, namely from snake_case to camelCase or vice-versa.

When you're about to break compatibility by changing method name from something_important() to somethingImportant() you can simply attach the trait.

```php
use Micropackage\Casegnostic\Casegnostic;

class Example
{
	use Casegnostic;

	public function somethingImportant()
	{
		return true;
	}
}

$x = new Example();

// That works as expected:
$x->somethingImportant();

// But that works too! 🤯
$x->something_important();
```

## 💾 Installation

``` bash
composer require micropackage/casegnostic
```

## 🕹 Usage

Simply attach the trait to your class.

```php
use Micropackage\Casegnostic\Casegnostic;

class Example
{
	use Casegnostic;
}
```

## 📦 About the Micropackage project

Micropackages - as the name suggests - are micro packages with a tiny bit of reusable code, helpful particularly in WordPress development.

The aim is to have multiple packages which can be put together to create something bigger by defining only the structure.

Micropackages are maintained by [BracketSpace](https://bracketspace.com).

## 📖 Changelog

[See the changelog file](./CHANGELOG.md).

## 📃 License

GNU General Public License (GPL) v3.0. See the [LICENSE](./LICENSE) file for more information.
