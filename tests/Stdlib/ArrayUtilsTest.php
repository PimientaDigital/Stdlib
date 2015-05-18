<?php

namespace Stdlib\Tests;

use Stdlib\ArrayUtils;

use PHPUnit_Framework_TestCase;

class ArrayUtilsTest extends PHPUnit_Framework_TestCase
{

	public function setUp()
	{
	}

    public function testArrayMerge()
    {
		$this->assertTrue(true);
    }

	public function testArrayKeysLowers()
	{
		$array = array('KEY1' => '1', 'Key2' => '2');
		$keysLowers = array('key1', 'key2');
		$response = ArrayUtils::keysLowers($array);

		$this->assertEquals($keysLowers, $response);

	}

}

