<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Edit Car</h2>

            <?php if (session()->has('errors')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach (session('errors') as $error) : ?>
                        <?= esc($error) ?><br>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('cars/update/' . $car['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="vehicle_model">Vehicle Model</label>
                    <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" value="<?= old('vehicle_model', $car['vehicle_model']) ?>">
                </div>
                <div class="form-group">
                    <label for="vehicle_number">Vehicle Number</label>
                    <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" value="<?= old('vehicle_number', $car['vehicle_number']) ?>">
                </div>
                <div class="form-group">
                    <label for="seating_capacity">Seating Capacity</label>
                    <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" value="<?= old('seating_capacity', $car['seating_capacity']) ?>">
                </div>
                <div class="form-group">
                    <label for="rent_per_day">Rent per day</label>
                    <input type="number" class="form-control" id="rent_per_day" name="rent_per_day" value="<?= old('rent_per_day', $car['rent_per_day']) ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('cars') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>