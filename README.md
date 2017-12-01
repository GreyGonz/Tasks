# Tasks

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GreyGonz/Tasks/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GreyGonz/Tasks/?branch=master)
[![StyleCI](https://styleci.io/repos/107176545/shield?branch=master)](https://styleci.io/repos/107176545)


# Laravel packages

https://laravel.com/docs/5.5/packages

3 passos instal·lació paquet laravel:

1) Require
2) Install ServiceProvider
3) Install Facades (optional)

# FORMULARIS

https://laravelcollective.com/docs/5.0/html

# CRUD

https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers


## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require greygonz/threads
```

## Usage

``` php
$skeleton = new Greygonz\Threads();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email gerardrey@iesebre.com instead of using the issue tracker.

## Credits

- [greygonz][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/greygonz/threads.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/greygonz/threads/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/greygonz/threads.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/greygonz/threads.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/greygonz/threads.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/greygonz/threads
[link-travis]: https://travis-ci.org/greygonz/threads
[link-scrutinizer]: https://scrutinizer-ci.com/g/greygonz/threads/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/greygonz/threads
[link-downloads]: https://packagist.org/packages/greygonz/threads
[link-author]: https://github.com/GreyGonz
[link-contributors]: ../../contributors
