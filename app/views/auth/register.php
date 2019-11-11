<div class="page-title">Register</div>
<form method="post" action="/auth/register" class="auth-form">
    <div class="form-group">
        <label for="exampleInputEmail1">Login</label>
        <input value="<?=(isset($data['username']))? $data['username'] : ""?>"  name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Login" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input value="<?=(isset($data['name']))? $data['name'] : ""?>" name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input value="<?=(isset($data['email']))? $data['email'] : ""?>"  name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter E-mail" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input value="<?=(isset($data['password']))? $data['password'] : ""?>"  name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Re-type password</label>
        <input value="<?=(isset($data['password_confirmation']))? $data['password_confirmation'] : ""?>"  name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
    </div>
    <div class="form-group form-check">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
