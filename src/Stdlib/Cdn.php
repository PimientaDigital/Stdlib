<?php

namespace Stdlib;

class Cdn
{
	protected $config;

	public function __construct(array $config)
	{
		$this->config = $config;
	}

	public function assetCss($file)
	{
		$cssUrl = $this->config['static']['urls']['css'];
		$url = sprintf("%s%s", $cssUrl, $file);
		return $url;

	}

}

