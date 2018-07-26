<?php
declare(strict_types=1);

namespace edwrodrig\fasta_reader\exception;


use Exception;

class InvalidFastaSequenceDescriptionException extends Exception
{

    /**
     * InvalidFastaSequenceNameException constructor.
     * @param string $line
     */
    public function __construct(string $line)
    {
        parent::__construct($line);
    }
}