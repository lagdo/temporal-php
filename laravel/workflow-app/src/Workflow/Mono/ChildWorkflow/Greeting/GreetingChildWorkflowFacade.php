<?php

declare(strict_types=1);

namespace Sample\Workflow\Mono\ChildWorkflow\Greeting;

use Lagdo\Facades\AbstractFacade;

/**
 * @extends AbstractFacade<GreetingChildWorkflowInterface>
 */
class GreetingChildWorkflowFacade extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getServiceIdentifier(): string
    {
        return GreetingChildWorkflowInterface::class;
    }
}
