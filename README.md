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

## Workflows and activities registrations

The Symfony and Laravel applications automatically register Temporal workflows and activities.

In the Symfony applications, this is implemented using [compiler passes](https://symfony.com/doc/current/service_container/compiler_passes.html), located in the `src/Temporal/Compiler` dir in each project.
The workflow and activity classes are located in dedicated directories (`src/Workflow`), and tagged resp. with `'temporal.service.workflow'` and `'temporal.service.activity'`.
The feature is described in more details in the wiki. Follow the links below.

In the Laravel applications, the registrations are implemented with [service providers](https://laravel.com/docs/12.x/providers).
The workflow and activity directories and namespaces are listed in a dedicated config file (`config/temporal.php`).
The service providers list all the classes in those directories, and register them either as Temporal workflows or activities.

## Options and facades

By default, when using the [Temporal PHP SDK](https://docs.temporal.io/develop/php), the activity and child workflow classes are instantiated in the workflow classes, therefore their options are also defined in the workflow classes.
Similarily, the workflow options are defined in the workflow client code, using a stub.

A different approach is implemented in these Laravel and Symfony applications.
The options are defined in the service container, each associated with a unique key.
They can then be applied on workflows, child workflows and activities using a custom PHP attribute which receives the unique key as parameter.

The option attribute must be applied on the workflow, child workflow or activity interfaces in the applications making the remote calls.
A [facade](https://github.com/lagdo/facades) is then defined for each of those interfaces.
Note that there are separate facades packages for [Laravel](https://github.com/lagdo/laravel-facades) and [Symfony](https://github.com/lagdo/symfony-facades).

The Symfony compiler passes and the Laravel service providers also use the facades to identify the workflow, child workflow and activity interfaces that are used for remote calls, and thus need to be configured with their respective options.

> Note: while the child workflow and activity facades inherit from the base facade class, the workflow facade inherits from a custom facade class which provides additional functions to start a new workflow or get a running workflow.

## Documentation for the Symfony apps

1. [The Symfony applications](https://github.com/feuzeu/temporal-symfony-samples/wiki/1.-The-Symfony-applications)
2. [How the Symfony integration works](https://github.com/feuzeu/temporal-symfony-samples/wiki/2.-How-the-Symfony-integration-works)
3. [Adding a new function](https://github.com/feuzeu/temporal-symfony-samples/wiki/3.-Adding-a-new-function)
4. [How it is implemented](https://github.com/feuzeu/temporal-symfony-samples/wiki/4.-How-it-is-implemented)

## Credits

Temporal PHP SDK samples
- https://github.com/temporalio/samples-php
