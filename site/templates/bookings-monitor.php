<?php
	use Dplus\Base\DplusDateTime;
	include('./_BookingsDisplay.class.php');

	$date = $input->get->date ? date('Ymd', strtotime($input->get->text('date'))) : date('Ymd');
	$bookingsdisplay = new BookingsSalesGroupsDisplay(session_id(), $page->fullURL, $date);
	$bgcolors = array_rand(array_flip($config->allowedcolors), $bookingsdisplay->get_monthfromdate());
	$page->title = "Bookings for " . DplusDateTime::format_date($date);
?>

<?php include('./_head-blank-refresh.php'); // include header markup ?>
	<div class="container page">
		<div class="">
			<div class="row mt-2 mb-1">
				<div class="col-sm-12">
					<h1 class="font-weight-bold rounded"><?= $page->title; ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<?php include "{$config->paths->content}bookings/date-form.php"; ?>
				</div>
			</div>
			<div class="monitor">
				<?php include "{$config->paths->content}bookings/bookings-groups-table.php"; ?>
			</div>
			
			<?php
				include "{$config->paths->content}bookings/total-bookings-carousel.php";
				include "{$config->paths->content}bookings/charts/line/year-trend-groups.php";
			?>
		</div>

	</div>
<?php include('./_foot.php'); // include footer markup ?>
