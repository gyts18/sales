<?php

namespace App\Controller;

use App\Controller\Traits\RestControllerTrait;
use App\Form\CoffeeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormController
 * @Route("/form")
 * @package App\Controller
 */
class FormController extends AbstractController
{
    use RestControllerTrait;

    /**
     * @Route("/coffee", name="coffee_form", methods={"GET"})
     */
    public function renderCoffeeForm()
    {
        $form = $this->createForm(CoffeeFormType::class);
        $html = $this->render('forms/coffeeForm.html.twig', [
            'form'=>$form->createView()
        ])->getContent();
        return $this->jsonResponse($html, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/coffee/new", name="parse_coffee_form", methods={"POST"})
     * @param Request $request
     */
    public function parseCoffeeForm(Request $request)
    {
        $form = $this->createForm(CoffeeFormType::class);
        $form->handleRequest($request);
    }
}
