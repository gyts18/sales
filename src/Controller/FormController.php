<?php

namespace App\Controller;

use App\Controller\Traits\ControllerTrait;
use App\Entity\Order;
use App\Form\CoffeeFormType;
use App\Form\FlowerFormType;
use App\Service\CoffeeService;
use App\Service\FlowerService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormController
 * @Route("/form")
 *
 * @package App\Controller
 */
class FormController extends AbstractController
{
    use ControllerTrait;

    private const COFFEE_KEY = 'coffee';
    private const FLOWER_KEY = 'flowers';
    private const SEND_JSON = 'JSON';
    private const SEND_XML = 'XML';
    private Order $order;

    /**
     * FormController constructor.
     *
     * @param Order $order
     *
     * STRATEGY PATTERN
     * Initialize the order, so the strategies are stored inside.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @Route("/coffee", name="coffee_form", methods={"GET"})
     *
     * Basically I render the form into HTML and return it via json, so later
     * in the frontend it gets rendered, so it feels that the application is more
     * reactive with minimal effort.
     */
    public function renderCoffeeForm()
    {
        $form = $this->createForm(CoffeeFormType::class);
        $html = $this->render(
            'forms/coffeeForm.html.twig',
            [
                'form' => $form->createView(),
            ]
        )->getContent();

        return $this->jsonResponse($html, JsonResponse::HTTP_OK);
    }

    /**
     *
     * @Route("/flowers", name="flower_form", methods={"GET"})
     *
     * Basically I render the form into HTML and return it via json, so later
     * in the frontend it gets rendered, so it feels that the application is more
     * reactive with minimal effort.
     */
    public function renderFlowerForm()
    {
        $form = $this->createForm(FlowerFormType::class);
        $html = $this->render(
            'forms/flowersForm.html.twig',
            [
                'form' => $form->createView(),
            ]
        )->getContent();

        return $this->jsonResponse($html, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/coffee/new", name="parse_coffee_form", methods={"POST"})
     *
     * @param Request       $request
     * @param CoffeeService $coffeeService
     *
     * @return JsonResponse|Response
     *
     * Logic:
     * handle the form request -> check if valid -> check which button is clicked (json or xml)
     * -> call service to create the entity -> inside the service the entity gets created ->
     * the order strategy creates json or xml response which gets returned.
     * if any validation failures, you get redirected to the main page with the error message.
     *
     * @throws Exception
     */
    public function parseCoffeeForm(Request $request, CoffeeService $coffeeService)
    {
        $form = $this->createForm(CoffeeFormType::class);
        $form->handleRequest($request);

        /**
         * TODO: for future reference, because it's a custom form, isValid() doesn't validate correctly... Because the
         * form doesn't get mapped into a fully fledged entity.
         *
         * UPDATE: by a miracle it started working... oh well
         */
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->getClickedButton() && 'sendJSON' === $form->getClickedButton()->getName()) {
                $result = $coffeeService->createCoffeeAndDispatchOrder(
                    $this->order,
                    $form->getData(),
                    self::COFFEE_KEY,
                    self::SEND_JSON
                );

                return $this->jsonResponse($result, JsonResponse::HTTP_OK);
            } elseif ($form->getClickedButton() && 'sendXML' === $form->getClickedButton()->getName()) {
                $result = $coffeeService->createCoffeeAndDispatchOrder(
                    $this->order,
                    $form->getData(),
                    self::COFFEE_KEY,
                    self::SEND_XML
                );

                return $this->xmlResponse($result, 200);
            } else {
                return $this->jsonResponse(
                    null,
                    JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    ['error' => 'Unexpected error happened, probably you tried to break something']
                );
            }
        }

        return $this->render(
            'index/index.html.twig',
            [
                'error' => 'the form was not valid, please enter the data correctly',
            ]
        );
    }

    /**
     * @Route("/flowers/new", name="parse_flower_form", methods={"POST"})
     * @param Request       $request
     * @param FlowerService $flowerService
     *
     * @return JsonResponse|Response
     *
     * Logic:
     * handle the form request -> check if valid -> check which button is clicked (json or xml)
     * -> call service to create the entity -> inside the service the entity gets created ->
     * the order strategy creates json or xml response which gets returned.
     * if any validation failures, you get redirected to the main page with the error message.
     * @throws Exception
     */
    public function parseFlowerForm(Request $request, FlowerService $flowerService)
    {
        $form = $this->createForm(FlowerFormType::class);
        $form->handleRequest($request);

        /**
         * TODO: for future reference, because it's a custom form, isValid() doesn't validate correctly... Because the
         * form doesn't get mapped into a fully fledged entity...
         *
         * UPDATE: by a miracle it started working... oh well
         */
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->getClickedButton() && 'sendJSON' === $form->getClickedButton()->getName()) {
                $result = $flowerService->createFlowersAndDispatchOrder(
                    $this->order,
                    $form->getData(),
                    self::FLOWER_KEY,
                    self::SEND_JSON
                );

                return $this->jsonResponse($result, JsonResponse::HTTP_OK);
            } elseif ($form->getClickedButton() && 'sendXML' === $form->getClickedButton()->getName()) {
                $result = $flowerService->createFlowersAndDispatchOrder(
                    $this->order,
                    $form->getData(),
                    self::FLOWER_KEY,
                    self::SEND_XML
                );

                return $this->xmlResponse($result, 200);
            } else {
                return $this->jsonResponse(
                    null,
                    JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    ['error' => 'Unexpected error happened, probably you tried to break something']
                );
            }
        }

        return $this->render(
            'index/index.html.twig',
            [
                'error' => 'the form was not valid, please enter the data correctly',
            ]
        );
    }
}
