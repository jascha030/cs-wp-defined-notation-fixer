<?php

namespace Jascha030\PhpCsFixer\WordPress\DefinedNotation\Test\Fixer;

use Jascha030\PhpCsFixer\WordPress\DefinedNotation\Fixer\WordPressABSPATHCheckNotationFixer;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;

class WordPressABSPATHCheckNotationFixerTest extends CSFixerTestCase
{
    public function testConstruction(): FixerInterface
    {
        $fixer = new WordPressABSPATHCheckNotationFixer();

        self::assertInstanceOf(FixerInterface::class, $fixer);

        return $fixer;
    }

    /**
     * @depends testConstruction
     */
    public function testGetPriority(FixerInterface $fixer): void
    {
        self::assertIsInt($fixer->getPriority());
        self::assertEquals(0, $fixer->getPriority());
    }

    /**
     * @depends testConstruction
     */
    public function testGetName(FixerInterface $fixer): void
    {
        self::assertIsString($fixer->getName());
        self::assertEquals('Jascha030/wordpress_abspath_check_notation_fixer', $fixer->getName());
    }

    /**
     * @depends testConstruction
     */
    public function testIsCandidate(FixerInterface $fixer): void
    {
        $tokens = $this->getTemplateTokens();

        self::assertTrue($fixer->isCandidate($tokens));
    }

    /**
     * @depends testConstruction
     */
    public function testIsRisky(FixerInterface $fixer): void
    {
        self::assertIsBool($fixer->isRisky());
        self::assertFalse($fixer->isRisky());
    }

    /**
     * @depends testConstruction
     */
    public function testSupports(FixerInterface $fixer): void
    {
        self::assertTrue($fixer->supports($this->getTestFile('template')));
    }

    /**
     * @depends testConstruction
     */
    public function testGetDefinition(FixerInterface $fixer): void
    {
        $definition = $fixer->getDefinition();

        /** @noinspection UnnecessaryAssertionInspection */
        self::assertInstanceOf(FixerDefinitionInterface::class, $definition);
    }

    public function getTestTemplateDir(): string
    {
        return dirname(__DIR__) . '/Fixtures/template';
    }

    public function getRequiredFileNames(): array
    {
        return [
            'testfile',
            'template',
            'expected'
        ];
    }

    private function getTemplateTokens(): Tokens
    {
        $fileContents = file_get_contents($this->getTestFile('template')->getRealPath());

        return Tokens::fromCode($fileContents);
    }
}
