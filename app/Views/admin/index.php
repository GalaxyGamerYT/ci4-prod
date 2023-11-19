<?=$this->extend("layout")?>

<?=$this->section("heading")?>
<h2 class="text-center mt-5">Admin Panel</h2>
<?=$this->endSection()?>

<?=$this->section("content")?>

<button type="button" class="btn btn-info"><a href="<?php echo base_url('/admin/users'); ?>">Users</a></button>

<?=$this->endSection()?>