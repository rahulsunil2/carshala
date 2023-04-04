<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Add Car</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('cars/save') ?>">
                    <div class="form-group">
                        <label for="vehicle_model">Vehicle Model</label>
                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" required>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_number">Vehicle Number</label>
                        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" required>
                    </div>
                    <div class="form-group">
                        <label for="seating_capacity">Seating Capacity</label>
                        <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" required>
                    </div>
                    <div class="form-group">
                        <label for="rent_per_day">Rent per Day</label>
                        <input type="number" class="form-control" id="rent_per_day" name="rent_per_day" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>