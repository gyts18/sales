<?php


namespace App\Controller\Traits;

use App\Entity\BigCakeCustomer;
use App\Entity\Match;
use App\Factories\MessageFactory;
use App\Service\AdditionalTranslationService;
use App\Service\ConversationService;
use Doctrine\Common\Inflector\Inflector;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

trait RestControllerTrait
{

    /**
     * @param $content
     *
     * @return array|bool
     */
    public function getJsonDataArray($content)
    {
        if (isset($content) && $content !== '') {
            return json_decode($content, true);
        }

        return false;
    }

    private function createErrorMessage(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $errors[Inflector::tableize($violation->getPropertyPath())] = $violation->getMessage();
        }

        return ['errors' => $errors];
    }

    private function jsonResponse($data, int $status, $errors = null)
    {
        return new JsonResponse(
            [
                'data' => $data,
                'errors' => $errors,
            ], $status
        );
    }
}