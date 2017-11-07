<?php
	require_once("../lib/firebaseLib.php");

	class firebaseTest
	{
		// --- set up your own database here
		const DEFAULT_URL = 'https://twitterdata-b072d.firebaseio.com/';
		const DEFAULT_TOKEN = 'GPqqTFPpI7dvxWeiM4Jp0unEsQyAwF5oDHQyizp0';
		
		protected $_firebase;
		protected $_todoMilk = array(
			'name' => 'Pick the milk',
			'priority' => 1
		);
		
		public function setUp()
		{
			$this->_firebase = new FirebaseLib(self::DEFAULT_URL, self::DEFAULT_TOKEN);
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
		public function testSet()
		{
			$response = $this->_firebase->set("tweet",$this->_todoMilk);
			
			echo $response;
		}
	}
?>