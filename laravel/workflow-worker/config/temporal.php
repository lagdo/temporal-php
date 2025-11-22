<?php

use Temporal\Worker\WorkerFactoryInterface;

return [
    'runtime' => [
        'server' => [
            'endpoint' => env('TEMPORAL_SERVER_ENDPOINT', 'http://temporal.addr:7233'),
        ],
        'queue' => [
            'workflow' => env('WORKFLOW_TASK_QUEUE', WorkerFactoryInterface::DEFAULT_TASK_QUEUE),
            'activity' => env('ACTIVITY_TASK_QUEUE', WorkerFactoryInterface::DEFAULT_TASK_QUEUE),
        ],
        'otel' => [
            'service' => env('OTEL_SERVICE_NAME', 'temporal-workflow-worker'),
            'collector' => env('OTEL_COLLECTOR_ENDPOINT', 'http://collector.addr:4317'),
        ],
    ],
    // The items to be registered.
    // namespace => directory
    'register' => [
        'workflows' => [
            'Sample\\Workflow\\Dist\\Workflow' => base_path('src/Workflow/Dist/Workflow'),
        ],
        'child_workflows' => [
            'Sample\\Workflow\\Dist\\ChildWorkflow' => base_path('src/Workflow/Dist/ChildWorkflow'),
        ],
        'activities' => [
            'Sample\\Workflow\\Dist\\Activity' => base_path('src/Workflow/Dist/Activity'),
        ],
    ],
];
