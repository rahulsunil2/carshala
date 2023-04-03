<!-- cars.php -->
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="container">
    <h1>Cars List</h1>
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vehicle Model</th>
                <th scope="col">Vehicle Number</th>
                <th scope="col">Seating Capacity</th>
                <th scope="col">Rent per Day</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($cars) > 0) : ?>
                <?php foreach ($cars as $car) : ?>
                    <tr>
                        <th scope="row"><?= $car['id'] ?></th>
                        <td><?= $car['vehicle_model'] ?></td>
                        <td><?= $car['vehicle_number'] ?></td>
                        <td><?= $car['seating_capacity'] ?></td>
                        <td><?= $car['rent_per_day'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">No cars found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>