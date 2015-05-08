<?php

namespace Stdlib\Tests;

use PHPUnit_Framework_TestCase;
use Stdlib\Cdn;

class CdnTest extends PHPUnit_Framework_TestCase
{

	protected $cdn;
	protected $config;

	public function setUp()
	{
		$this->config = array(
			'static' => array(
				'urls' => array(
					'images' => 'http://images.static.cdn.com',
					'css' => 'http://css.static.cdn.com',
					'js' => 'http://js.static.cdn.com'
				)
			)
		);

	}

    public function testCreateUrlStaticCss()
    {
		$this->cdn = new Cdn($this->config);
		$urlPath = $this->cdn->assetCss("/file.css");
		$urlStaticFile = 'http://css.static.cdn.com/file.css';

		$this->assertTrue($urlStaticFile == $urlPath);
    }

	public function testCreateUrlStaticJs()
	{
		$this->cdn = new Cdn($this->config);
		$urlPath = $this->cdn->assetJs("/file.js");
		$urlStaticFile = 'http://js.static.cdn.com/file.js';

		$this->assertTrue($urlStaticFile == $urlPath);
	}

	public function setDown()
	{
		$this->cdn = null;
		$this->config = null;
	}

}
