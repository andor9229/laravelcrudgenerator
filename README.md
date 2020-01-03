# LaravelCrudGenerator

An easy way to use the [official Elastic Search client](https://github.com/elastic/elasticsearch-php) in your Laravel or Lumen applications.

[![Total Downloads](https://poser.pugx.org/andor9229/laravelcrudgenerator/downloads)](https://packagist.org/packages/andor9229/laravelcrudgenerator)
[![Latest Stable Version](https://poser.pugx.org/andor9229/laravelcrudgenerator/v/stable)](https://packagist.org/packages/andor9229/laravelcrudgenerator)
[![Latest Stable Version](https://poser.pugx.org/cviebrock/laravel-elasticsearch/v/unstable.png)](https://packagist.org/packages/cviebrock/laravel-elasticsearch)

* [Installation and Configuration](#installation-and-configuration)
* [Usage](#usage)

## Installation and Configuration

Install the current version of the `andor9229/laravelcrudgenerator` package via composer:

```sh
composer require andor9229/laravelcrudgenerator
```

### Laravel

The package's service provider will automatically register its service provider.

Publish the configuration file:

adding the following to your application's `config\app`

```sh
\Andor9229\LaravelCrudGenerator\LaravelCrudGeneratorServiceProvider::class,
```

and run `php artisan vendor:publish --provider="Cviebrock\LaravelElasticsearch\ServiceProvider"` in your terminal

## Usage

Run `php artisan make:crud ModelName`
