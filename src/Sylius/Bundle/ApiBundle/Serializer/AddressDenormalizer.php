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

namespace Sylius\Bundle\ApiBundle\Serializer;

use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/** @experimental */
final class AddressDenormalizer implements ContextAwareDenormalizerInterface
{
    /** @var DenormalizerInterface */
    private $objectNormalizer;

    /** @var string */
    private $classType;

    /** @var string */
    private $interfaceType;

    public function __construct(
        DenormalizerInterface $objectNormalizer,
        string $classType,
        string $interfaceType
    ) {
        $this->objectNormalizer = $objectNormalizer;
        $this->classType = $classType;
        $this->interfaceType = $interfaceType;
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        return $this->objectNormalizer->denormalize(
            $data,
            $this->classType,
            $format,
            $context
        );
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === $this->interfaceType;
    }
}