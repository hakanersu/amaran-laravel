AmaranJS Laravel 5 Package
==========================
[![Laravel](https://img.shields.io/badge/Laravel-5.0-orange.svg?style=flat-square)](http://laravel.com)
[![Source](http://img.shields.io/badge/source-hakanersu/amaranlaravel-blue.svg?style=flat-square)](https://github.com/hakanersu/amaran-laravel)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

[AmaranJS][1] L5 package is a Laravel wrapper for my jquery plugin [AmaranJS][1].You can create easy and stylish notifications with [AmaranJS][1]. 

Package Demo: http://ersu.me/laravel-amaranjs

Installation
------------
Begin by installing the package through Composer. The best way to do this is through your terminal via Composer itself:

```
composer require xuma/amaran
```

or you can add your composer.json require section:
```
"xuma/laravel-amaran": "~1.0@dev"
```
Don't forget to update `composer update`.

Once this operation is complete, simply add both the service provider and facade classes to your project's `config/app.php` file:

#### Service Provider
```
'Xuma\Amaran\AmaranServiceProvider'
```
#### Facade
```
'Amaran' => 'Xuma\Amaran\Facades\Amaran'
```

#### Installing AmaranJS jQuery Plugin

Before starting download and extract your [AmaranJS][1] files to public/ directory and add necessary plugin files to your view.You can find installation documentation of [AmaranJS][1] [here][1].

#### Adding Output View

Add required view after your jQuery and AmaranJS links.

```
@include('amaran::javascript')
```

Example:

```
<script src="//cdn.jsdelivr.net/jquery/2.1.3/jquery.js"></script>
<script src="js/jquery.amaran.js"></script>
@include('amaran::javascript')
```

Usage
-----

Usage is very simple.If you want to use default theme;

```
Amaran::content([
    'message'=>'Hello World!'
])->create();
```

#### Using AmaranJS Functions

You can use most [AmaranJS][1] functions as methods like :

```
Amaran::content([
    'message'=>'Hello World!'
])->position('top right')
  ->inEffect('slideRight')
  ->outEffect('slideBottom')
  ->sticky(true)
  ->create();
```

#### Binding Javascript Events to Element
You can define javascript events with `bind()` method
```
Amaran::content([
    'message'=>'Hello World!'
])->position('top right)
  ->bind('#start','click')
  ->create();
```

#### Using as Flash Message
Normally AmaranJS bind to current view but you can add ```->flash()``` method for bind to redirected view.

```
    Amaran::content([
        'message'=>'Hello World'
    ])->flash()
      ->create();
```

Theme Usage
-----

Theme usage is simple just set theme name and set content as theme template array.
```
Amaran::theme('awesome ok')
    ->content([
        'title'=>'My first funcy example!',
        'message'=>'1.4 GB',
        'info'=>'my_birthday.mp4',
        'icon'=>'fa fa-download'
    ])->create();
```    

> Little note if you want to use awesome theme you have to include [font awesome][2].

[1]: https://github.com/hakanersu/AmaranJS
[2]: http://fortawesome.github.io/Font-Awesome/icons/
