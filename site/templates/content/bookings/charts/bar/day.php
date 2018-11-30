<?php use Dplus\Base\DplusDateTime; ?>
<div>
    <h3 class="mt-4">Today</h3>
    <div id="sales-group-today"></div>
    
    <script>
		$(function() {
			if ($('#sales-group-today').hasParent('.tab-pane')) {	
				var tab = $('#sales-group-today').closest('.tab-pane');
				
				if (tab.hasClass('active')) {
					draw_daybargraph();
				}
				
				$('a[data-toggle="tab"][href="#'+tab.attr('id')+'"]').on('shown.bs.tab', function (e) {
					draw_daybargraph();
				})
				
				$('a[data-toggle="tab"][href!="#'+tab.attr('id')+'"]').on('hidden.bs.tab', function(e) {
					$('#sales-group-today').empty();
				});
				
			} else {
				draw_daybargraph();
			}	
		});
		
        function draw_daybargraph() {
			<?php 
                $salesgroups = get_bookingsalesgroups();
                $groups = array();
                $data = array(
                    'today' => array(
                        'today' => DplusDateTime::format_date($date, 'F dS Y')
                    ),
                    'week' => array(),
                    'month' => array(),
                    'year' => array()
                );
                foreach ($salesgroups as $salesgroup) {
                    $groups[] = $config->booking_groups[$salesgroup];
                    $data['today'][$salesgroup] = get_bookingsalesgroup_day($salesgroup, $date);
                }
            ?>
            Morris.Bar({
                element: 'sales-group-today',
                data: [
                    <?= json_encode($data['today']); ?>
                ],
                xkey: 'today',
                ykeys: <?= json_encode($salesgroups); ?>,
                labels: <?= json_encode($groups); ?>
            });
		}
    </script>
</div>
