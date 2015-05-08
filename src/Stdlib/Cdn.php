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
		$urlPath = $this->config['static']['urls']['css'];
		$url = sprintf("%s%s", $urlPath, $file);
		return $url;

	}

	public function assetJs($file)
	{
		$urlPath = $this->config['static']['urls']['js'];
		$url = sprintf("%s%s", $urlPath, $file);
		return $url;

	}
}

