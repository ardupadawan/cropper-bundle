<?php
/******************************************************************************
 * Copyright (c) 2017 Cropper. All rights reserved.                           *
 * Author      : Breith Barbot                                                *
 * Updated at  : 12/03/17 19:35                                               *
 * File name   : FormPass.php                                                 *
 * Description :                                                              *
 ******************************************************************************/

namespace Breithbarbot\CropperBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $template = "BreithbarbotCropperBundle:Form:fields.html.twig";
        $resources = $container->getParameter('twig.form.resources');

        // Check if the template is not already added via config
        if (!in_array($template, $resources)) {
            // If fields.html.twig template is found, insert BreithbarbotCropperBundle:Form:fields.html.twig template after
            // Else i place in first position
            if (false !== ($key = array_search('fields.html.twig', $resources))) {
                array_splice($resources, ++$key, 0, $template);
            } else {
                array_unshift($resources, $template);
            }

            $container->setParameter('twig.form.resources', $resources);
        }
    }
}