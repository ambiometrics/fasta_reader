edwrodrig\fasta_reader
========
A php library to read FASTA files
This is under construction

[![Latest Stable Version](https://poser.pugx.org/edwrodrig/fasta_reader/v/stable)](https://packagist.org/packages/edwrodrig/fasta_reader)
[![Total Downloads](https://poser.pugx.org/edwrodrig/fasta_reader/downloads)](https://packagist.org/packages/edwrodrig/fasta_reader)
[![License](https://poser.pugx.org/edwrodrig/fasta_reader/license)](https://packagist.org/packages/edwrodrig/fasta_reader)
[![Build Status](https://travis-ci.org/edwrodrig/fasta_reader.svg?branch=master)](https://travis-ci.org/edwrodrig/fasta_reader)
[![codecov.io Code Coverage](https://codecov.io/gh/edwrodrig/fasta_reader/branch/master/graph/badge.svg)](https://codecov.io/github/edwrodrig/fasta_reader?branch=master)
[![Code Climate](https://codeclimate.com/github/edwrodrig/fasta_reader/badges/gpa.svg)](https://codeclimate.com/github/edwrodrig/fasta_reader)


## My use cases

My infrastructure is targeted to __Ubuntu 16.04__ machines with last __php7.2__ installed from [ppa:ondrej/php](https://launchpad.net/~ondrej/+archive/ubuntu/php).

## Documentation
The source code is documented using [phpDocumentor](http://docs.phpdoc.org/references/phpdoc/basic-syntax.html) style,
so it should pop up nicely if you're using IDEs like [PhpStorm](https://www.jetbrains.com/phpstorm) or similar.

### Examples
```
$reader = new FastaReader("sample.fasta");

foreach ( $reader as $sequence ) {
    echo $sequence->getDescription() , "\n";
    echo $sequence->getData() , "\n";
}
```

## Composer
```
composer require edwrodrig/fasta_reader
```

## Testing
The test are built using PhpUnit. It generates images and compare the signature with expected ones. Maybe some test fails due metadata of some generated images, but at the moment I haven't any reported issue.

## License
MIT license. Use it as you want at your own risk.

## About language
I'm not a native english writer, so there may be a lot of grammar and orthographical errors on text, I'm just trying my best. But feel free to correct my language, any contribution is welcome and for me they are a learning instance.

