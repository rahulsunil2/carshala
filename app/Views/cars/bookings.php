<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1 class="my-4">Agency Cars Bookings</h1>
    <?php if (count($bookings) > 0) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car Model</th>
                    <th>Car Number</th>
                    <th>Rent per Day</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Rent</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?= $booking['id'] ?></td>
                        <td><?= $booking['car']['vehicle_model'] ?></td>
                        <td><?= $booking['car']['vehicle_number'] ?></td>
                        <td><?= $booking['car']['rent_per_day'] ?></td>
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
        <p>You have not made any bookings yet.</p>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>