<?php

declare(strict_types=1);

namespace Respinar\ContaoSimplefaqBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\System;
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

        $objPage = $this->getPageModel();

        // Load translations from default.xlf
        $translator = System::getContainer()->get('translator');
        $faqPageName = $translator->trans('MSC.faqsimpletitle', [], 'contao_default');

        // Use the translated name or fallback to the page title
        $faqPageName = $objPage->title ?: ($faqPageName ?? 'FAQ');

        // Prepare the JSON-LD schema
        $schemaOrgData = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "name" => $faqPageName, // Localized FAQ page name
            "mainEntity" => $GLOBALS['FAQ_ITEMS'] ?? []
        ];

        // Clear global FAQ items after generating schema
        unset($GLOBALS['FAQ_ITEMS']);

        return $schemaOrgData;
    }
}
