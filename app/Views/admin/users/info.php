<?=$this->extend("layout")?>

<?=$this->section("heading")?>
<h2 class="text-center mt-5"><?php echo ucfirst($username)." User Info"; ?><h2>
<?=$this->endSection()?>

<?=$this->section("content")?>

<div class="container align-items-center">
    <?php 
        foreach($user as $field => $value){
            if($field=='username'){
                echo "<p>".ucwords(str_replace('_',' ',$field)).": ".ucfirst($value)."</p>";
            }else{
                echo "<p>".ucwords(str_replace('_',' ',$field)).": ".$value."</p>";
            }
        }
    ?>
    <p>Editable Privileges: <?php echo(($editablePrivileges=="0") ? "False" : "True"); ?></p>
</div>

<?=$this->endSection()?>