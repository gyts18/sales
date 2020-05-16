<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Products\Coffee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
	private Order $order;

	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	/**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
