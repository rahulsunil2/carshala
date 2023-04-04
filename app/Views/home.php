<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<h1>Welcome to CarShala</h1>
<ul>
    <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
    <li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
    <li><a href="<?php echo base_url('auth/register/agency'); ?>">Register as Agency</a></li>
    <li><a href="<?php echo base_url('auth/register/customer'); ?>">Register as Customer</a></li>
    <li><a href="<?php echo base_url('cars/add'); ?>">Add Car</a></li>
    <li><a href="<?php echo base_url('cars/booked-cars'); ?>">View Booked Cars</a></li>
    <li><a href="<?php echo base_url('customers/bookings'); ?>">View Bookings</a></li>
</ul>
<?= $this->endSection(); ?>