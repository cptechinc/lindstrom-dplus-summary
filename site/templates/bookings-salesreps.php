<?php
	use Dplus\Base\DplusDateTime;
	include('./_BookingsDisplay.class.php');

	$date = $input->get->date ? date('Ymd', strtotime($input->get->text('date'))) : date('Ymd');
	$bookingsdisplay = new BookingsSalesRepsDisplay(session_id(), $page->fullURL, $date);
    $bookingsdisplay->set_salesgroup($input->get->text('salesgroup'));

	$bgcolors = array_rand(array_flip($config->allowedcolors), $bookingsdisplay->get_monthfromdate());
	$page->title = "Bookings for " . $config->booking_groups[$bookingsdisplay->salesgroup] . " ". DplusDateTime::format_date($date);
?>
<?php include('./_head-blank.php'); // include header markup ?>
	<div class="container page">
		<div class="row mt-2 mb-1">
			<div class="col-sm-12">
				<h1 class="font-weight-bold text-white bg-info rounded p-3"><?= $page->title; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<?php include "{$config->paths->content}bookings/date-form.php"; ?>
			</div>
            <div class="col-sm-6">
                <a href="<?= $bookingsdisplay->generate_total_bookings_URL($date); ?>" class='btn btn-primary float-right'>
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Bookings by Group
                </a>
            </div>
		</div>
		<?php
			include "{$config->paths->content}bookings/bookings-salesreps-table.php";
			// file included below shows totals for the individual salesgroup
			include "{$config->paths->content}bookings/total-salesgroups-bookings-carousel.php";
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
					<?php include "{$config->paths->content}bookings/charts/bar/day-salesreps.php";  ?>
				</div>
				<div class="tab-pane fade" id="year-tab" role="tabpanel" aria-labelledby="year-tab-link">
					<?php include "{$config->paths->content}bookings/charts/line/year-trend-reps.php"; ?>
				</div>
			</div>
		</div>
	</div>
<?php include('./_foot.php'); // include footer markup ?>
