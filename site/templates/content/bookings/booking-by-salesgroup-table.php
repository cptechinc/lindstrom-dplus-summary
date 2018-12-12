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
        <?php $salesgroups = get_bookingsalesgroups(); ?>
        <?php foreach ($salesgroups as $salesgroup) : ?>
            <tr>
                <th scope="row"><?= $config->booking_groups[$salesgroup]; ?></th>
                <td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_day($salesgroup, $date)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_week($salesgroup, $date)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_month($salesgroup, $date)); ?></td>
                <td class="text-right"><?= $page->stringerbell->format_money(get_bookingsalesgroup_year($salesgroup, $date)); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="bg-dark text-white">
            <th scope="row">Total</th>
            <td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_day($date)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_week($date)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_month($date)); ?></td>
            <td class="text-right"><?= $page->stringerbell->format_money(get_bookingtotal_year($date)); ?></td>
        </tr>
    </tbody>
</table>
