<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace eZ\Publish\Core\Event\ObjectState;

use eZ\Publish\API\Repository\Events\ObjectState\BeforeSetPriorityOfObjectStateEvent as BeforeSetPriorityOfObjectStateEventInterface;
use eZ\Publish\API\Repository\Values\ObjectState\ObjectState;
use Symfony\Contracts\EventDispatcher\Event;

final class BeforeSetPriorityOfObjectStateEvent extends Event implements BeforeSetPriorityOfObjectStateEventInterface
{
    /** @var \eZ\Publish\API\Repository\Values\ObjectState\ObjectState */
    private $objectState;

    private $priority;

    public function __construct(ObjectState $objectState, $priority)
    {
        $this->objectState = $objectState;
        $this->priority = $priority;
    }

    public function getObjectState(): ObjectState
    {
        return $this->objectState;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}