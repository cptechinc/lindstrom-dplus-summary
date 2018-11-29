<?php 
    $data = array();
    for ($i = 1; $i < $month; $i++) {
        $mm = $i < 10 ? "0$i" : $i;
        $day = "01";
        $yyyymmdd = $year.$mm.$day;
        $monthdata = array(
            'month' => DplusDateTime::format_date($yyyymmdd, 'Y-m-d'),
            'sales' => floatval(get_bookingtotal_month($yyyymmdd))
        );
        $data[] = $monthdata;
    }
?>
Morris.Line({
    element: 'year-trend',
    data: <?= json_encode($data); ?>,
    xkey: 'month',
    dateFormat: function (d) {
        var ds = new Date(d);
        return moment(ds).format('MMMM YYYY');
    },
    ykeys: ['sales'],
    labels: ['Amount Booked'],
    xLabelFormat: function (x) { return  moment(x).format('MMM YYYY'); },
});
?
