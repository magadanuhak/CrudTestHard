<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://my.md/assets/css/default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <title>Hello, world!</title>
</head>
<body>

<nav class=" header  navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
      <a class="navbar-brand" href="#">MY.MD</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/products">Products</a>
          </li>
            <?
                if(\site\app\core\User::getInstance()->isAdmin()) {
            ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Users</a>
                    </li>
            <?
                }
            ?>
          <li class="nav-item active">
            <a class="nav-link" href="/">
                <strong>
                    <?=(\site\app\core\User::getInstance()->getSession('login')) ?
                        "Hi ".\site\app\core\User::getInstance()->getSession('login') :
                        "";?>
                </strong>
                <span class="sr-only">(current)</span>
            </a>
          </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
          <?
            if(\site\app\core\User::getInstance()->getSession('id')) {
                ?>
                <a href="/auth/logout" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>
                <?
            } else{
                ?>
                <a href="/auth/login" class="btn btn-outline-success my-2 my-sm-0">Login</a>
                <a href="/auth/register" class="btn btn-info my-2 my-sm-0">Register</a>
                <?
            }
          ?>
      </div>
  </div>
</nav>
<section class="container content">
    <?=$viewContent;?>
</section>
<section class=" footer bg-dark text-light p-2 mt-2">
   <div class="container">
       All rights reserved &copy; 2019
   </div>
</section>
<script>
    let deleteButtons = document.querySelectorAll('.delete');
    if(deleteButtons){
        deleteButtons.forEach( function(button) {
            console.log('ok');
            button.addEventListener('click', function (el) {
                if (!confirm('You really want to delete this?')) {
                    el.preventDefault();
                }
            });

        });
    }
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

</body>
</html>
