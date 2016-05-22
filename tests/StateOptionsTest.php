<?php
use DigitalCanvas\Options\States;

class StateOptionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Clear the cache
     */
    public function setUp()
    {
        States::clearCache();
    }

    /**
     * Clear the cache
     */
    public function tearDown()
    {
        States::clearCache();
    }

    /**
     * Test loading US states pairs
     */
    public function testUsStatesPairs()
    {
        $states = States::getPairs(array('US'));
        // There should be 50 states + Washington DC
        $this->assertCount(51, $states);
        $this->assertArrayHasKey('CA', $states);
        $this->assertEquals('California', $states['CA']);
        $this->assertArrayNotHasKey('ON', $states);
    }

    /**
     * Test loading CA provinces as pairs
     */
    public function testCAProvincePairs()
    {
        $states = States::getPairs(array('CA'));
        $this->assertCount(12, $states);
        $this->assertArrayHasKey('ON', $states);
        $this->assertEquals('Ontario', $states['ON']);
        $this->assertArrayNotHasKey('CA', $states);
    }

    /**
     * Test loading US states as array
     */
    public function testUsStatesArray()
    {
        $states = States::getArray(array('US'));

        // There should be 50 states + Washington DC
        $this->assertCount(51, $states);
        $this->assertContains(array(
            'abbreviation' => 'CA',
            'name'         => 'California',
            'country'      => 'US',
            'countryname'  => 'United States'
        ), $states);
    }

    /**
     * Test loading CA provinces as array
     */
    public function testCAProvinceArray()
    {
        $states = States::getArray(array('CA'));

        $this->assertCount(12, $states);
        $this->assertContains(array(
            'abbreviation' => 'ON',
            'name'         => 'Ontario',
            'country'      => 'CA',
            'countryname'  => 'Canada'
        ), $states);
    }

    /**
     * Test returning single state details
     */
    public function testGetState()
    {
        $state = States::getState('CA', 'US', false);
        $this->assertContains('California', $state);
    }

    /**
     * Test getting full state name from abbreviation
     */
    public function testGetStateName()
    {
        $state = States::getState('CA', 'US', true);
        $this->assertEquals('California', $state);
    }

    /**
     * Test trying to load state that doesn't exist
     */
    public function testTryingToLoadInvalidState()
    {
        $state = States::getState('QQ', 'US', true);
        $this->assertFalse($state);
    }

    /**
     * Test returning states grouped by country
     */
    public function testMultiPairs()
    {
        $states = States::getMultiPairs(array('US', 'CA'));

        $this->assertArrayHasKey('United States', $states);
        $this->assertArrayHasKey('CA', $states['United States']);
        $this->assertArrayHasKey('Canada', $states);
        $this->assertArrayHasKey('ON', $states['Canada']);
    }

    /**
     * Test cache
     */
    public function testCache()
    {
        $this->assertFalse(States::isCached());
        States::getPairs();
        $this->assertTrue(States::isCached());
        States::clearCache();
        $this->assertFalse(States::isCached());
    }

    /**
     * @throws Exception
     */
    public function testLoadingCustomXml()
    {
        States::setXML(__DIR__ . '/_data/states.xml');
        $states = States::getPairs(array('US'));
        $this->assertCount(1, $states);
        $this->assertArrayHasKey('AL', $states);
        $this->assertContains('Alabama', $states);
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage States XML file does not exist.
     */
    public function testTryingToLoadInvalidXmlFile()
    {
        States::setXML(__DIR__ . '/_data/invalid.xml');
    }
}
