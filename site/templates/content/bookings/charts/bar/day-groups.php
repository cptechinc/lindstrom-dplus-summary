<?php
	use Dplus\Base\DplusDateTime;
	
	$salesgroups = $bookingsdisplay->get_salesgroups();
	$colors = array_rand(array_flip($config->allowedcolors), sizeof($salesgroups));

	$bardata['data'] = array(
		'today' => DplusDateTime::format_date($date, 'F dS Y')
	);
	$piedata = array();

	foreach ($salesgroups as $salesgroup) {
		$bardata['labels'][$salesgroup] = $config->booking_groups[$salesgroup];
		$bardata['data'][$salesgroup] = $bookingsdisplay->get_group_total_day($salesgroup, $date);

		$piedata[] = array(
			'label' => $config->booking_groups[$salesgroup],
			'value' => $bardata['data'][$salesgroup]
		);
	}
?>
<div>
	<h3 class="mt-4">Today</h3>
	<div id="sales-group-today-bar" class="form-group"></div>

	<div id="sales-group-today-pie" class="form-group"></div>
	<script>
		$(function() {
			var tab = $('#sales-group-today-bar').closest('.tab-pane');
			
			if (tab.length) {
				if (tab.hasClass('active')) {
					draw_daybargraph();
					draw_daypiegraph();
				}

				$('a[data-toggle="tab"][href="#'+tab.attr('id')+'"]').on('shown.bs.tab', function (e) {
					draw_daybargraph();
					draw_daypiegraph();
				})

				$('a[data-toggle="tab"][href!="#'+tab.attr('id')+'"]').on('hidden.bs.tab', function(e) {
					$('#sales-group-today-bar').empty();
					$('#sales-group-today-pie').empty();
				});
			} else {
				draw_daybargraph();
				draw_daypiegraph();
			}
		});

		function draw_daybargraph() {
			Morris.Bar({
				element: 'sales-group-today-bar',
				data: <?= json_encode(array($bardata['data'])); ?>,
				xkey: 'today',
				ykeys: <?= json_encode($salesgroups); ?>,
				labels: <?= json_encode(array_values($bardata['labels'])); ?>,
				barColors: <?= json_encode($colors); ?>
			});
		}

		function draw_daypiegraph() {
			Morris.Donut({
				element: 'sales-group-today-pie',
				data: <?= json_encode($piedata); ?>,
				colors: <?= json_encode($colors); ?>
			});
		}
	</script>
</div>
