<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchBundle\EventListener;

use ONGR\ElasticsearchBundle\Service\IndexService;

class TerminateListener
{
    private $indexes;

    /**
     * @param IndexService[] $indexes
     */
    public function __construct(iterable $indexes)
    {
        $this->indexes = $indexes;
    }

    /**
     * Forces commit to the elasticsearch on kernel terminate event
     */
    public function onKernelTerminate()
    {
        foreach ($this->indexes as $index) {
            /** @var IndexService $index */
            $index->commit();
        }
    }
}
