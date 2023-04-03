<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Book Car</h1>
    <hr>

    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php } ?>

    <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php } ?>

    <form action="/cars/book/<?= $car['id'] ?>" method="post">
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <div class="form-group">
            <label for="total_rent">Total Rent</label>
            <input type="number" class="form-control" id="total_rent" name="total_rent" required>
        </div>

        <button type="submit" class="btn btn-primary">Book Car</button>
    </form>
</div>
<?= $this->endSection() ?>