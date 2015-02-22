<?php

namespace FinalHashLLC
{

	require 'vendor/autoload.php';

	/**
	 * Interface APImethods
	 * @package CryptoExpert
     */
	interface APIMethods
	{

		public function request($method,$id,$action,$query,$type='GET',$postData);

		// User Methods
		public function info();
		public function balances($id=null, $type='all');
		public function deposits($id=null, $limit=100);
		public function withdrawals($id=null, $limit=100);
		public function addresses($id=null);
		public function transfers($id=null, $type='both', $limit=100);
		public function orders($id=null, $type='both');
		public function triggers($id=null, $type='both');
		public function tradeHistory($limit=100, $start=0);
		public function validateTradeKey($tradeKey);


		// Market Methods
		public function markets($id);
		public function marketVolume($id);
		public function marketTicker($id);
		public function marketFees($id);
		public function marketTriggers($id);
		public function marketOrderbook($id, $limit=100, $type='both', $mine=false);
		public function marketTrades($id, $limit=100, $start=0);
		public function marketOHLC($id, $limit=100);


		// Currency Methods
		public function currencies($id=null);
		public function currencyMarkets($id=null);
		public function currencyStatus($id=null);

		// Order Methods
		public function createOrder($marketid, $ordertype, $quantity, $price);
		public function orderInfo($orderid);
		public function cancelOrder($orderid);

		/*
		// Trigger Methods
		public function createTrigger($marketid, $type, $quantity, $comparison, $price, $orderprice, $expires);
		public function getTrigger($id);
		public function deleteTrigger($id);

		// Converter Methods
		public function createQuote($tradekey, $fromCurrency, $toCurrency, $sendingAmount, $recievingAmount, $feePercent);
		public function quoteInfo($id);
		public function getQuoteAddress($id);*/

	}

	/**
	 * Class CryptsyAPIv2
	 * @package CryptoExpert
     */
	class CryptsyAPIv2 implements APIMethods
	{

		private $key;
		private $secret;
		private $base_url = 'https://api.cryptsy.com/api/v2/';

		function __construct($args)
		{
			$this->key = $args['key'];
			$this->secret = $args['secret'];
		}

		// User Methods
		public function info() {
			return $this->request('info');
		}

		public function balances($id=null, $type='all') {
			if($id == null) {
				return $this->request('balances');
			}
			else
			{
				return $this->request('balances', $id);
			}
		}

		public function deposits($id=null, $limit=100)
		{
			if($id == null) {
				return $this->request('deposits', null, null, array('limit' => $limit,));
			}
			else
			{
				return $this->request('deposits', $id, null, array('limit' => $limit,));
			}
		}

		public function withdrawals($id=null, $limit=100)
		{
			if($id == null) {
				return $this->request('withdrawals', null, null, array('limit' => $limit,));
			}
			else
			{
				return $this->request('withdrawals', $id, null, array('limit' => $limit,));
			}
		}

		public function addresses($id=null)
		{
			if($id == null) {
				return $this->request('addresses');
			}
			else
			{
				return $this->request('addresses', $id);
			}
		}

		public function transfers($id=null, $type='both', $limit=100)
		{
			if($id == null) {
				return $this->request('transfers', null, null, array('limit' => $limit, 'type' => $type));
			}
			else
			{
				return $this->request('transfers', $id, null, array('limit' => $limit, 'type' => $type));
			}
		}

		public function orders($id=null, $type='both')
		{
			if($id == null) {
				return $this->request('orders', null, null, array('type' => $type,));
			}
			else
			{
				return $this->request('orders', $id, null, array('type' => $type,));
			}
		}

		public function triggers($id=null, $type='both')
		{
			if($id == null) {
				return $this->request('triggers', null, null, array('type' => $type,));
			}
			else
			{
				return $this->request('triggers', $id, null, array('type' => $type,));
			}
		}

		public function tradeHistory($limit=100, $start=0)
		{
			return $this->request('tradehistory', null, null, array('limit' => $limit, 'start' => $start));
		}

		public function validateTradeKey($tradeKey)
		{
			return $this->request('validatetradekey', null, null, array('tradekey' => $tradeKey,));
		}

		// Market Methods
		public function markets($id)
		{
			if($id == null) {
				return $this->request('markets');
			}
			else
			{
				return $this->request('markets', $id);
			}
		}

		public function marketVolume($id)
		{
			if($id == null)
			{
				return $this->request('markets/volume');
			}
			else
			{
				return $this->request('markets/volume', $id);
			}
		}

		public function marketTicker($id)
		{
			if($id == null)
			{
				return $this->request('markets/ticker');
			}
			else
			{
				return $this->request('markets/ticker', $id);
			}
		}

		public function marketFees($id)
		{
			if($id == null)
			{
				return $this->request('markets/fees');
			}
			else
			{
				return $this->request('markets/fees', $id);
			}
		}

		public function marketTriggers($id)
		{
			if($id == null)
			{
				return $this->request('markets/triggers');
			}
			else
			{
				return $this->request('markets/triggers', $id);
			}
		}

		public function marketOrderbook($id, $limit=100, $type='both', $mine=false)
		{
			if($id == null) {
				return $this->request('markets/orderbook', null, null, array('type' => $type, 'limit' => $limit, 'mine' => $mine));
			}
			else
			{
				return $this->request('markets/orderbook', $id, null, array('type' => $type, 'limit' => $limit, 'mine' => $mine));
			}
		}

		public function marketTrades($id, $limit=100, $start=0)
		{
			if($id == null) {
				return $this->request('markets/tradehistory', null, null, array('limit' => $limit, 'start' => $start));
			}
			else
			{
				return $this->request('markets/tradehistory', $id, null, array('limit' => $limit, 'start' => $start));
			}
		}

		public function marketOHLC($id, $limit=100)
		{
			if($id == null) {
				return $this->request('markets/ohlc', null, null, array('limit' => $limit,));
			}
			else
			{
				return $this->request('markets/ohlc', $id, null, array('limit' => $limit,));
			}
		}

		// Currency Methods
		public function currencies($id=null)
		{
			if($id == null)
			{
				return $this->request('currencies');
			}
			else
			{
				return $this->request('currencies', $id);
			}
		}

		public function currencyMarkets($id=null)
		{
			if($id == null)
			{
				return $this->request('currencies/markets');
			}
			else
			{
				return $this->request('currencies/' . $id . '/markets');
			}
		}

		public function currencyStatus($id=null)
		{
			if($id == null)
			{
				return $this->request('currencies/status');
			}
			else
			{
				return $this->request('currencies/status', $id);
			}
		}

		// Order Methods
		public function createOrder($marketid, $ordertype, $quantity, $price)
		{
			$postData = array(
				'marketid' => $marketid,
				'ordertype' => $ordertype,
				'quantity' => $quantity,
				'price' => $price
			);
			return $this->request('order', null, null, $postData, 'POST', $postData);
			//return $this->request('order', null, null, null	, 'POST', $postData);
		}
		public function orderInfo($orderid)
		{
			if($orderid == null)
			{
				return $this->request('markets/triggers');
			}
			else
			{
				return $this->request('markets/triggers', $orderid);
			}
		}

		public function cancelOrder($orderid)
		{
			if($orderid == null)
			{
				return $this->request('markets/triggers');
			}
			else
			{
				return $this->request('markets/triggers', $orderid);
			}
		}

		public function request($method=null,$id=null,$action=null,$query = [], $type='GET', $postData=[])
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
				'Sign: ' . $this->sign_request($query),
				'Expect: '
			];

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, false	);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);

			if ($type != 'GET') {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			}
			$output = curl_exec($ch);
			curl_close ($ch);

			return json_decode($output, true);

		}

		/**
		 * @param $query	Query Parameters
		 * @return string	API Secret
         */
		private function sign_request($query)
		{
			return hash_hmac('sha512', $query, $this->secret);
		}

		/**
		 * @param $m
		 * @throws \Exception
         */
		public function except($m)
		{
			throw new \Exception($m);
		}

	}

}
