<?php
	use Dplus\Base\QueryBuilder;
	use Dplus\Base\Validator;
	use Dplus\ProcessWire\DplusWire;

	function get_bookingsalesgroups($debug = false) {
		$q = (new QueryBuilder())->table('bookingr');
		$q->field($q->expr('DISTINCT(salesgroup)'));
		$q->where('salesgroup', '!=', '');
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	
	function get_bookingsalesgroupbooking_day($salesgroup, $day, $debug = false) {
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
			return $sql->fetchColumn();
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
			return $sql->fetchColumn();
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
			return $sql->fetchColumn();
		}
	}
	
	function get_booking_month($date, $debug = false) {
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
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return $sql->fetchColumn();
		}
	}
