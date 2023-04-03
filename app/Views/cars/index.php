<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            <h1>Available Cars</h1>
        </div>
        <div class="col-md-4 text-end">
            <?php if (session()->get('isLoggedIn') && session()->get('userType') == 'agency') : ?>
                <a href="<?= site_url('/cars/add') ?>" class="btn btn-primary">Add Car</a>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!empty($cars)) : ?>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Number</th>
                    <th>Capacity</th>
                    <th>Rent Per Day</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car) : ?>
                    <tr>
                        <td><?= $car['vehicle_model'] ?></td>
                        <td><?= $car['vehicle_number'] ?></td>
                        <td><?= $car['seating_capacity'] ?></td>
                        <td><?= $car['rent_per_day'] ?></td>
                        <td>
                            <a href="<?= site_url('/cars/book/' . $car['id']) ?>" class="btn btn-primary">Book</a>
                            <?php if (session()->get('isLoggedIn') && session()->get('userType') == 'agency') : ?>
                                <a href="<?= site_url('/cars/edit/' . $car['id']) ?>" class="btn btn-secondary">Edit</a>
                                <a href="<?= site_url('/cars/delete/' . $car['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info mt-3" role="alert">
            No cars available.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>