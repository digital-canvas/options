<?php
use DigitalCanvas\Options\Countries;

class CountriesOptionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Clear the cache
     */
    public function setUp()
    {
        Countries::clearCache();
    }

    /**
     * Clear the cache
     */
    public function tearDown()
    {
        Countries::clearCache();
    }

    /**
     * Test loading pairs
     */
    public function testPairs()
    {
        $countries = Countries::getPairs();
        // There should be 50 states + Washington DC
        $this->assertInternalType('array', $countries);
        $this->assertArrayHasKey('US', $countries);
        $this->assertEquals('United States', $countries['US']);
    }

    /**
     * Test loading as array
     */
    public function testArray()
    {
        $countries = Countries::getArray();

        $this->assertInternalType('array', $countries);
        $this->assertContains(array(
            'name'         => 'United States',
            'code'      => 'US'
        ), $countries);
    }

    /**
     * Test returning single country details
     */
    public function testGetCountry()
    {
        $country = Countries::getCountry('US', false);
        $this->assertEquals(array(
            'name' => 'United States',
            'code' => 'US'
        ), $country);
    }

    /**
     * Test getting full country name from abbreviation
     */
    public function testGetStateName()
    {
        $country = Countries::getCountry('US', true);
        $this->assertEquals('United States', $country);
    }

    /**
     * Test trying to load country that doesn't exist
     */
    public function testTryingToLoadInvalidCountry()
    {
        $country = Countries::getCountry('17', true);
        $this->assertFalse($country);
    }

    /**
     * Test cache
     */
    public function testCache()
    {
        $this->assertFalse(Countries::isCached());
        Countries::getPairs();
        $this->assertTrue(Countries::isCached());
        Countries::clearCache();
        $this->assertFalse(Countries::isCached());
    }

    /**
     * @throws Exception
     */
    public function testLoadingCustomXml()
    {
        Countries::setXML(__DIR__ . '/_data/countries.xml');
        $countries = Countries::getPairs();
        $this->assertCount(1, $countries);
        $this->assertArrayHasKey('US', $countries);
        $this->assertContains('United States', $countries);
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Country XML file does not exist.
     */
    public function testTryingToLoadInvalidXmlFile()
    {
        Countries::setXML(__DIR__ . '/_data/invalid.xml');
    }
}
