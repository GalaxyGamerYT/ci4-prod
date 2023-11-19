<?=$this->extend("layout")?>

<?=$this->section("heading")?>
<h2 class="text-center mt-5">User Privileges</h2>
<?=$this->endSection()?>

<?=$this->section("content")?>

<table class="table">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"><i class="bi bi-person-square"></i></th>
            <th><?=session('username')?></th>
            <th><?=session('email')?></th>
            <th><?=$users[session('user_id')]['created_at']?></th>
            <th><?=$users[session('user_id')]['updated_at']?></th>
            <th><a href="<?php echo base_url('admin/users/'.session('username')); ?>"><i class="bi bi-person-vcard-fill"></i></a></th>
            <th><a href="<?php echo base_url('admin/users/'.session('username').'/access'); ?>"><i class="bi bi-person-lock"></i></a></th>
        </tr>
        <?php
            foreach ($users as $userId => $fields) {
                if($userId!=session('user_id')){
                    echo "<tr>
                        <th scope='row'><i class='bi bi-person-square'></i></th>
                        <th>".$fields['username']."</th>
                        <th>".$fields['email']."</th>
                        <th>".$fields['created_at']."</th>
                        <th>".$fields['updated_at']."</th>
                        <th><a href='".base_url('admin/users/'.$fields['username'])."'><i class='bi bi-person-vcard-fill'></i></a></th>
                        <th><a href='".base_url('admin/users/'.$fields['username'].'/access')."'><i class='bi bi-person-lock'></i></i></a></th>
                        </tr>";
                }
            }
        ?>
    </tbody>
</table>


<?=$this->endSection()?>