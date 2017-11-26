<?php
	require_once("../lib/firebaseLib.php");

	class firebaseTest
	{
		// --- set up your own database here
		const DEFAULT_URL = 'https://twitterdata-b072d.firebaseio.com/';
		const DEFAULT_TOKEN = 'GPqqTFPpI7dvxWeiM4Jp0unEsQyAwF5oDHQyizp0';
		
		/**  Location for overloaded data.  */
		private $_nodo = array();
		protected $_firebase;
				
		public function __set($name, $value)
		{
			$this->_nodo[$name] = $value;
		}

		public function __get($name)
		{
			if (array_key_exists($name, $this->_nodo)) {
				return $this->data[$name];
			}
			return null;
		}
		
		public function setUp()
		{
			$this->_firebase = new FirebaseLib(self::DEFAULT_URL, self::DEFAULT_TOKEN);
		}
		
		public function setTimeout($timeout)
		{
			$this->_firebase->setTimeout($timeout);
		}
				
		public function testNoBaseURI()
		{
			$errorMessage = null;
			try {
				new FirebaseLib();
			} catch (Exception $e) {
				$errorMessage = $e->getMessage();
			}
			$this->assertEquals(self::DEFAULT_URI_ERROR, $errorMessage);
		}
		
		public function setTweet($path)
		{
			$response = $this->_firebase->set($path,$this->_nodo["_nodo"]);
		}		
		
		public function setHashtag($path)
		{
			$response = $this->_firebase->set($path,$this->_nodo["_nodo"]);
		}

		public function getHashtag($path)
		{
			$response = $this->_firebase->get($path);
			
			return $response;
		}			
	}
?>