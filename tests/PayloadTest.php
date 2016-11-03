<?php

namespace Pushok\Tests;

use Pushok\Payload;
use Pushok\Payload\Alert;

class PayloadTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAlert()
    {
        $alert = new Alert();
        $payload = Payload::create()->setAlert($alert);

        $this->assertSame($alert, $payload->getAlert());
    }

    public function testSetBadge()
    {
        $payload = Payload::create()->setBadge(3);

        $this->assertEquals(3, $payload->getBadge());
    }

    public function testSetSound()
    {
        $payload = Payload::create()->setSound('soundString');

        $this->assertEquals('soundString', $payload->getSound());
    }

    public function testSetCategory()
    {
        $payload = Payload::create()->setCategory('categoryString');

        $this->assertEquals('categoryString', $payload->getCategory());
    }

    public function testSetContentAvailability()
    {
        $payload = Payload::create()->setContentAvailable(true);

        $this->assertTrue($payload->isContentAvailable());
    }

    public function testSetCustomValue()
    {
        $payload = Payload::create()->setCustomValue('key', 'value');

        $this->assertEquals('value', $payload->getCustomValue('key'));
    }

    public function testConvertToJSon()
    {
        $payload = Payload::create()
            ->setBadge(1)
            ->setSound('sound')
            ->setCategory('category')
            ->setCustomValue('key', 'value');

        $this->assertJsonStringEqualsJsonString(
            '{"aps": {"badge": 1, "sound": "sound", "category": "category"}, "key": "value"}',
            $payload->toJson()
        );
    }
}