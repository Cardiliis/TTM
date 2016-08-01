<?php

namespace TeamTimeManager\Controllers\Consultation;

use Silex\ControllerProviderInterface;
use Silex\Application;

class Provider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $app['controller.consulter'] = function() use($app) {
            $controller = new Controller();
            $controller
                ->setRequest($app['request'])
                ->setTwig($app['twig']);

            return $controller;
        };

        $controllers = $app['controllers_factory'];

        $controllers
            ->match('/absences', 'controller.consulter:absencesAction')
            ->method('GET')
            ->bind('consulter_absences');

        return $controllers;
    }
}
