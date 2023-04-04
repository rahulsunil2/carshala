<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Bookings</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= base_url('cars') ?>" class="btn btn-primary mb-3"><i class="bi bi-arrow-left"></i> Back to Cars</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="https://cdni.autocarindia.com/utils/imageresizer.ashx?n=https://cms.haymarketindia.net/model/uploads/modelimages/Hyundai-Grand-i10-Nios-200120231541.jpg" class="card-img-top" alt="<?= $car['vehicle_model'] ?>">
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
            <?php if (session()->has('success_booking')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session('success_booking') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error_booking')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session('error_booking') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Booking Start Date</th>
                        <th scope="col">Booking End Date</th>
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
        </div>
    </div>
</div>
<?= $this->endSection() ?>