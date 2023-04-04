<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<h1>Welcome to CarShala</h1>
<ul>
    <li><a href="<?php echo base_url('cars'); ?>">View Cars</a></li>
    <li><a href="<?php echo base_url('cars/add'); ?>">Add Car</a></li>
    <li><a href="<?php echo base_url('cars/booked-cars'); ?>">View Booked Cars</a></li>
    <li><a href="<?php echo base_url('customers/bookings'); ?>">View Bookings</a></li>
</ul>
<?= $this->endSection(); ?>