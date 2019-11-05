<div class="page-title">Edit User</div>
<form method="post" class="auth-form">
    <div class="form-group">
        <label for="exampleInputEmail1">Login</label>
        <input name="login" type="text" class="form-control"  autocomplete="off" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter login">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Name</label>
        <input  name="name" autocomplete="off" type="text" class="form-control" id="exampleInputPassword1" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Surname</label>
        <input autocomplete="off" name="surname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Surname">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input name="login" type="text" class="form-control" autocomplete="off" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Identification Number</label>
        <input autocomplete="off" name="identification_number" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Identification Number">
    </div>
    <div class="form-group">
        <label for="userGroup">User Group</label>
        <select name="group_id"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?
                foreach ($data['user_groups'] as $group){
                 ?>
                    <option value="<?=$group['id']?>" <?=($group['id'] == $data['user']['group_id'] ) ? 'selected' : '' ?>><?=$group['name']?></option>

                <?
                }
            ?>
        </select>
    </div>
    <div class="form-group form-check">
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>
