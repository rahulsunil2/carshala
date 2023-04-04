<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Car</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('cars/save') ?>">
                    <div class="mb-3">
                        <label for="vehicle_model" class="form-label">Vehicle Model</label>
                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" required>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle_number" class="form-label">Vehicle Number</label>
                        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="seating_capacity" class="form-label">Seating Capacity</label>
                        <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="rent_per_day" class="form-label">Rent per day</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" id="rent_per_day" name="rent_per_day" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle_image" class="form-label">Vehicle Image</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="vehicle_image" name="vehicle_image" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <a href="<?= base_url('cars') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>