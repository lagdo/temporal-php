# Temporal samples for Symfony and Laravel

This repo provides sample applications and Docker Compose config to easily get started with [Temporal durable workflows](https://temporal.io/) in PHP with and Symfony and Laravel.

## The applications

There are 4 applications in the `symfony` and `laravel` subdirs.
- An API to interact (start, query, signal) with the workflows: `workflow-api`.
- A first worker to execute Temporal workflow functions: `workflow-worker`.
- A second worker to execute Temporal activity functions: `activity-worker`.
- A `workflow-app` application which runs the API and a worker which executes both the workflow and activity functions in a single container.

The workers are powered by the [RoadRunner](https://roadrunner.dev/) application server.
The workflow workers and activity workers are configured to listen on two separate queues on the Temporal server.

The Symfony and Laravel `workflow-api` applicatiions can be started either with [Nginx Unit](https://unit.nginx.org/), [FrankenPHP](https://frankenphp.dev/), `Nginx+PHP-FPM` or [RoadRunner](https://roadrunner.dev/) (there is a container for each of these PHP app servers).

The workflow examples are taken from the [Temporal PHP SDK sampes](https://github.com/temporalio/samples-php), and modified to adapt to the Symfony applications.

## The containers



## Documentation for the Symfony apps

1. [The Symfony applications](https://github.com/feuzeu/temporal-symfony-samples/wiki/1.-The-Symfony-applications)
2. [How the Symfony integration works](https://github.com/feuzeu/temporal-symfony-samples/wiki/2.-How-the-Symfony-integration-works)
3. [Adding a new function](https://github.com/feuzeu/temporal-symfony-samples/wiki/3.-Adding-a-new-function)
4. [How it is implemented](https://github.com/feuzeu/temporal-symfony-samples/wiki/4.-How-it-is-implemented) (coming soon)

## Credits

Temporal PHP SDK samples
- https://github.com/temporalio/samples-php

Other Temporal Symfony packages
- https://github.com/highcoreorg/temporal-bundle
- https://github.com/VantaFinance/temporal-bundle
- https://github.com/buyanov/symfony-temporal-worker
