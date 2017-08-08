<?php

namespace HTTPClient\Extensions;

use \CURLFile;
use \Logics\Foundation\HTTP\HTTPclient;

class ProxyHTTPclient extends HTTPclient
    {

	/**
	 * Construct HTTP client and set HTTP request parameters
	 *
	 * @param string $url     URL for HTTP request
	 * @param array  $request Associative array containing NVPs to be passed with HTTP request
	 * @param array  $headers Associative array containing NVPs to be passed as HTTP headers
	 * @param array  $config  Optional cURL configuration
	 *
	 * @return void
	 */

	public function __construct($url, array $request = array(), array $headers = array(), array $config = array())
	    {
		parent::__construct($url, $request, $headers, $config);

		$this->__wakeup();
	    } //end __construct()


	/**
	 * Wakeup magic method: recreates cURL handle on object unserialization
	 *
	 * @return void
	 */

	public function __wakeup()
	    {
		$this->ch = curl_init();

		foreach ($this->config as $option => $value)
		    {
			switch ($option)
			    {
				case "verbose":
					curl_setopt($this->ch, CURLOPT_VERBOSE, $value);
				    break;
				case "followlocation":
					curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, $value);
				    break;
				case "proxy":
					curl_setopt($this->ch, CURLOPT_PROXY, $value);
				    break;
				case "proxytype":
					curl_setopt($this->ch, CURLOPT_PROXYTYPE, $value);
				    break;
				case "useragent":
					curl_setopt($this->ch, CURLOPT_USERAGENT, $value);
				    break;
				case "maxredirects":
					curl_setopt($this->ch, CURLOPT_MAXREDIRS, $value);
				    break;
				case "timeout":
					curl_setopt($this->ch, CURLOPT_TIMEOUT, $value);
				    break;
				case "keepalive":
					curl_setopt($this->ch, CURLOPT_FORBID_REUSE, $value === false);
				    break;
				default:
				    break;
			    } //end switch

		    } //end foreach

	    } //end __wakeup()


    } //end class

?>
