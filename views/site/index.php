<?php

use app\dto\CurrenciesDto;
use app\dto\RatesDto;

/** @var yii\web\View $this */
/** @var CurrenciesDto $currencies */
/** @var RatesDto $rates */


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Rates for 1 USD</h2>
            </div>
        </div>
        <table class='table table-striped'>
            <thead>
            <tr>
                <th scope='col'>Code</th>
                <th scope='col'>Name</th>
                <th scope='col'>Rate</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($currencies->list as $code => $name): ?>
                <tr>
                    <td><?= $code ?></td>
                    <td><?= $name ?></td>
                    <td><?= $rates->list[$code] ?? 'N/A' ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
