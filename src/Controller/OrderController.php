<?php

namespace App\Controller;

use App\Controller\Traits\ControllerTrait;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OrderController
 *
 * @Route("/orders")
 * @package App\Controller
 */
class OrderController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Route("/", name="orders")
     * @param OrderService $orderService
     *
     * @return Response
     */
    public function index(OrderService $orderService)
    {
        $orders = $orderService->getAll();
        $html = $this->render(
            'views/table.html.twig',
            [
                'orders' => $orders,
            ]
        )->getContent();

        return $this->jsonResponse($html, JsonResponse::HTTP_OK);
    }
}
