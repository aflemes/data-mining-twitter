<?php
	class Tweet
	{
		/**  Location for overloaded data.  */
		private $data = array();
	
		private $_tweetId;
		private $_tweetDate;
		private $_tweetText;
		private $_tweetUser;
		private $_tweetHashTag;
		
		public function __set($name, $value)
		{
			$this->data[$name] = $value;
		}

		public function __get($name)
		{
			if (array_key_exists($name, $this->data)) {
				return $this->data[$name];
			}
			return null;
		}
	}
?>