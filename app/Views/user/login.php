<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center align-items-center h-100">
    <div class="col-md-6 col-lg-4">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-body">
                <h2 class="text-center mb-4">Login</h2>
                <form method="post" action="<?= site_url('user/authenticate') ?>">
                    <?= csrf_field() ?>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif ?>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <a href="<?= site_url('user/register/agency') ?>" class="text-decoration-none">Register as Agency</a>
                        <span class="mx-2">|</span>
                        <a href="<?= site_url('user/register/customer') ?>" class="text-decoration-none">Register as Customer</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>