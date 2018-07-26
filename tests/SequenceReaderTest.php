<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: edwin
 * Date: 14-06-18
 * Time: 13:59
 */

namespace test\edwrodrig\fasta_reader;

use edwrodrig\fasta_reader\SequenceReader;
use edwrodrig\fasta_reader\StreamReader;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class SequenceReaderTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private $root;

    public function setUp() {
        $this->root = vfsStream::setup();
    }

    /**
     * @throws \edwrodrig\fasta_reader\exception\InvalidStreamException
     */
    public function testReadSimple() {
        $filename =  $this->root->url() . '/test';

        file_put_contents($filename, <<<EOF
>hola como te va
gatcctccat
atacaacggt
atctccacct

EOF
        );

        $f = fopen($filename, 'r');


        $reader = new StreamReader($f);
        $reader = new SequenceReader($reader);

        $this->assertEquals('hola como te va', $reader->getDescription());
        $this->assertEquals('gatcctccatatacaacggtatctccacct', $reader->getData());

    }

    /**
     * @throws \edwrodrig\fasta_reader\exception\InvalidStreamException
     */
    public function testReadTwoSequences() {
        $filename =  $this->root->url() . '/test';

        file_put_contents($filename, <<<EOF
>hola como te va
gatcctccat
atacaacggt
atctccacct
>second sequence
ACBDC
EOF
        );

        $f = fopen($filename, 'r');


        $stream = new StreamReader($f);
        $reader = new SequenceReader($stream);

        $this->assertEquals('hola como te va', $reader->getDescription());
        $this->assertEquals('gatcctccatatacaacggtatctccacct', $reader->getData());

        $reader = new SequenceReader($stream);

        $this->assertEquals('second sequence', $reader->getDescription());
        $this->assertEquals('ACBDC', $reader->getData());

    }

    /**
     * @expectedException  \edwrodrig\fasta_reader\exception\InvalidFastaSequenceDescriptionException
     * @expectedExceptionmessage gatcctccat
     * @throws \edwrodrig\fasta_reader\exception\InvalidStreamException
     */
    public function testReadWrongSequence() {
        $filename =  $this->root->url() . '/test';

        file_put_contents($filename, <<<EOF
gatcctccat
atacaacggt
atctccacct
EOF
        );

        $f = fopen($filename, 'r');


        $stream = new StreamReader($f);
        $reader = new SequenceReader($stream);

    }
}
