<?php
declare(strict_types=1);

namespace edwrodrig\fasta_reader;

use IteratorAggregate;

/**
 * Class FastaReader
 *
 * This fasta reader class read a fasta filename.
 *
 * Use it in the following way
 * ´´´
 * $fasta = new FastaReader('filename.fasta');
 *
 * foreach ( $fasta as $sequence ) {
 *   $sequence->getName();
 *   $sequence->getData();
 * }
 * ´´´
 * @package edwrodrig\fasta_reader
 * @see https://en.wikipedia.org/wiki/FASTA_format
 */
class FastaReader implements IteratorAggregate {

    /**
     * @var StreamReader
     */
    private $stream;

    /**
     * @var bool|null|resource
     */
    private $handle = null;

    /**
     * FastaReader constructor.
     * @param string $filename
     * @throws exception\InvalidStreamException
     * @throws exception\OpenFileException
     */
    public function __construct(string $filename) {
        $this->handle = fopen($filename, 'r');
        if ( $this->handle === FALSE ) {
            throw new exception\OpenFileException($filename);
        }
        $this->stream = new StreamReader($this->handle);
    }

    /**
     * Closes the reader
     *
     * @internal
     * It closes the opened resources
     */
    public function __destruct()
    {
        if (is_resource($this->handle))
            fclose($this->handle);
    }

    public function getIterator() {
        while ( !$this->stream->atEnd() ) {
            yield new SequenceReader($this->stream);
        }
    }


}
