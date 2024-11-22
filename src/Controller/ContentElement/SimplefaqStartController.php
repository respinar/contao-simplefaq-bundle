<?php

declare(strict_types=1);

namespace Respinar\ContaoSimplefaqBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'simplefaq')]
class SimplefaqStartController extends AbstractContentElementController
{

    public const TYPE = 'simplefaq_start';

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {  

        // Deserialize the headline field
        $headline = StringUtil::deserialize($model->headline, true);

        // Pass both the headline text and level (hl) to the template
        $template->set('headline', $headline['value'] ?? '');
        $template->set('hl', $headline['unit'] ?? 'h2'); // Default to <h2>

        // Backend Preview
        if ($request->attributes->get('_scope') === 'backend') {
            return new Response('<div style="padding: 10px; background: #eee; border: 1px solid #ccc;"><'.$headline['unit'].'>'.$headline['value'].'</'.$headline['unit'].'> FAQ START:</div>');
        }

        return $template->getResponse();
    }
}
