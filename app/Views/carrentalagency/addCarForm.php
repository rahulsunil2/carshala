<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New Car</h1>
            <hr>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?= form_open('/addCar') ?>
            <div class="form-group">
                <label for="vehicle_model">Vehicle Model</label>
                <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" value="<?= old('vehicle_model') ?>" placeholder="Enter vehicle model" autofocus>
                <?php if (isset($validation) && $validation->hasError('vehicle_model')) : ?>
                    <div class="text-danger"><?= $validation->getError('vehicle_model') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="vehicle_number">Vehicle Number</label>
                <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" value="<?= old('vehicle_number') ?>" placeholder="Enter vehicle number">
                <?php if (isset($validation) && $validation->hasError('vehicle_number')) : ?>
                    <div class="text-danger"><?= $validation->getError('vehicle_number') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="seating_capacity">Seating Capacity</label>
                <input type="text" name="seating_capacity" id="seating_capacity" class="form-control" value="<?= old('seating_capacity') ?>" placeholder="Enter seating capacity">
                <?php if (isset($validation) && $validation->hasError('seating_capacity')) : ?>
                    <div class="text-danger"><?= $validation->getError('seating_capacity') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="rent_per_day">Rent per day</label>
                <input type="text" name="rent_per_day" id="rent_per_day" class="form-control" value="<?= old('rent_per_day') ?>" placeholder="Enter rent per day">
                <?php if (isset($validation) && $validation->hasError('rent_per_day')) : ?>
                    <div class="text-danger"><?= $validation->getError('rent_per_day') ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Add Car</button>
            <a href="<?= base_url('cars') ?>" class="btn btn-secondary">Back</a>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>