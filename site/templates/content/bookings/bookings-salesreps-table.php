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
        <?php $salesreps = $bookingsdisplay->get_salesreps($salesgroup); ?>
        <?php foreach ($salesreps as $salesrep) : ?>
            <tr>
                <th scope="row"><?= $salesrep; ?></th>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_day($salesgroup, $salesrep)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_week($salesgroup, $salesrep)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_month($salesgroup, $salesrep)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_salesrep_total_year($salesgroup, $salesrep)); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="bg-dark text-white">
            <th scope="row">Total</th>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_day($salesgroup)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_week($salesgroup)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_month($salesgroup)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money($bookingsdisplay->get_group_total_year($salesgroup)); ?></td>
        </tr>
    </tbody>
</table>
