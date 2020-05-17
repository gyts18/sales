<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @Route("/home")
 *
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render(
            'index/index.html.twig',
            [
                'controller_name' => 'IndexController',
            ]
        );
    }
}
