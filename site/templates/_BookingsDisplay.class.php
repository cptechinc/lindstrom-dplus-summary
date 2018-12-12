<?php
	use Dplus\Base\DplusDateTime;
	use Purl\Url as Purl;

	class BookingsDisplay {
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

		/**
		 * Bookings Date to get Bookings Data for
		 * @var string
		 */
		protected $date;

		/**
		 * Constructor
		 * @param string $sessionID Session Identifier
		 * @param Purl   $pageurl   Current Page's URL
		 * @param string $date      Bookings Date
		 */
		public function __construct($sessionID, Purl $pageurl, $date) {
			$this->sessionID = $sessionID;
			$this->pageurl = new Purl($pageurl->getUrl());
			$this->date = !empty($date) ? date('Ymd', strtotime($date)) : date('Ymd');
		}

		/**
		 * Return the URL for the date form
		 * // NOTE removes date from query string
		 * @return string URL
		 */
		public function get_dateformURL() {
			$dateurl = new Purl($this->pageurl->getUrl());
			$dateurl->query->remove('date');
			return $dateurl->getUrl();
		}

		/**
		 * Return the URL for today's date
		 * @return string URL
		 */
		public function get_todayURL() {
			$dateurl = new Purl($this->pageurl->getUrl());
			$dateurl->query->set('date', date('m/d/Y'));
			return $dateurl->getUrl();
		}

		/**
		 * Returns the Month in php date ('n') format
		 * @return string Month
		 */
		public function get_monthfromdate() {
			return date('n', strtotime($this->date));
		}

		/**
		 * Returns the Year in php date ('Y') format
		 * @return string Year
		 */
		public function get_yearfromdate() {
			return date('Y', strtotime($this->date));
		}

		/**
		 * Is the Booking Date today?
		 * @return bool
		 */
		public function is_datetoday() {
			return date('Ymd', strtotime($this->date)) == date('Ymd');
		}

		/**
		 * Returns the Day's bookings total
		 * @param  string $date  Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug Run in debug? If so, return SQL Query
		 * @return float         Booking total for the day
		 */
		public function get_total_day($date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingtotal_day($date, $debug);
		}

		/**
		 * Returns the week's bookings total
		 * @param  string $date  Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug Run in debug? If so, return SQL Query
		 * @return float         Booking total for the week
		 */
		public function get_total_week($date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingtotal_week($date, $debug);
		}

		/**
		 * Returns the month's bookings total
		 * @param  string $date  Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug Run in debug? If so, return SQL Query
		 * @return float         Booking total for the month
		 */
		public function get_total_month($date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingtotal_month($date, $debug);
		}

		/**
		 * Returns the year's bookings total
		 * @param  string $date  Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug Run in debug? If so, return SQL Query
		 * @return float         Booking total for the year
		 */
		public function get_total_year($date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingtotal_year($date, $debug);
		}
	}

	class BookingsSalesGroupsDisplay extends BookingsDisplay {

		public function get_salesgroups($debug = false) {
			return get_bookingsalesgroups($debug);
		}

		/**
		 * Returns the Day's bookings total for sales group
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the day
		 */
		public function get_group_total_day($salesgroup, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesgroup_day($salesgroup, $date, $debug);
		}

		/**
		 * Returns the week's bookings total for sales group
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the week
		 */
		public function get_group_total_week($salesgroup, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesgroup_week($salesgroup, $date, $debug);
		}

		/**
		 * Returns the month's bookings total for sales group
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the month
		 */
		public function get_group_total_month($salesgroup, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesgroup_month($salesgroup, $date, $debug);
		}

		/**
		 * Returns the year's bookings total for sales group
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the year
		 */
		public function get_group_total_year($salesgroup, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesgroup_year($salesgroup, $date, $debug);
		}
	}

	class BookingsSalesRepsDisplay extends BookingsSalesGroupsDisplay {

		protected $salesgroup;

		public function set_salesgroup($salesgroup) {
			$this->salesgroup = $salesgroup;
		}

		public function get_salesreps($debug = false) {
			return get_bookingsalesreps($this->salesgroup, $debug);
		}

		/**
		 * Return the URL for today's date
		 * @return string URL
		 */
		public function get_grouptodayURL() {
			$dateurl = new Purl($this->pageurl->getUrl());
			$dateurl->query->set('salesgroup', $this->salesgroup);
			$dateurl->query->set('date', date('m/d/Y'));
			return $dateurl->getUrl();
		}

		/**
		 * Returns the Day's bookings total for sales rep
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $salesrep    Sales Rep ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the day
		 */
		public function get_salesrep_total_day($salesrep, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesrep_day($this->salesgroup, $salesrep, $date, $debug);
		}

		/**
		 * Returns the week's bookings total for sales rep
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $salesrep    Sales Rep ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the week
		 */
		public function get_salesrep_total_week($salesrep, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesrep_week($this->salesgroup, $salesrep, $date, $debug);
		}

		/**
		 * Returns the month's bookings total for sales rep
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $salesrep    Sales Rep ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the month
		 */
		public function get_salesrep_total_month($salesrep, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesrep_month($this->salesgroup, $salesrep, $date, $debug);
		}

		/**
		 * Returns the year's bookings total for sales rep
		 * @param  string $salesgroup  Sales Group ID
		 * @param  string $salesrep    Sales Rep ID
		 * @param  string $date        Date // NOTE Will use $this->date if blank
		 * @param  bool   $debug       Run in debug? If so, return SQL Query
		 * @return float               Booking total for the year
		 */
		public function get_salesrep_total_year($salesrep, $date = '', $debug = false) {
			$date = !empty($date) ? $date : $this->date;
			return get_bookingsalesrep_year($this->salesgroup, $salesrep, $date, $debug);
		}
	}
