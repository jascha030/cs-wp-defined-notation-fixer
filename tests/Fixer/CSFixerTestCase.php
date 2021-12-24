<?php

namespace Jascha030\PhpCsFixer\WordPress\DefinedNotation\Test\Fixer;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

abstract class CSFixerTestCase extends TestCase
{
    private array $testFiles;

    protected function setUp(): void
    {
        $templateContents = $this->getTestFile('template')->getContents();
        $result           = file_put_contents($this->getTestFile('testfile')->getRealPath(), $templateContents);

        if ($result === false) {
            throw new \RuntimeException('Could not set testfile contents.');
        }

        parent::setUp();
    }

    protected function tearDown(): void
    {
        $result = file_put_contents($this->getTestFile('testfile')->getRealPath(), '<?php' . PHP_EOL);

        if ($result === false) {
            throw new \RuntimeException('Could not clear testfile contents.');
        }

        parent::tearDown();
    }

    public function getTestFile(string $name): SplFileInfo
    {
        if (! isset($this->testFiles)) {
            $this->loadTestFiles();
        }

        return $this->testFiles[$name];
    }

    private function loadTestFiles(): void
    {
        $files = (new Finder())
            ->in($this->getTestTemplateDir())
            ->files()
            ->name('*.php')
            ->getIterator();

        $fileArray = [];

        foreach ($files as $file) {
            $fileArray[$file->getBasename('.php')] = $file;
        }

        foreach ($this->getRequiredFileNames() as $fileName) {
            if (! isset($fileArray[$fileName])) {
                throw new \RuntimeException("Couldn't find phpunit testfile: \"{$fileName}\".");
            }
        }

        $this->testFiles = $fileArray;
    }

    abstract public function getRequiredFileNames(): array;

    abstract public function getTestTemplateDir(): string;
}