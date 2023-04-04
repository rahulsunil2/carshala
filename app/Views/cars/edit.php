<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">

                <div class="card-header bg-primary text-white">Edit Car</div>
                <div class="card-body">

                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach (session('errors') as $error) : ?>
                                <?= esc($error) ?><br>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <form action="<?= base_url('cars/update/' . $car['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="vehicle_model" class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" value="<?= old('vehicle_model', $car['vehicle_model']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_number" class="form-label">Vehicle Number</label>
                            <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" value="<?= old('vehicle_number', $car['vehicle_number']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="seating_capacity" class="form-label">Seating Capacity</label>
                            <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" value="<?= old('seating_capacity', $car['seating_capacity']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="rent_per_day" class="form-label">Rent per day</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control" id="rent_per_day" name="rent_per_day" value="<?= old('rent_per_day', $car['rent_per_day']) ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_image" class="form-label">Vehicle Image</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="vehicle_image" name="vehicle_image" value="<?= old('vehicle_image', $car['vehicle_image']) ?>">
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('cars') ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>