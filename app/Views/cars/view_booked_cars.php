<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Booked Cars</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Booking ID</th>
                <th scope="col">Car Model</th>
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
                    <td><?= $booking['car']['vehicle_model'] ?></td>
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
<?= $this->endSection() ?>