<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1 class="my-4">My Bookings</h1>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?= $booking['id'] ?></td>
                        <td><?= $booking['car_model'] ?></td>
                        <td><?= $booking['car_number'] ?></td>
                        <td><?= $booking['rent_per_day'] ?></td>
                        <td><?= $booking['start_date'] ?></td>
                        <td><?= $booking['end_date'] ?></td>
                        <td><?= $booking['total_rent'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>You have not made any bookings yet.</p>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>