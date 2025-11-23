<?php

declare(strict_types=1);

namespace Sample\Workflow\Dist\Workflow\SimpleBatch;

use Sample\Temporal\Attribute\WorkflowOptions;
use Temporal\Workflow\QueryMethod;
use Temporal\Workflow\ReturnType;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Generator;

#[WorkflowInterface]
#[WorkflowOptions(idInDiContainer: "simpleBatchWorkflowOptions")]
interface SimpleBatchWorkflowInterface
{
    /**
     * @param int $batchId
     *
     * @return Generator|string
     */
    #[WorkflowMethod(name: 'LD.SimpleBatch')]
    #[ReturnType("string")]
    public function start(int $batchId, int $minItemCount = 20, int $maxItemCount = 50): Generator|string;

    /**
     * @return array<array<string|bool>>
     */
    #[QueryMethod]
    public function getAvailableResults(): array;

    /**
     * @return array<int>
     */
    #[QueryMethod]
    public function getPendingTasks(): array;
}
