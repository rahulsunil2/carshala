<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container my-4">
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-md-8">
            <?php if (session()->get('user') && session()->get('userType') === 'agency') : ?>
                <h1 class="fw-bold mb-0">Agency Cars</h1>
            <?php else : ?>
                <h1 class="fw-bold mb-0">Available Cars</h1>
            <?php endif; ?>
        </div>
        <div class="col-md-4 text-end">
            <?php if (session()->get('user') && session()->get('userType') === 'agency') : ?>
                <a href="<?= site_url('/cars/add') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Add Car
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!empty($cars)) : ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($cars as $car) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?= $car['vehicle_image'] ?>" class="card-img-top" alt="<?= $car['vehicle_model'] ?>" onerror="this.src='https://images.garipoint.com/images/vehicle_notavailable.jpg'">
                        <div class="card-body">
                            <h5 class="card-title"><?= $car['vehicle_model'] ?></h5>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <p class="card-text mb-0"><strong>Vehicle Number:</strong></p>
                                    <p class="card-text"><?= $car['vehicle_number'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="card-text mb-0"><strong>Seating Capacity:</strong></p>
                                    <p class="card-text"><?= $car['seating_capacity'] ?></p>
                                </div>
                            </div>
                            <p class="card-text mb-0"><strong>Rent Per Day:</strong></p>
                            <p class="card-text"><?= $car['rent_per_day'] ?></p>

                            <?php if (session()->get('user') && session()->get('userType') == 'customer') : ?>
                                <form method="post" action="<?= site_url('/cars/book') ?>" class="mt-4">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_of_days" class="form-label">Number of Days</label>
                                        <select class="form-control" id="no_of_days" name="no_of_days" required>
                                            <option value="">Select</option>
                                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="rent_per_day" value="<?= $car['rent_per_day'] ?>">
                                    <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Rent</button>
                                    </div>
                                </form>

                            <?php elseif (session()->get('user') && session()->get('userType') == 'agency') : ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <a href="<?= site_url('/cars/edit/' . $car['id']) ?>" class="btn btn-outline-primary me-2">Edit</a>
                                        <a href="<?= site_url('/cars/delete/' . $car['id']) ?>" class="btn btn-outline-danger">Delete</a>
                                    </div>
                                    <a href="<?= site_url('/cars/booked-cars/' . $car['id']) ?>" class="btn btn-primary">View Bookings</a>
                                </div>

                            <?php else : ?>

                                <div class="d-grid gap-2">
                                    <a href="<?= site_url('/login') ?>" class="btn btn-primary">Login to Rent</a>
                                </div>

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