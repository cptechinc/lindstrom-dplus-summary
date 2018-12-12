<?php
	use Dplus\Base\DplusDateTime;

	$salesreps = $bookingsdisplay->get_salesreps($salesgroup);
	$colors = array_rand(array_flip($config->allowedcolors), sizeof($salesreps));

	$bardata['data'] = array(
		'today' => DplusDateTime::format_date($date, 'F dS Y')
	);
	$piedata = array();

	foreach ($salesreps as $salesrep) {
		$bardata['labels'][$salesrep] = $salesrep;
		$bardata['data'][$salesrep] = $bookingsdisplay->get_salesrep_total_day($salesgroup, $salesrep, $date);

		$piedata[] = array(
			'label' => $salesrep,
			'value' => $bardata['data'][$salesrep]
		);
	}
?>
<div>
	<h3 class="mt-4">Today</h3>
	<div id="sales-rep-today-bar" class="form-group"></div>

	<div id="sales-rep-today-pie" class="form-group"></div>
	<script>
		$(function() {
			if ($('#sales-rep-today-bar').hasParent('.tab-pane')) {
				var tab = $('#sales-rep-today-bar').closest('.tab-pane');

				if (tab.hasClass('active')) {
					draw_daybargraph();
					draw_daypiegraph();
				}

				$('a[data-toggle="tab"][href="#'+tab.attr('id')+'"]').on('shown.bs.tab', function (e) {
					draw_daybargraph();
					draw_daypiegraph();
				})

				$('a[data-toggle="tab"][href!="#'+tab.attr('id')+'"]').on('hidden.bs.tab', function(e) {
					$('#sales-rep-today-bar').empty();
					$('#sales-rep-today-pie').empty();
				});
			} else {
				draw_daybargraph();
				draw_daypiegraph();
			}
		});

		function draw_daybargraph() {
			Morris.Bar({
				element: 'sales-rep-today-bar',
				data: <?= json_encode(array($bardata['data'])); ?>,
				xkey: 'today',
				ykeys: <?= json_encode($salesreps); ?>,
				labels: <?= json_encode(array_values($bardata['labels'])); ?>,
				barColors: <?= json_encode($colors); ?>
			});
		}

		function draw_daypiegraph() {
			Morris.Donut({
				element: 'sales-rep-today-pie',
				data: <?= json_encode($piedata); ?>,
				colors: <?= json_encode($colors); ?>
			});
		}
	</script>
</div>
