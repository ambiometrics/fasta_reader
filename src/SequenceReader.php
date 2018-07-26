<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: edwin
 * Date: 26-07-18
 * Time: 13:52
 */

namespace edwrodrig\fasta_reader;

class SequenceReader
{
    /**
     * @var StreamReader
     */
    private $stream;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $data = '';

    public function __construct(StreamReader $stream) {
        $this->stream = $stream;
        $this->parse();
    }


    /**
     * Get is a line is sequence name
     *
     * Lines that are sequence names starts with >
     * @param string $line
     * @return bool
     */
    static private function isLineDescription(string $line) : bool {
        return strpos($line, '>') === 0;
    }

    private function parse() {
        $line = $this->stream->readLine();

        if ( !self::isLineDescription($line) )
            throw new exception\InvalidFastaSequenceDescriptionException($line);

        $this->description = trim(substr($line, 1));

        while ( !$this->stream->atEnd() ) {
            $line = $this->stream->readLine();

            if ( self::isLineDescription($line) ) {
                $this->stream->rollBack();
                break;
            }

            $this->data .= trim($line);
        }
    }


    /**
     * Get the description of the sequence
     *
     * The content that is in the line with a > but without it
     * @return string
     */
    public function getDescription() : string {
        return $this->description;
    }

    /**
     * Get the data of the sequence
     *
     * The content associated to a line
     * @return string
     */
    public function getData() : string {
        return $this->data;
    }
}