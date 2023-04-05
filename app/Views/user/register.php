<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <h2 class="card-title text-center mb-5"><?php echo $title; ?></h2>

                <form method="post" action="<?= site_url('user/create') ?>">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php endif ?>" id="name" name="name" value="<?= old('name') ?>" required>
                        <?php if (session('errors.name')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.name') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" name="email" value="<?= old('email') ?>" required>
                        <?php if (session('errors.email')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.email') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" name="password" required>
                        <?php if (session('errors.password')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-4">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>