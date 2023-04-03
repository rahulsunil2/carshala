<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Login</h2>
            <?= form_open('login') ?>
            <div class="form-group">
                <?= form_label('Email', 'email') ?>
                <?= form_input('email', '', ['class' => 'form-control', 'placeholder' => 'Enter your email']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Password', 'password') ?>
                <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Enter your password']) ?>
            </div>
            <?= form_submit('submit', 'Login', ['class' => 'btn btn-primary btn-block']) ?>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>