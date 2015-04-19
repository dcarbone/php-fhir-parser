<?php namespace FHIR\Parser\Parsers;
use FHIR\Common\AbstractFHIRObject;

/**
 * Interface FHIRParserInterface
 * @package FHIR\Parser\Parsers
 */
interface FHIRParserInterface
{
    /**
     * Constructor
     *
     * @param \FHIRObjectClassPropertyMap $objectClassPropertyMap
     */
    public function __construct(\FHIRObjectClassPropertyMap $objectClassPropertyMap);

    /**
     * @param string $data
     * @return mixed
     */
    public function parseResponse($data);

    /**
     * @param \SimpleXMLElement|array $data
     * @return mixed
     */
    public function parseFeedResponse($data);

    /**
     * @param \SimpleXMLElement|array $data
     * @return mixed
     */
    public function parseResource($data);

    /**
     * @param \SimpleXMLElement|array $objectData
     * @return \FHIR\Common\AbstractFHIRObject
     */
    public function createObject($objectData);

    /**
     * @param \SimpleXMLElement|array $objectData
     * @param AbstractFHIRObject $object
     */
    public function populateObject($objectData, AbstractFHIRObject $object);
}