<?= $this->extend('layouts/bootstrap') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Car Details</h2>
    <div class="row">
        <div class="col-sm-6">
            <img class="img-fluid" src="<?= base_url('images/' . $car['image']) ?>" alt="Car Image">
        </div>
        <div class="col-sm-6">
            <h4><?= $car['vehicle_model'] ?></h4>
            <ul class="list-group mt-4">
                <li class="list-group-item"><strong>Vehicle Number:</strong> <?= $car['vehicle_number'] ?></li>
                <li class="list-group-item"><strong>Seating Capacity:</strong> <?= $car['seating_capacity'] ?></li>
                <li class="list-group-item"><strong>Rent per day:</strong> <?= $car['rent_per_day'] ?></li>
                <li class="list-group-item"><strong>Available:</strong> <?= $car['available'] ? 'Yes' : 'No' ?></li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>