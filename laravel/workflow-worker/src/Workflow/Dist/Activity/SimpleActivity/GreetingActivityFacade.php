<?php

declare(strict_types=1);

namespace Sample\Workflow\Dist\Activity\SimpleActivity;

use Lagdo\Facades\AbstractFacade;

/**
 * @extends AbstractFacade<GreetingActivityInterface>
 */
class GreetingActivityFacade extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getServiceIdentifier(): string
    {
        return GreetingActivityInterface::class;
    }
}
