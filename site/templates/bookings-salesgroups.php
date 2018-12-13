<?php
	use Dplus\Base\DplusDateTime;
	include('./_BookingsDisplay.class.php');

	$date = $input->get->date ? date('Ymd', strtotime($input->get->text('date'))) : date('Ymd');
	$bookingsdisplay = new BookingsSalesGroupsDisplay(session_id(), $page->fullURL, $date);
	$bgcolors = array_rand(array_flip($config->allowedcolors), $bookingsdisplay->get_monthfromdate());
	$page->title = "Bookings for " . DplusDateTime::format_date($date);
?>

<?php include('./_head.php'); // include header markup ?>
	<div class="container page">
		<div class="row mt-2 mb-1">
			<div class="col-sm-12">
				<h1 class="font-weight-bold text-white bg-info rounded p-3"><?= $page->title; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5">
				<?php include "{$config->paths->content}bookings/date-form.php"; ?>
			</div>
		</div>
		<?php
			include "{$config->paths->content}bookings/bookings-groups-table.php";
			include "{$config->paths->content}bookings/total-bookings-carousel.php";
		?>
		<div class="mt-4">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="day-tab-link" data-toggle="tab" href="#day-tab" role="tab" aria-controls="home" aria-selected="true">
						Day
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="year-tab-link" data-toggle="tab" href="#year-tab" role="tab" aria-controls="profile" aria-selected="false">
						Year
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade show active" id="day-tab" role="tabpanel" aria-labelledby="day-tab-link">
					<?php include "{$config->paths->content}bookings/charts/bar/day-groups.php";  ?>
				</div>
				<div class="tab-pane fade" id="year-tab" role="tabpanel" aria-labelledby="year-tab-link">
					<?php include "{$config->paths->content}bookings/charts/line/year-trend-groups.php"; ?>
				</div>
			</div>
		</div>
	</div>
<?php include('./_foot.php'); // include footer markup ?>
