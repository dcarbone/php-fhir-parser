<?php namespace FHIR\Parser;
use FHIR\ObjectMapper\FHIRObjectMapper;
use FHIR\Parser\Parsers\FHIRJsonParser;
use FHIR\Parser\Parsers\FHIRXmlParser;

/**
 * Class FHIRObjectParser
 * @package FHIR\Parser
 */
class FHIRObjectParser
{
    /** @var \FHIRObjectClassPropertyMap */
    protected $fhirObjectMap;

    /**
     * Constructor
     *
     * TODO: Parameterize these values
     * TODO: Make this not terrible
     *
     * @param string $fhirClassMapFile
     */
    public function __construct($fhirClassMapFile = null)
    {
        // Quick and dirty at the moment.

        if (null === $fhirClassMapFile)
            $fhirClassMapFile = __DIR__.'/../output/FHIRObjectClassPropertyMap.php';

        if (!file_exists($fhirClassMapFile))
        {
            $mapper = new FHIRObjectMapper(
                __DIR__.'/../vendor/php-fhir/elements/src/',
                __DIR__.'/../vendor/php-fhir/resources/src/',
                __DIR__.'/../output/');

            if (!$mapper->generatePropertyMapClass())
                throw new \RuntimeException('Unable to generate class map file');
        }

        require_once $fhirClassMapFile;

        $this->fhirObjectMap = new \FHIRObjectClassPropertyMap;
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function parseResponse($data)
    {
        $firstChar = $data[0];
        if ('<' === $firstChar)
            $parser = new FHIRXmlParser($this->fhirObjectMap);
        else if ('{' === $firstChar || '[' === $firstChar)
            $parser = new FHIRJsonParser();
        else
            throw new \RuntimeException('Could not determine response type');

        return $parser->parseResponse($data);
    }
}