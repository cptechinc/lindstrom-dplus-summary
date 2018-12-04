<?php use Dplus\Base\DplusDateTime; ?>
<form action="<?= $bookingsdisplay->get_dateformurl(); ?>" method="GET" class="mb-3 form-inline">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                <label>Date</label>
            </div>
            <div class="col">
                <?php $name = 'date'; $value = DplusDateTime::format_date($date); ?>
                <?php include "{$config->paths->content}common/date-picker.php"; ?>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success">Submit</button>
                <?php if (!$bookingsdisplay->is_datetoday()) : ?>
                    <a href="<?= $bookingsdisplay->get_todayURL(); ?>" class="btn btn-primary">View Today</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>
