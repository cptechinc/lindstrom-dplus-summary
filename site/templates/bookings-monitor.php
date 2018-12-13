<?php
	use Dplus\Base\DplusDateTime;
	include('./_BookingsDisplay.class.php');

	$date = $input->get->date ? date('Ymd', strtotime($input->get->text('date'))) : date('Ymd');
	$bookingsdisplay = new BookingsSalesGroupsDisplay(session_id(), $page->fullURL, $date);
	$bgcolors = array_rand(array_flip($config->allowedcolors), $bookingsdisplay->get_monthfromdate());
	$page->title = "Bookings for " . DplusDateTime::format_date($date);
?>

<?php include('./_head-blank-refresh.php'); // include header markup ?>
	<div class="container page d-flex">
		<div class="align-self-center">
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
		</div>

	</div>
<?php include('./_foot.php'); // include footer markup ?>
