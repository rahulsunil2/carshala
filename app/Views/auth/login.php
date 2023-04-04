<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center">Login</h2>
        <form method="post" action="<?= site_url('auth/authenticate') ?>">
            <?= csrf_field() ?>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="text-center mt-3">
                <a href="<?= site_url('auth/register/agency') ?>">Register as Agency</a>
            </div>
            <div class="text-center mt-3">
                <a href="<?= site_url('auth/register/customer') ?>">Register as Customer</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>