<?php
	use Dplus\Base\DplusDateTime;
	include('./_BookingsDisplay.class.php');

	$date = $input->get->date ? date('Ymd', strtotime($input->get->text('date'))) : date('Ymd');
	$bookingsdisplay = new BookingsSalesGroupsDisplay(session_id(), $page->fullURL, $date);
	$bgcolors = array_rand(array_flip($config->allowedcolors), $bookingsdisplay->get_monthfromdate());
	$page->title = "Bookings Menu";
?>

<?php include('./_head.php'); // include header markup ?>
	<div class="container page">
        <h1 class="font-weight-bold text-white bg-info rounded p-3 mt-3"><?= $page->title; ?></h1>
        <div class="row">
            <div class="col-sm-6 mt-2">
                <?php $children = $pages->get('template=bookings-menu')->children(); ?>
        		<div class="list-group">
                    <?php foreach ($children as $child) : ?>
            			<a href="<?= $child->url; ?>" class="list-group-item list-group-item-action font-weight-bold">
                            <?= $child->title; ?>
            			</a>
                    <?php endforeach; ?>
                    <?php $salesgroups = $bookingsdisplay->get_salesgroups(); ?>
                    <?php foreach ($salesgroups as $salesgroup) : ?>
                        <a href="<?= $bookingsdisplay->generate_salesgroup_bookings_URL($salesgroup, $date); ?>" class="list-group-item list-group-item-action">
                            <?= $config->booking_groups[$salesgroup]; ?>
                        </a>
                    <?php endforeach; ?>
        		</div>
            </div>
        </div>
	</div>
<?php include('./_foot.php'); // include footer markup ?>
