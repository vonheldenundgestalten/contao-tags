<?php

/**
 * Contao Open Source CMS - tags extension
 *
 * Copyright (c) 2009-2016 Helmut Schottmüller
 *
 * @license LGPL-3.0+
 */

namespace Contao;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

class ContentHeadlineTags extends \ContentHeadline
{
	/**
	 * Parse the template
	 * @return string
	 */
	public function generate()
	{
		$isFrontend = System::getContainer()->get('contao.routing.scope_matcher')->isFrontendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''));
		if ($isFrontend) {
            if ($this->tagsonly) {
                if (!strlen(\TagHelper::decode(\Input::get('tag')))) {
                    return;
                }
            }
        }

        return parent::generate();
	}
}
