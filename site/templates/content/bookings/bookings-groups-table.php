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
        <?php $salesgroups = $bookingsdisplay->get_salesgroups(); ?>
        <?php foreach ($salesgroups as $salesgroup) : ?>
            <tr>
                <th scope="row">
                    <a href='<?= $page->url."salesreps/?salesgroup=$salesgroup"; ?>'>
                        <?= $config->booking_groups[$salesgroup]; ?>
                    </a>
                </th>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_day($salesgroup)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_week($salesgroup)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_month($salesgroup)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_month($salesgroup)); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="bg-dark text-white">
            <th scope="row">Total</th>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_total_day()); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_total_week()); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_total_month()); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_total_year()); ?></td>
        </tr>
    </tbody>
</table>
