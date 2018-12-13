<div class="card">
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php for ($i = 1; $i < $bookingsdisplay->get_monthfromdate(); $i++) : ?>
                <?php
                    $mm = $i < 10 ? "0$i" : $i;
                    $day = "01";
                    $yyyymmdd = $bookingsdisplay->get_yearfromdate().$mm.$day;
                ?>
            <div class="carousel-item rounded-top <?= $i == 1 ? 'active' : ''; ?>" style="background: <?= $bgcolors[$i]; ?>; height: 140px;">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="font-weight-bold"><?= date('F', strtotime($yyyymmdd)); ?></h2>
                    <p class="h5"><?= "$ ".$page->stringerbell->format_money($bookingsdisplay->get_group_total_month($bookingsdisplay->salesgroup, $yyyymmdd)); ?></p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-around">
            <?php for ($i = 1; $i < $bookingsdisplay->get_monthfromdate(); $i++) : ?>
                <?php
                    $mm = $i < 10 ? "0$i" : $i;
                    $day = "01";
                    $yyyymmdd = $bookingsdisplay->get_yearfromdate().$mm.$day;
                ?>
                <div>
                    <span class="font-weight-bold"><?= date('M', strtotime($yyyymmdd)); ?>:&ensp;</span>
                    <span class="small"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_month($bookingsdisplay->salesgroup, $yyyymmdd)); ?>&ensp;</span>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
