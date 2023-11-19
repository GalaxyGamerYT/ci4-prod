<?=$this->extend("layout")?>

<?=$this->section("heading")?>
<h2 class="text-center mt-5"><?= ucfirst($username) ?> Access</h2>
<?=$this->endSection()?>

<?=$this->section("content")?>

<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="<?php echo base_url('/admin/users/'.$username.'/access');?>" method="post">
                <div class="row g-3 align-items-center">
                    <!-- <div class="col-auto"> -->
                        <?php
                            foreach ($searchedPrivileges as $searchedPrivilege => $value) {
                                echo "<div class='form-check form-switch form-check-reverse'>
                                        <label class='form-check-label' for='".$searchedPrivilege."'>"
                                        .ucwords(str_replace('_',' ',$searchedPrivilege))
                                        ."</lable>
                                        <input class='form-check-input' type='checkbox' role='switch' name='".$searchedPrivilege."' id='".$searchedPrivilege."'";
                                        
                                        if($value==1){
                                            echo "checked ";
                                        }
                                        if($privileges[$searchedPrivilege]=="0" or $user_id==session()->get('user_id') or $editable=="0"){
                                            echo "disabled";
                                        }

                                        echo ">
                                    </div>";
                            }
                        ?>
                    <!-- </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?=$this->endSection()?>