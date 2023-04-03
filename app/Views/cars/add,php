<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Car</h3>
                </div>
                <div class="card-body">
                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach (session('errors') as $error) : ?>
                                <p><?= esc($error) ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <?= form_open('/cars/save') ?>

                    <div class="mb-3">
                        <?= form_label('Vehicle Model', 'vehicle_model', ['class' => 'form-label']) ?>
                        <?= form_input('vehicle_model', '', ['class' => 'form-control']) ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Vehicle Number', 'vehicle_number', ['class' => 'form-label']) ?>
                        <?= form_input('vehicle_number', '', ['class' => 'form-control']) ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Seating Capacity', 'seating_capacity', ['class' => 'form-label']) ?>
                        <?= form_input('seating_capacity', '', ['class' => 'form-control']) ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Rent per Day', 'rent_per_day', ['class' => 'form-label']) ?>
                        <?= form_input('rent_per_day', '', ['class' => 'form-control']) ?>
                    </div>

                    <?= form_submit('submit', 'Add Car', ['class' => 'btn btn-primary']) ?>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>