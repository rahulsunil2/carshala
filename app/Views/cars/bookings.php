<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1 class="my-4"><?= $title ?></h1>
    <?php if (count($bookings) > 0) : ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Car Model</th>
                        <th scope="col">Car Number</th>
                        <th scope="col">Rent per Day</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Total Rent</th>
                        <?php if (session()->get('user_type') == 'agency') : ?>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Customer Email</th>
                        <?php else : ?>
                            <th scope="col">Agency Name</th>
                            <th scope="col">Agency Email</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking) : ?>
                        <tr>
                            <td><?= $booking['id'] ?></td>
                            <td><?= $booking['car']['vehicle_model'] ?></td>
                            <td><?= $booking['car']['vehicle_number'] ?></td>
                            <td>$<?= $booking['car']['rent_per_day'] ?></td>
                            <td><?= $booking['booking_start_date'] ?></td>
                            <td><?= $booking['booking_end_date'] ?></td>
                            <td>$<?= $booking['total_rent'] ?></td>
                            <td><?= $booking['user']['name'] ?></td>
                            <td>
                                <a href="mailto:<?= $booking['user']['email'] ?>"><?= $booking['user']['email'] ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="text-center">
            <h4 class="my-5">No bookings have been made yet.</h4>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>