<?php

namespace Sensiolabs\GotenbergBundle\Pdf;

use Sensiolabs\GotenbergBundle\Builder\HtmlPdfBuilder;
use Sensiolabs\GotenbergBundle\Builder\LibreOfficePdfBuilder;
use Sensiolabs\GotenbergBundle\Builder\MarkdownPdfBuilder;
use Sensiolabs\GotenbergBundle\Builder\UrlPdfBuilder;
use Sensiolabs\GotenbergBundle\Client\GotenbergClientInterface;
use Sensiolabs\GotenbergBundle\Formatter\AssetBaseDirFormatter;
use Twig\Environment;

final readonly class Gotenberg implements GotenbergInterface
{
    /**
     * @param array<string, mixed> $userConfigurations
     */
    public function __construct(
        private GotenbergClientInterface $gotenbergClient,
        private array $userConfigurations,
        private AssetBaseDirFormatter $asset,
        private ?Environment $twig = null,
    ) {
    }

    public function html(): HtmlPdfBuilder
    {
        return (new HtmlPdfBuilder($this->gotenbergClient, $this->asset, $this->twig))
            ->setConfigurations($this->userConfigurations)
        ;
    }

    public function url(): UrlPdfBuilder
    {
        return (new UrlPdfBuilder($this->gotenbergClient, $this->asset, $this->twig))
            ->setConfigurations($this->userConfigurations)
        ;
    }

    public function markdown(): MarkdownPdfBuilder
    {
        return (new MarkdownPdfBuilder($this->gotenbergClient, $this->asset, $this->twig))
            ->setConfigurations($this->userConfigurations)
        ;
    }

    public function office(): LibreOfficePdfBuilder
    {
        return (new LibreOfficePdfBuilder($this->gotenbergClient, $this->asset))
            ->setConfigurations($this->userConfigurations)
        ;
    }
}
