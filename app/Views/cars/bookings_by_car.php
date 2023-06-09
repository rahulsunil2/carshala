<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="mb-0">Bookings</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= base_url('cars') ?>" class="btn btn-primary">Back to Cars</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="<?= $car['vehicle_image'] ?>" class="card-img-top" alt="<?= $car['vehicle_model'] ?>" onerror="this.src='https://images.garipoint.com/images/vehicle_notavailable.jpg'">
                <div class="card-body">
                    <h5 class="card-title"><?= $car['vehicle_model'] ?></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Vehicle Number:</strong> <?= $car['vehicle_number'] ?></li>
                        <li class="list-group-item"><strong>Seating Capacity:</strong> <?= $car['seating_capacity'] ?></li>
                        <li class="list-group-item"><strong>Rent Per Day:</strong> <?= $car['rent_per_day'] ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">

            <?php if (count($bookings) > 0) : ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Booking ID</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Total Rent</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Customer Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking) : ?>
                            <tr>
                                <td><?= $booking['id'] ?></td>
                                <td><?= $booking['booking_start_date'] ?></td>
                                <td><?= $booking['booking_end_date'] ?></td>
                                <td><?= $booking['total_rent'] ?></td>
                                <td><?= $booking['customer']['name'] ?></td>
                                <td><?= $booking['customer']['email'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="text-center">
                    <h4 class="my-5">No bookings have been made yet.</h4>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?= $this->endSection() ?>