<?php

use GSoares\Hydroponics\Application\Action\Crop\CreateCropAction;
use GSoares\Hydroponics\Application\Action\Crop\DeleteCropAction;
use GSoares\Hydroponics\Application\Action\Crop\GetCropAction;
use GSoares\Hydroponics\Application\Action\Crop\ListCropAction;
use GSoares\Hydroponics\Application\Action\Crop\UpdateCropAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\CreateGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\DeleteGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\GetGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\ListGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\UpdateGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Plant\CreatePlantAction;
use GSoares\Hydroponics\Application\Action\Plant\DeletePlantAction;
use GSoares\Hydroponics\Application\Action\Plant\GetPlantAction;
use GSoares\Hydroponics\Application\Action\Plant\ListPlantAction;
use GSoares\Hydroponics\Application\Action\Plant\UpdatePlantAction;
use GSoares\Hydroponics\Application\Action\System\CreateSystemAction;
use GSoares\Hydroponics\Application\Action\System\DeleteSystemAction;
use GSoares\Hydroponics\Application\Action\System\GetSystemAction;
use GSoares\Hydroponics\Application\Action\System\ListSystemAction;
use GSoares\Hydroponics\Application\Action\System\UpdateSystemAction;
use GSoares\Hydroponics\Application\Action\Tank\CreateTankAction;
use GSoares\Hydroponics\Application\Action\Tank\DeleteTankAction;
use GSoares\Hydroponics\Application\Action\Tank\GetTankAction;
use GSoares\Hydroponics\Application\Action\Tank\ListTankAction;
use GSoares\Hydroponics\Application\Action\Tank\UpdateTankAction;
use GSoares\Hydroponics\Application\Middleware\Greenhouse\GreenhouseMiddleware;
use GSoares\Hydroponics\Application\Middleware\System\SystemMiddleware;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */
$container = $app->getContainer();

$app->group(
    '/api',
    function () use ($app) {
        $app->group(
            '/greenhouses',
            function () use ($app) {
                $app->get('[/]', ListGreenhouseAction::class);
                $app->get('/{id}', GetGreenhouseAction::class);
                $app->post('[/]', CreateGreenhouseAction::class);
                $app->patch('/{id}', UpdateGreenhouseAction::class);
                $app->delete('/{id}', DeleteGreenhouseAction::class);
            }
        );
        $app->group(
            '/greenhouses/{greenhouseId}/systems',
            function () use ($app) {
                $app->get('[/]', ListSystemAction::class);
                $app->get('/{id}', GetSystemAction::class);
                $app->post('[/]', CreateSystemAction::class);
                $app->patch('/{id}', UpdateSystemAction::class);
                $app->delete('/{id}', DeleteSystemAction::class);
            }
        )->add(GreenhouseMiddleware::class);
        $app->group(
            '/greenhouses/{greenhouseId}/systems/{systemId}/crops',
            function () use ($app) {
                $app->get('[/]', ListCropAction::class);
                $app->get('/{id}', GetCropAction::class);
                $app->post('[/]', CreateCropAction::class);
                $app->patch('/{id}', UpdateCropAction::class);
                $app->delete('/{id}', DeleteCropAction::class);
            }
        )->add(GreenhouseMiddleware::class)
            ->add(SystemMiddleware::class);
        $app->group(
            '/tanks',
            function () use ($app) {
                $app->get('[/]', ListTankAction::class);
                $app->get('/{id}', GetTankAction::class);
                $app->post('[/]', CreateTankAction::class);
                $app->patch('/{id}', UpdateTankAction::class);
                $app->delete('/{id}', DeleteTankAction::class);
            }
        );
        $app->group(
            '/plants',
            function () use ($app) {
                $app->get('[/]', ListPlantAction::class);
                $app->get('/{id}', GetPlantAction::class);
                $app->post('[/]', CreatePlantAction::class);
                $app->patch('/{id}', UpdatePlantAction::class);
                $app->delete('/{id}', DeletePlantAction::class);
            }
        );
    }
);
