# dev_ranker

**Note:** This package aims to provide an analysis based on the number of open source projects an individual possess on Github. A comprehensive README is needed

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practices by being named the following.

```
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require Merkll/dev_ranker
```

## Usage

``` php
$dev_ranker = new DeveloperStatus("username);
echo $dev_ranker->getStatus();
```

## Testing

``` bash
$ composer test
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
