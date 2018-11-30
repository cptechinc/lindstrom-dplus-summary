<?php use Dplus\Base\DplusDateTime; ?>
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
			<?php 
				$data = array();
				
				for ($i = 1; $i < $month; $i++) {
					$mm = $i < 10 ? "0$i" : $i;
					$day = "01";
					$yyyymmdd = $year.$mm.$day;
					$monthdata = array(
						'month' => DplusDateTime::format_date($yyyymmdd, 'Y-m-d'),
						'total' => get_bookingtotal_month($yyyymmdd),
						'line2' => 100000 * $i
					);
					$data[] = $monthdata;
				}
			?>
			Morris.Line({
				element: 'year-trend',
				data: <?= json_encode($data); ?>,
				xkey: 'month',
				dateFormat: function (d) {
					var ds = new Date(d);
					return moment(ds).format('MMMM YYYY');
				},
				ykeys: ['total', 'line2'],
				labels: ['Total Booked', 'Line 2'],
				xLabelFormat: function (x) { return  moment(x).format('MMM YYYY'); },
			});
		}
	</script>
</div>
