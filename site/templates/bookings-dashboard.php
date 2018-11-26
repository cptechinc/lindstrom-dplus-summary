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
		<div class="row mt-2 mb-1">
			<div class="col-sm-12">
				<h1 class="font-weight-bold text-white bg-info rounded p-3">Bookings by Sales Group</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<form action="<?= $dateurl->getUrl(); ?>" method="GET" class="mb-3">
					<div class="form-group">
						<label>Date</label>
						<?php $name = 'date'; $value = DplusDateTime::format_date($date); ?>
						<?php include "{$config->paths->content}common/date-picker.php"; ?>
					</div>
					<button type="submit" class="btn btn-sm btn-success">Submit</button>
					<?php if ($date !== $today) : ?>
						<a href="<?= $todayurl->getUrl(); ?>" class="btn btn-sm btn-primary">View Today</a>
					<?php endif; ?>
				</form>
			</div>
		</div>
		
		<table class="table border mb-3">
			<thead class="thead-dark text-white border border-dark">
				<tr>
					<th scope="col">Salesgroup</th>
					<th scope="col" class="text-right">Day</th>
					<th scope="col" class="text-right">Week</th>
					<th scope="col" class="text-right">Month</th>
					<th scope="col" class="text-right">Year-To-Date</th>
				</tr>
			</thead>
			<tbody>
				<?php $salesgroups = get_bookingsalesgroups(); ?>
				<?php foreach ($salesgroups as $salesgroup) : ?>
					<tr>
						<th scope="row"><?= $config->booking_groups[$salesgroup['salesgroup']]; ?></th>
						<td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_day($salesgroup['salesgroup'], $date)); ?></td>
						<td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_week($salesgroup['salesgroup'], $date)); ?></td>
						<td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_month($salesgroup['salesgroup'], $date)); ?></td>
						<td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_year($salesgroup['salesgroup'], $date)); ?></td>
					</tr>
				<?php endforeach; ?>
				<tr class="bg-dark text-white">
					<th scope="row">Total</th>
					<td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_day($date)); ?></td>
					<td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_week($date)); ?></td>
					<td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_month($date)); ?></td>
					<td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_year($date)); ?></td>
				</tr>
			</tbody>
		</table>
		<div class="card">
			<div class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php for ($i = 1; $i < $month; $i++) : ?>
						<?php
							$mm = $i < 10 ? "0$i" : $i;
							$day = "01";
							$yyyymmdd = $year.$mm.$day;
						?>
					<div class="carousel-item rounded-top <?= $i == 1 ? 'active' : ''; ?>" style="background: <?= $bgcolors[$i]; ?>; height: 140px;">
						<div class="carousel-caption d-none d-md-block">
							<h2 class="font-weight-bold"><?= date('F', strtotime($yyyymmdd)); ?></h2>
							<p class="h5"><?= "$ ".$page->stringerbell->format_money(get_bookingtotal_month($yyyymmdd)); ?></p>
						</div>
					</div>
					<?php endfor; ?>
				</div>
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-around">
					<?php for ($i = 1; $i < $month; $i++) : ?>
						<?php $mm = $i < 10 ? "0$i" : $i; ?>
						<?php $day = "01"; ?>
						<?php $yyyymmdd = $year.$mm.$day; ?>
						<div>
							<span class="font-weight-bold"><?= date('M', strtotime($yyyymmdd)); ?>:&ensp;</span>
							<span class="small"><?= $page->stringerbell->format_money(get_bookingtotal_month($yyyymmdd)); ?>&ensp;</span>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
		<?php if ($user->isLoggedin()) : ?>
			<div>
				<h3>Today</h3>
				<div id="sales-group-today"></div>
				
				<script>
					$(function() {
						<?php 
							$salesgroups = get_bookingsalesgroups();
							$data = array();
							foreach ($salesgroups as $salesgroup) {
								$data[$salesgroup['salesgroup']]['today'] = get_bookingsalesgroup_day($salesgroup['salesgroup'], $date);
								$data[$salesgroup['salesgroup']]['week'] = get_bookingsalesgroup_week($salesgroup['salesgroup'], $date);
								$data[$salesgroup['salesgroup']]['month'] = get_bookingsalesgroup_month($salesgroup['salesgroup'], $date);
								$data[$salesgroup['salesgroup']]['year'] = get_bookingsalesgroup_year($salesgroup['salesgroup'], $date);
							}
						?>
						Morris.Bar({
		element: 'bar-example',
		data: [
		{ y: '2006', a: 100, b: 90 },
		{ y: '2007', a: 75,  b: 65 },
		{ y: '2008', a: 50,  b: 40 },
		{ y: '2009', a: 75,  b: 65 },
		{ y: '2010', a: 50,  b: 40 },
		{ y: '2011', a: 75,  b: 65 },
		{ y: '2012', a: 100, b: 90 }
		],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Series A', 'Series B']
		});
	});
				</script>
			</div>
		<?php endif; ?>
		
	</div>
<?php include('./_foot.php'); // include footer markup ?>
