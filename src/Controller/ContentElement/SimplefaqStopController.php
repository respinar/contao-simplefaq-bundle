<?php

declare(strict_types=1);

namespace Respinar\ContaoSimplefaqBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'simplefaq', template:'simplefaq_stop')]
class SimplefaqStopController extends AbstractContentElementController
{

    public const TYPE = 'simplefaq_stop';

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {

        // Backend Preview
        if ($request->attributes->get('_scope') === 'backend') {
            return new Response('<div style="padding: 10px; background: #eee; border: 1px solid #ccc;">FAQ STOP</div>');
        }       

        // Convert to JSON and pass to the template
        $template->set('schemaOrgData', $this->getSchemaOrgData());
       

        return $template->getResponse();
    }

    // Define the schema.org data
    public function getSchemaOrgData(): array
    {
        // Prepare the JSON-LD schema
        $schemaOrgData = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $GLOBALS['FAQ_ITEMS'] ?? []
        ];

        // Clear global FAQ items after generating schema
        unset($GLOBALS['FAQ_ITEMS']);

        return $schemaOrgData;
    }
}
