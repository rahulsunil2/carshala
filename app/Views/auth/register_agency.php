<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Register</h2>
            <?= form_open('register') ?>
            <div class="form-group">
                <?= form_label('Name', 'name') ?>
                <?= form_input('name', '', ['class' => 'form-control', 'placeholder' => 'Enter your name']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Email', 'email') ?>
                <?= form_input('email', '', ['class' => 'form-control', 'placeholder' => 'Enter your email']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Password', 'password') ?>
                <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Enter your password']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Confirm Password', 'confirm_password') ?>
                <?= form_password('confirm_password', '', ['class' => 'form-control', 'placeholder' => 'Confirm your password']) ?>
            </div>
            <?= form_submit('submit', 'Register', ['class' => 'btn btn-primary btn-block']) ?>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>