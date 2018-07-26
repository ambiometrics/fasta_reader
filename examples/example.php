<?php

use edwrodrig\fasta_reader\FastaReader;
use edwrodrig\fasta_reader\SequenceReader;

include_once(__DIR__ . '/../vendor/autoload.php');

$reader = new FastaReader("sample.fasta");

/** @var $sequence SequenceReader */
foreach ( $reader as $sequence ) {
    echo $sequence->getDescription() , "\n";
    echo $sequence->getData() , "\n";
}

