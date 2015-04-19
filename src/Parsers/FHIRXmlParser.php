<?php namespace FHIR\Parser\Parsers;
use FHIR\Common\AbstractFHIRObject;
use FHIR\Resources\Search\FHIRSearchResult;

/**
 * Class FHIRXmlParser
 * @package FHIR\Parser\Parsers
 */
class FHIRXmlParser implements FHIRParserInterface
{
    /** @var \FHIRObjectClassPropertyMap */
    protected $objectClassPropertyMap;

    /**
     * Constructor
     *
     * @param \FHIRObjectClassPropertyMap $objectClassPropertyMap
     */
    public function __construct(\FHIRObjectClassPropertyMap $objectClassPropertyMap)
    {
        $this->objectClassPropertyMap = $objectClassPropertyMap;
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function parseResponse($data)
    {
        if (defined('LIBXML_PARSEHUGE'))
            $opts = LIBXML_PARSEHUGE | LIBXML_COMPACT;
        else
            $opts = LIBXML_COMPACT;

        $sxe = new \SimpleXMLElement($data, $opts);

        $rootName = $sxe->getName();
        if ('feed' === $rootName)
            return $this->parseFeedResponse($sxe);

        return $this->parseResource($sxe);
    }

    /**
     * @param \SimpleXMLElement|\stdClass|array $data
     * @return mixed
     */
    public function parseFeedResponse($data)
    {
        $object = new FHIRSearchResult();

        $this->populateObject($data, $object);

        return $object;
    }

    /**
     * @param \SimpleXMLElement $data
     * @return mixed
     */
    public function parseResource($data)
    {

    }

    /**
     * @param \SimpleXMLElement $objectData
     * @return \FHIR\Common\AbstractFHIRObject
     */
    public function createObject($objectData)
    {

    }

    /**
     * @param \SimpleXMLElement $objectData
     * @param AbstractFHIRObject $object
     */
    public function populateObject($objectData, AbstractFHIRObject $object)
    {
        $class = '\\'.get_class($object);
        $propertyMap = $this->objectClassPropertyMap[$class];

        foreach($propertyMap as $property=>$definition)
        {
            if (isset($objectData->$property))
            {
                if (count($definition) === 1)
                {

                }
            }
        }
    }
}