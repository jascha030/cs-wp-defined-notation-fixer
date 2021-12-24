<?php

namespace Jascha030\PhpCsFixer\WordPress\DefinedNotation\Fixer;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;

final class WordPressABSPATHCheckNotationFixer implements FixerInterface
{
    /**
     * @inheritDoc
     */
    public function isCandidate(Tokens $tokens): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isRisky(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function fix(\SplFileInfo $file, Tokens $tokens): void
    {
        // TODO: Implement fix() method.
    }

    /**
     * @inheritDoc
     */
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition('Alternative control syntax is only used, when wrapping blocks of inline HTML.', [
            new CodeSample('\<?php' . PHP_EOL . 'if (! defined(\'ABSPATH\')) die; // Bad'),
            new CodeSample('\<?php' . PHP_EOL . 'if (! defined(\'ABSPATH\')) { // Bad' . PHP_EOL . '  die();' . PHP_EOL . ' }'),
            new CodeSample('\<?php' . PHP_EOL . 'defined(\'ABSPATH\') || exit(\'Forbidden.\'); // Good'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "Jascha030/wordpress_abspath_check_notation_fixer";
    }

    /**
     * @inheritDoc
     */
    public function getPriority(): int
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function supports(\SplFileInfo $file): bool
    {
        return 'php' === $file->getExtension();
    }
}