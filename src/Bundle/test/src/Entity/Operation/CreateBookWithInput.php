<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity\Operation;

use App\Dto\Book as BookInput;
use App\Entity\Book;
use Sylius\Component\Resource\Metadata\Create;

#[Create(resource: 'app.book', input: BookInput::class)]
final class CreateBookWithInput extends Book
{
}
