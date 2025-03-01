<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple FAQ Bundle.
 *
 * (c) Hamid Peywasti 2025 <hamid@respinar.com>
 *
 * @license MIT
 */

namespace Respinar\ContaoSimplefaqBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouteCollection;
use Respinar\ContaoSimplefaqBundle\ContaoSimplefaqBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoSimplefaqBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
