<?php
	use Dplus\Base\QueryBuilder;
	use Dplus\Base\Validator;
	use Dplus\ProcessWire\DplusWire;

	function get_bookingsalesreps($salesgroup, $debug = false) {
		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('DISTINCT(salesrep)'));
		$q->where('salesgroup', $salesgroup);
		$q->order('salesrep asc');
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return $sql->fetchAll(PDO::FETCH_COLUMN);
		}
	}

	function get_bookingsalesrep_day($salesgroup, $salesrep, $day, $debug = false) {
		$validator = new Validator();
		$date = $validator->date_yyyymmdd($day) ? $day : date('Ymd', strtotime($day));
		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where('salesrep', $salesrep);
		$q->where('bookdate', $date);
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingsalesrep_week($salesgroup, $salesrep, $date, $debug = false) {
		$validator = new Validator();
		$week_end = $validator->date_yyyymmdd($date) ? $date : date('Ymd', strtotime($date));
		$week_start = date('Ymd', strtotime('monday this week', strtotime($week_end)));

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where('salesrep', $salesrep);
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval($week_start), intval($week_end)]));
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingsalesrep_month($salesgroup, $salesrep, $date, $debug = false) {
		$validator = new Validator();

		if ($validator->date_yyyymm($date)) {
			$yearmonth = $date;
		} elseif ($validator->date_mmyyyy($date)) {
			$yearmonth = substr($date, 2, 4) . substr($date, 0, 2);
		} else {
			$yearmonth = date('Ym', strtotime($date));
		}

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where('salesrep', $salesrep);
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval("{$yearmonth}01"), intval("{$yearmonth}31")]));
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingsalesrep_year($salesgroup, $salesrep, $date, $debug = false) {
		$validator = new Validator();
		$date = $validator->date_yyyymmdd($date) ? $date : date('Ymd', strtotime($date));
		$year = date('Y', strtotime($date));

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where('salesrep', $salesrep);
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval("{$year}0101"), $date]));
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingsalesgroups($debug = false) {
		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('DISTINCT(salesgroup)'));
		$q->where('salesgroup', '!=', '');
		$q->order('salesgroup asc');
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return $sql->fetchAll(PDO::FETCH_COLUMN);
		}
	}

	function get_bookingsalesgroup_day($salesgroup, $day, $debug = false) {
		$validator = new Validator();
		$date = $validator->date_yyyymmdd($day) ? $day : date('Ymd', strtotime($day));
		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where('bookdate', $date);
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingsalesgroup_week($salesgroup, $date, $debug = false) {
		$validator = new Validator();
		$week_end = $validator->date_yyyymmdd($date) ? $date : date('Ymd', strtotime($date));
		$week_start = date('Ymd', strtotime('monday this week', strtotime($week_end)));

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval($week_start), intval($week_end)]));
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingsalesgroup_month($salesgroup, $date, $debug = false) {
		$validator = new Validator();

		if ($validator->date_yyyymm($date)) {
			$yearmonth = $date;
		} elseif ($validator->date_mmyyyy($date)) {
			$yearmonth = substr($date, 2, 4) . substr($date, 0, 2);
		} else {
			$yearmonth = date('Ym', strtotime($date));
		}

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval("{$yearmonth}01"), intval("{$yearmonth}31")]));
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingsalesgroup_year($salesgroup, $date, $debug = false) {
		$validator = new Validator();
		$date = $validator->date_yyyymmdd($date) ? $date : date('Ymd', strtotime($date));
		$year = date('Y', strtotime($date));

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('salesgroup', $salesgroup);
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval("{$year}0101"), $date]));
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}


	function get_bookingtotal_day($day, $debug = false) {
		$validator = new Validator();
		$date = $validator->date_yyyymmdd($day) ? $day : date('Ymd', strtotime($day));
		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where('bookdate', $date);
		$q->where('salesgroup', '!=', '');
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingtotal_week($date, $debug = false) {
		$validator = new Validator();
		$week_end = $validator->date_yyyymmdd($date) ? $date : date('Ymd', strtotime($date));
		$week_start = date('Ymd', strtotime('monday this week', strtotime($week_end)));

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval($week_start), intval($week_end)]));
		$q->where('salesgroup', '!=', '');
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingtotal_month($date, $debug = false) {
		$validator = new Validator();

		if ($validator->date_yyyymm($date)) {
			$yearmonth = $date;
		} elseif ($validator->date_mmyyyy($date)) {
			$yearmonth = substr($date, 2, 4) . substr($date, 0, 2);
		} else {
			$yearmonth = date('Ym', strtotime($date));
		}

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval("{$yearmonth}01"), intval("{$yearmonth}31")]));
		$q->where('salesgroup', '!=', '');
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}

	function get_bookingtotal_year($date, $debug = false) {
		$validator = new Validator();
		$date = $validator->date_yyyymmdd($date) ? $date : date('Ymd', strtotime($date));
		$year = date('Y', strtotime($date));

		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('SUM(amount)'));
		$q->where($q->expr("bookdate BETWEEN [] and []", [intval("{$year}0101"), $date]));
		$q->where('salesgroup', '!=', '');
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return floatval($sql->fetchColumn());
		}
	}
