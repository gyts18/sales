<?php


namespace App\Service\Serializer;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function GuzzleHttp\Psr7\str;

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
    public function normalizeWithRelationsToJson($entity, array $excludeProperties = [])
    {
        $serializer = new Serializer($this->normalizers, $this->jsonEncoder);

        $defaultExclusions = ['__initializer__', 'createdAt', 'updatedAt', '__cloner__', '__isInitialized__'];
        $exclusions = array_merge($defaultExclusions, $excludeProperties);

        return $serializer->normalize(
            $entity,
            null,
            [
                'ignored_attributes' => $exclusions,
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                },
            ]
        );
    }
   public function normalizeWithRelationsToXml($entity, array $excludeProperties = [])
   {
       $serializer = new Serializer($this->normalizers, $this->xmlEncoder);

       $defaultExclusions = ['__initializer__', 'createdAt', 'updatedAt', '__cloner__', '__isInitialized__'];
       $exclusions = array_merge($defaultExclusions, $excludeProperties);

       return $serializer->normalize(
           $entity,
           null,
           [
               'ignored_attributes' => $exclusions,
               'circular_reference_handler' => function ($object) {
                   return $object->getId();
               },
           ]
       );
   }
}