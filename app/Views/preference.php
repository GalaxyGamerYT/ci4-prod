<?=$this->extend("layout")?>

<?=$this->section("heading")?>
<h2 class="text-center mt-5">Preferences</h2>
<?=$this->endSection()?>

<?=$this->section("content")?>

<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="<?php echo base_url('/preferences'); ?>" method="post">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="theme_mode" class="col-form-label">Theme Mode</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" aria-label="theme_mode" name="theme_mode" id="theme_mode">
                            <option value="0" <?php if($preferences['theme_mode']=='0'){echo "selected";}?>>Dark mode</option>
                            <option value="1" <?php if($preferences['theme_mode']=='1'){echo "selected";}?>>Light Mode</option>
                            <option value="2" <?php if($preferences['theme_mode']=='2'){echo "selected";}?>>Auto</option>
                            
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?=$this->endSection()?>