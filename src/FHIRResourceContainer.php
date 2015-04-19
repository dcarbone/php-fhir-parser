<?php namespace FHIR\Parser;

use FHIR\Resources\FHIRResource;

/**
 * Class FHIRResourceContainer
 * @package FHIR\Parser
 */
class FHIRResourceContainer
{
    /** @var array */
    private static $_fhirResources = array();

    /**
     * @param string $xmlId XML ID of Resource, e.g. "Observation/123"
     * @return \FHIR\Resources\FHIRResource
     */
    public static function getResourceByXmlId($xmlId)
    {
        if (isset(self::$_fhirResources[$xmlId]))
            return self::$_fhirResources[$xmlId];

        throw new \OutOfRangeException(sprintf(
            'No FHIR Resource with XML ID of "%s" found.',
            $xmlId
        ));
    }


    public function addResource(FHIRResource $resource)
    {

    }
}