<?php

namespace TeamTimeManager\Controllers\Consultation;

use Spear\Silex\Application\Traits;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Spear\Silex\Provider\Traits\TwigAware;

class Controller
{
    use
        Traits\RequestAware,
        TwigAware,
        LoggerAwareTrait;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    public function absencesAction()
    {
        return $this->render('absences/consulter.twig', ['quoi' => 'tout']);
    }
}
