<?php

namespace CryptoExpert
{

	require 'vendor/autoload.php';

	interface APImethods
	{
		public function request($method,$id,$action,$query);
		public function allmarkets();
		public function market($id);
	}
	class CryptsyAPIv2 implements APImethods
	{

		private $key;
		private $secret;
		private $base_url = 'https://api.cryptsy.com/api/v2/';
		
		function __construct($args)
		{
			$this->key = $args['key'];
			$this->secret = $args['secret'];
		}
		
		//request utilities
		public function allmarkets()
		{
			return $this->request('markets');
		}
		
		public function market($id)
		{
			return $this->request('markets',$id);
		}
		
		public function request($method=null,$id=null,$action=null,$query = [])
		{
			$url = $this->base_url;

			if(!empty($method)){
				$url .= $method;
				if(!empty($id)){
					$url .= '/'.intval($id);
					if(!empty($action)){
						$url .= '/'.$action;
					}
				}
			}
			$query['nonce'] = microtime(true);
			$query = '?'.http_build_query($query);
			$url .= $query;

			$query = utf8_encode(explode("?", $query)[1]);

			$headers = [
				'Key: ' . utf8_encode($this->key),
				'Sign: ' . $this->sign_request($query)
			];

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			$output = curl_exec($ch);
			curl_close ($ch);

			echo print_r($output);
			return $output;

		}

		private function sign_request($query)
		{
			return hash_hmac('sha512', $query, $this->secret);
		}
		
		public function except($m)
		{
			throw new \Exception($m);
		}
		
	}
	
}
