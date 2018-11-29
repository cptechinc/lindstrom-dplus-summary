<?php
	use Dplus\Base\DplusDateTime;
	
	$date = $input->get->date ? date('Ymd', strtotime($input->get->text('date'))) : date('Ymd');
	$today = date('Ymd');
	$year = date('Y', strtotime($date));
	$month = date('n', strtotime($date));
	$dateurl = new Purl\Url($page->fullURL->getUrl());
	$dateurl->query->remove('date');
	$bgcolors = array_rand(array_flip($config->allowedcolors), $month);
	
	$todayurl = new Purl\Url($dateurl->getUrl());
	$todayurl->query->add('date', DplusDateTime::format_date($date));
?>

<?php include('./_head-blank.php'); // include header markup ?>
	<div class="container page">
		<div>
		    <h3>This Year</h3>
		    <div id="year-trend"></div>
		    
		    <script>
		        $(function() {
		            <?php 
		                $data = array();
		                for ($i = 1; $i < $month; $i++) {
		                    $mm = $i < 10 ? "0$i" : $i;
		                    $day = "01";
		                    $yyyymmdd = $year.$mm.$day;
		                    $monthdata = array(
		                        'month' => DplusDateTime::format_date($yyyymmdd, 'Y-m-d'),
		                        'sales' => $page->stringerbell->format_money(get_bookingtotal_month($yyyymmdd))
		                    );
		                    $data[] = $monthdata;
		                }
		            ?>
		            Morris.Line({
		                element: 'year-trend',
		                data: 
		                    [
								{"month":"2018-01-01","sales":"8,588,620.73"},
								{"month":"2018-02-01","sales":"8,683,118.31"},
								{"month":"2018-03-01","sales":"9,020,934.66"},
								{"month":"2018-04-01","sales":"8,837,793.24"},
								{"month":"2018-05-01","sales":"9,096,637.99"},
								{"month":"2018-06-01","sales":"8,842,584.21"},
								{"month":"2018-07-01","sales":"8,834,866.78"},
								{"month":"2018-08-01","sales":"9,329,361.18"},
								{"month":"2018-09-01","sales":"8,410,996.83"},
								{"month":"2018-10-01","sales":"9,208,932.51"}
							]
		                ,
		                xkey: 'month',
		                dateFormat: function (d) {
							var ds = new Date(d);
							return moment(ds).format('MM/DD/YYYY');
						},
		                ykeys: ['sales'],
		                labels: ['Sales']
		            });
		        });
		    </script>
		</div>

	</div>
<?php include('./_foot.php'); // include footer markup ?>
