<?=$this->extend("layout")?>

<?=$this->section("heading")?>
<h2 class="text-center mt-5"><?php echo "Welcome ".ucfirst(session('username'));?></h2>
<?=$this->endSection()?>

<?=$this->section("content")?>


<?=$this->endSection()?>