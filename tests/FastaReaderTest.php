<?php
declare(strict_types=1);

namespace test\edwrodrig\fasta_reader;

use edwrodrig\fasta_reader\FastaReader;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class FastaReaderTest extends TestCase
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
     * @throws \edwrodrig\fasta_reader\exception\OpenFileException
     */
    public function testReadSimple() {
        $filename =  $this->root->url() . '/test';

        file_put_contents($filename, <<<EOF
>A1
gatcctccat
>A2
atacaacggt
>A3
atctccacct
EOF
        );

        $reader = new FastaReader($filename);

        $sequences = iterator_to_array($reader);
        $this->assertEquals(3, count($sequences));
        $this->assertEquals('A1', $sequences[0]->getDescription());
        $this->assertEquals('gatcctccat', $sequences[0]->getData());
        $this->assertEquals('A2', $sequences[1]->getDescription());
        $this->assertEquals('atacaacggt', $sequences[1]->getData());
        $this->assertEquals('A3', $sequences[2]->getDescription());
        $this->assertEquals('atctccacct', $sequences[2]->getData());

    }
}
