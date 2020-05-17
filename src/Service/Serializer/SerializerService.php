<?php


namespace App\Service\Serializer;



use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SerializerService
 *
 * @package App\Service\Serializer
 * Serializer, to serialize objects to either XML or JSON
 */
class SerializerService
{
    private array $jsonEncoder = [];
    private array $xmlEncoder = [];
    private array $normalizers = [];

    public function __construct()
    {
        $this->jsonEncoder[] = new JsonEncoder();
        $this->xmlEncoder[] = new XmlEncoder();
        $this->normalizers[] = new ObjectNormalizer();
    }

    /**
     * @param       $entity
     *
     * @param array $excludeProperties
     *
     * @return array|bool|float|int|mixed|string
     * @throws ExceptionInterface
     */
    public function serializeWithRelationsToJson($entity, array $excludeProperties = [])
    {
        $serializer = new Serializer($this->normalizers, $this->jsonEncoder);

        $defaultExclusions = ['__initializer__', 'createdAt', 'updatedAt', '__cloner__', '__isInitialized__'];
        $exclusions = array_merge($defaultExclusions, $excludeProperties);

        return $serializer->serialize(
            $entity,
            'json',
            [
                'ignored_attributes' => $exclusions,
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                },
            ]
        );
    }

    /**
     * @param       $entity
     * @param array $excludeProperties
     *
     * @return string
     */
    public function serializeWithRelationsToXml($entity, array $excludeProperties = [])
    {
        $serializer = new Serializer($this->normalizers, $this->xmlEncoder);
        $defaultExclusions = ['__initializer__', 'createdAt', 'updatedAt', '__cloner__', '__isInitialized__'];
        $exclusions = array_merge($defaultExclusions, $excludeProperties);

        return $serializer->serialize(
            $entity,
            'xml',
            [
                'ignored_attributes' => $exclusions,
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                },
            ]
        );
    }
}