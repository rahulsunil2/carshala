<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>Edit Car</h1>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>
        <form method="post" action="/updateCar/<?= $car['id'] ?>">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="vehicle_model">Vehicle Model</label>
                <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" value="<?= $car['vehicle_model'] ?>" required>
            </div>
            <div class="form-group">
                <label for="vehicle_number">Vehicle Number</label>
                <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" value="<?= $car['vehicle_number'] ?>" required>
            </div>
            <div class="form-group">
                <label for="seating_capacity">Seating Capacity</label>
                <input type="number" name="seating_capacity" id="seating_capacity" class="form-control" value="<?= $car['seating_capacity'] ?>" required>
            </div>
            <div class="form-group">
                <label for="rent_per_day">Rent Per Day</label>
                <input type="number" name="rent_per_day" id="rent_per_day" class="form-control" value="<?= $car['rent_per_day'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Car</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>