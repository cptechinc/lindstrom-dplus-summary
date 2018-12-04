<?php 
	use Dplus\Base\DplusDateTime;
	use Purl\Url as Purl;
	
	class BookingsDayDisplay {
		use \Dplus\Base\ThrowErrorTrait;
		use \Dplus\Base\MagicMethodTraits;
		use \Dplus\Base\AttributeParser;
		
		/**
		 * Object that stores page location and where to load
		 * and search from
		 * @var Purl
		 */
		protected $pageurl;
		
		/**
		 * Session Identifier
		 * @var string
		 */
		protected $sessionID;
		
		protected $date;
		
		public function __construct($sessionID, Purl $pageurl, $date) {
			$this->sessionID = $sessionID;
			$this->pageurl = new Purl($pageurl->getUrl());
			$this->date = !empty($date) ? date('Ymd', strtotime($date)) : date('Ymd');
		}
		
		public function get_dateformURL() {
			$dateurl = new Purl($this->pageurl->getUrl());
			$dateurl->query->remove('date');
			return $dateurl->getUrl();
		}
		
		public function get_todayURL() {
			$dateurl = new Purl($this->pageurl->getUrl());
			$dateurl->query->set('date', date('m/d/Y'));
			return $dateurl->getUrl();
		}
		
		public function get_monthfromdate() {
			return date('n', strtotime($this->date));
		}
		
		public function get_yearfromdate() {
			return date('Y', strtotime($this->date));
		}
		
		public function is_datetoday() {
			return date('Ymd', strtotime($this->date)) == date('Ymd');
		}
	}
