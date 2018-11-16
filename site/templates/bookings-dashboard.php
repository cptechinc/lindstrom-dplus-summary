<?php 
	$date = date('Ymd');
	$year = date('Y', strtotime($date));
	$month = date('n', strtotime($date));
	$bgcolors = array_rand(array_flip($config->allowedcolors), $month);
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
				<div class="card-body">
					<h2><?= $year; ?> Monthly Bookings</h2>
				</div>
				<div id="bookings-by-month-carousel" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner">
					<?php for ($i = 1; $i < $month; $i++) : ?>
						<div class="carousel-item <?= $i == 1 ? 'active' : ''; ?>" style="height: 200px;">
							<div class="row">
								<?php for ($f = 0; $f < 3; $f++) : ?>
									<?php 
										$mm = $i < 10 ? "0$i" : $i; 
										$day = "01";
										$yyyymmdd = $year.$mm.$day;
									 ?>
									 <div class="col text-white text-center" style="background: <?= $bgcolors[$i]; ?>">
									  <h2><?= date('M', strtotime($yyyymmdd)); ?></h2>
									  <h3><?= "$ ".$page->stringerbell->format_money(get_booking_month($yyyymmdd)); ?></h3>
									</div>
									<?php $i++; ?>
								<?php endfor; ?>
							</div>
						</div>
					<?php endfor; ?>
				  </div>
				</div>
			</div>
		</div>
	</div>
<?php include('./_foot.php'); // include footer markup ?>
