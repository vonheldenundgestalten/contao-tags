<?php

declare(strict_types=1);

namespace VHUG\ContaoTags\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use VHUG\ContaoTags\ContaoTagsBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoTagsBundle::class)
                ->setLoadAfter([
                    \Contao\CoreBundle\ContaoCoreBundle::class,
                    \Contao\NewsBundle\ContaoNewsBundle::class,
                    \Contao\CalendarBundle\ContaoCalendarBundle::class,
                    \Contao\FaqBundle\ContaoFaqBundle::class,
                ]),
        ];
    }
}
