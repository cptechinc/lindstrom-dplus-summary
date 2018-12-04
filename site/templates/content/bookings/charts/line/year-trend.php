<?php
	use Dplus\Base\DplusDateTime;

	$linedata = array(
		'ykeys' => array('total'),
		'labels' => array('Total Booked'),
		'data' => array()
	);
	$salesgroups = get_bookingsalesgroups();

	foreach ($salesgroups as $salesgroup) {
		$linedata['ykeys'][] = $salesgroup;
		$linedata['labels'][] = $config->booking_groups[$salesgroup];
	}

	$colors = array_rand(array_flip($config->allowedcolors), sizeof($linedata['ykeys']));

	for ($i = 1; $i < $bookingsdisplay->get_monthfromdate(); $i++) {
		$mm = $i < 10 ? "0$i" : $i;
		$day = "01";
		$yyyymmdd = $bookingsdisplay->get_yearfromdate().$mm.$day;

		$monthdata = array(
			'month' => DplusDateTime::format_date($yyyymmdd, 'Y-m-d'),
			'total' => floatval(get_bookingtotal_month($yyyymmdd))
		);

		foreach ($salesgroups as $salesgroup) {
			$monthdata[$salesgroup] = floatval(get_bookingsalesgroup_month($salesgroup, $yyyymmdd));
		}

		$linedata['data'][] = $monthdata;
	}
?>
<div>
	<h3 class="mt-4">This Year</h3>
	<div id="year-trend"></div>

	<script>
		$(function() {
			if ($('#year-trend').hasParent('.tab-pane')) {
				var tab = $('#year-trend').closest('.tab-pane');

				if (tab.hasClass('active')) {
					draw_yeargraph();
				}

				$('a[data-toggle="tab"][href="#'+tab.attr('id')+'"]').on('shown.bs.tab', function (e) {
					draw_yeargraph();
				})

				$('a[data-toggle="tab"][href!="#'+tab.attr('id')+'"]').on('hidden.bs.tab', function(e) {
					$('#year-trend').empty();
				});
			} else {
				draw_yeargraph();
			}
		});

		function draw_yeargraph() {
			Morris.Area({
				element: 'year-trend',
				data: <?= json_encode($linedata['data']); ?>,
				xkey: 'month',
				dateFormat: function (d) {
					var ds = new Date(d);
					return moment(ds).format('MMMM YYYY');
				},
				ykeys: <?= json_encode($linedata['ykeys']); ?>,
				labels: <?= json_encode($linedata['labels']); ?>,
				lineColors: <?= json_encode($colors); ?>,
				xLabelFormat: function (x) { return  moment(x).format('MMM YYYY'); },
				behaveLikeLine: true,
			});
		}
	</script>
</div>
