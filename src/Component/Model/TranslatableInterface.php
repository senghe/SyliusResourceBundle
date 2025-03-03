<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Component\Resource\Model;

use Doctrine\Common\Collections\Collection;

interface TranslatableInterface
{
    /**
     * @return Collection|TranslationInterface[]
     * @psalm-return Collection<array-key, TranslationInterface>
     */
    public function getTranslations(): Collection;

    public function getTranslation(?string $locale = null): TranslationInterface;

    public function hasTranslation(TranslationInterface $translation): bool;

    public function addTranslation(TranslationInterface $translation): void;

    public function removeTranslation(TranslationInterface $translation): void;

    public function setCurrentLocale(string $locale): void;

    public function setFallbackLocale(string $locale): void;
}
