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
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
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