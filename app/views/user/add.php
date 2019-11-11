<div class="page-title">Add User</div>
<form method="post" class="auth-form">
    <div class="form-group">
        <label for="exampleInputEmail1">Login</label>
        <input name="login" type="text" class="form-control" value="<?=(isset($data['inputs']['login']))? $data['inputs']['login'] : ""?>"  autocomplete="off" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter login" required>
    </div>
    <div class="form-group">
        <label>Name</label>
        <input  name="name" autocomplete="off" type="text"value="<?=(isset($data['inputs']['name']))? $data['inputs']['name'] : ""?>"  class="form-control"  placeholder="Name" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Surname</label>
        <input autocomplete="off" value="<?=(isset($data['inputs']['surname']))? $data['inputs']['surname'] : ""?>"  name="surname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Surname">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input name="email" type="email" value="<?=(isset($data['inputs']['email']))? $data['inputs']['email'] : ""?>"  class="form-control" autocomplete="off" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Identification Number</label>
        <input autocomplete="off" name="identification_number" value="<?=(isset($data['inputs']['identification_number']))? $data['inputs']['identification_number'] : ""?>"  type="number" class="form-control"aria-describedby="emailHelp" placeholder="Identification Number" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Birdthday</label>
        <input autocomplete="off" name="birdthday" value="<?=(isset($data['inputs']['birthday']))? $data['inputs']['birthday'] : ""?>"  type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Birdthday">
    </div>
    <div class="form-group">
        <label for="userGroup">User Group</label>
        <select name="group_id"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?
                foreach ($data['user_groups'] as $group){
                 ?>
                    <option value="<?=$group['id']?>" <?=(isset($data['inputs']['group_id']))?($group['id'] == $data['inputs']['group_id'])?"Selected" :"" : "" ?>><?=$group['name']?></option>
                <?
                }
            ?>
        </select>
    </div>
    <div class="form-group form-check">
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Add</button>
</form>
