<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Products\Coffee;
use App\Form\CoffeeFormType;
use App\Form\FlowerFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @Route("/home")
 * @package App\Controller
 */
class IndexController extends AbstractController
{
	private Order $order;

	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	/**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
