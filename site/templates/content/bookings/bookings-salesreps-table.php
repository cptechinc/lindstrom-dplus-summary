<table class="table border mb-3">
    <thead class="thead-dark text-white border border-dark">
        <tr>
            <th scope="col">Salesreps</th>
            <th scope="col" class="text-right">Day</th>
            <th scope="col" class="text-right">Week</th>
            <th scope="col" class="text-right">Month</th>
            <th scope="col" class="text-right">Year-To-Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $salesreps = $bookingsdisplay->get_salesreps(); ?>
        <?php foreach ($salesreps as $salesrep) : ?>
            <tr>
                <th scope="row"><?= $salesrep; ?></th>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_day($salesrep)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_week($salesrep)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_month($salesrep)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_year($salesrep)); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="bg-dark text-white">
            <th scope="row">Total</th>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_day($bookingsdisplay->salesgroup)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_week($bookingsdisplay->salesgroup)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_month($bookingsdisplay->salesgroup)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_year($bookingsdisplay->salesgroup)); ?></td>
        </tr>
    </tbody>
</table>
