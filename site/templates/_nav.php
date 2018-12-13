<nav class="navbar navbar-expand-lg navbar-light bg-light text-dark">
    <div class="container">
        <a class=" font-weight-bold navbar-brand" href="<?= $pages->get('/')->url; ?>"><?= $site->company_name; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a href="<?= $pages->get('template=bookings-menu')->url; ?>" class="nav-link">
                        <span class="font-weight-bold"><?= $pages->get('template=bookings-menu')->title; ?></span>
                    </a>
                </li>
        		<?php $children = $pages->get('template=bookings-menu')->children(); ?>
                <?php foreach ($children as $child) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $child->url; ?>"><?= $child->title; ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Salesgroups</a>
                    <div class="dropdown-menu">
                        <?php $salesgroups = $bookingsdisplay->get_salesgroups(); ?>
                        <?php foreach ($salesgroups as $salesgroup) : ?>
                            <a class="dropdown-item" href="<?= $bookingsdisplay->generate_salesgroup_bookings_URL($salesgroup, $date); ?>"><?= $config->booking_groups[$salesgroup]; ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
