<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            <h1>Available Cars</h1>
        </div>
        <div class="col-md-4 text-end">
            <?php if (session()->get('user') && session()->get('userType') === 'agency') : ?>
                <a href="<?= site_url('/cars/add') ?>" class="btn btn-primary">Add Car</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-3">
        <?php if (!empty($cars)) : ?>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php elseif (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php foreach ($cars as $car) : ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="https://cdni.autocarindia.com/utils/imageresizer.ashx?n=https://cms.haymarketindia.net/model/uploads/modelimages/Hyundai-Grand-i10-Nios-200120231541.jpg" class="card-img-top" alt="<?= $car['vehicle_model'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $car['vehicle_model'] ?></h5>
                            <p class="card-text"><strong>Vehicle Number:</strong> <?= $car['vehicle_number'] ?></p>
                            <p class="card-text"><strong>Seating Capacity:</strong> <?= $car['seating_capacity'] ?></p>
                            <p class="card-text"><strong>Rent Per Day:</strong> <?= $car['rent_per_day'] ?></p>
                            <?php if ((session()->get('user')) && (session()->get('userType') == 'customer')) : ?>
                                <form method="post" action="<?= site_url('/cars/book') ?>">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_of_days">Number of Days</label>
                                        <select class="form-control" id="no_of_days" name="no_of_days" required>
                                            <option value="">Select</option>
                                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="rent_per_day" value="<?= $car['rent_per_day'] ?>">
                                    <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                                    <button type="submit" class="btn btn-primary">Rent</button>
                                </form>

                            <?php elseif ((session()->get('user')) && (session()->get('userType') == 'agency')) : ?>
                                <a href="<?= site_url('/cars/edit/' . $car['id']) ?>" class="btn btn-primary">Edit</a>
                                <a href="<?= site_url('/cars/delete/' . $car['id']) ?>" class="btn btn-danger">Delete</a>
                                <a href="<?= site_url('/cars/booked-cars/' . $car['id']) ?>" class="btn btn-primary">View Bookings</a>

                            <?php else : ?>
                                <a href="<?= site_url('/login') ?>" class="btn btn-primary">Login to Rent</a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="alert alert-info mt-3" role="alert">
                No cars available.
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>