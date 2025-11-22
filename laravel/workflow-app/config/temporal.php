<?php

use Temporal\Worker\WorkerFactoryInterface;

return [
    'runtime' => [
        'server' => [
            'endpoint' => env('TEMPORAL_SERVER_ENDPOINT', 'http://temporal.addr:7233'),
        ],
        'queue' => [
            'default' => env('TEMPORAL_TASK_QUEUE', WorkerFactoryInterface::DEFAULT_TASK_QUEUE),
        ],
        'otel' => [
            'service' => env('OTEL_SERVICE_NAME', 'temporal-all-in-one-app'),
            'collector' => env('OTEL_COLLECTOR_ENDPOINT', 'http://collector.addr:4317'),
        ],
    ],
    // The items to be registered.
    // namespace => directory
    'register' => [
        'workflows' => [
            'Sample\\Workflow\\Mono\\Workflow' => base_path('src/Workflow/Mono/Workflow'),
        ],
        'child_workflows' => [
            'Sample\\Workflow\\Mono\\ChildWorkflow' => base_path('src/Workflow/Mono/ChildWorkflow'),
        ],
        'activities' => [
            'Sample\\Workflow\\Mono\\Activity' => base_path('src/Workflow/Mono/Activity'),
        ],
    ],
];
