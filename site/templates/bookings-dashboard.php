<?php 
	use Dplus\Base\Validator;
	$validator = new Validator(); 
	$date = date('Ymd');
	$year = date('Y', strtotime($date));
	$month = date('n', strtotime($date));
?>

<?php include('./_head.php'); // include header markup ?>
	<div class="container page">
		<div class="row mt-5 mb-1">
			<div class="col-sm-12">
				<h1 class="font-weight-bold text-danger"><?= $page->title; ?></h1>
			</div>
		</div>
		<div>
			<div class="card">
				<div class="card-header">
					Sales Group Bookings
				</div>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Salesgroup</th>
							<th scope="col">Day</th>
							<th scope="col">Month</th>
							<th scope="col">Year-To-Date</th>
						</tr>
					</thead>
					<tbody>
						<?php $salesgroups = get_bookingsalesgroups(); ?>
						<?php foreach ($salesgroups as $salesgroup) : ?>
							<tr>
								<th scope="row"><?= $salesgroup['salesgroup']; ?></th>
								<td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroupbooking_day($salesgroup['salesgroup'], $date)); ?></td>
								<td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_month($salesgroup['salesgroup'], $date)); ?></td>
								<td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_year($salesgroup['salesgroup'], $date)); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner">
					<?php for ($i = 1; $i < $month; $i++) : ?>
						<?php 
							$mm = $i < 10 ? "0$i" : $i; 
							$day = "01";
							$yyyymmdd = $year.$mm.$day;
							$bgcolors = array_rand(array_flip($config->allowedcolors), $month);
						?>
						
						<div class="carousel-item <?= $i == 1 ? 'active' : ''; ?>" style="background: <?= $bgcolors[$i]; ?>; height: 400px;">
							<div class="carousel-caption d-none d-md-block">
						      <h5><?= date('M', strtotime($yyyymmdd)); ?></h5>
						      <p><?= "$ ".$page->stringerbell->format_money(get_booking_month($yyyymmdd)); ?></p>
							</div>
						</div>
					<?php endfor; ?>
				  </div>
				</div>
				<div class="card-body">
					<div class="row">
						<?php for ($i = 1; $i < $month; $i++) : ?>
							<?php $mm = $i < 10 ? "0$i" : $i; ?>
							<?php $day = "01"; ?>
							<?php $yyyymmdd = $year.$mm.$day; ?>
							
							<div class="col"><?= date('M', strtotime($yyyymmdd)) . ": " . $page->stringerbell->format_money(get_booking_month($yyyymmdd)); ?></div>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include('./_foot.php'); // include footer markup ?>
