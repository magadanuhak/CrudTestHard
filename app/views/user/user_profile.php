<div class='card card-profile text-center'>
    <img alt='' class='card-img-top' src='https://unsplash.it/340/160?image=354'>
    <div class='card-block'>
        <div class="profile-image">
            <div class="letter">
                <?=mb_substr($data['name'], 0, 1)?>
            </div>
        </div>
        <h4 class='card-title'>
           <?=$data['name']?> <?=$data['surname']?>
            <small><?=$data['email']?></small>
        </h4>
        <ul class='c list-group'>
            <li class="list-group-item">Login : <?=$data['login']?> </li>
           <li class="list-group-item">Identification Number : <?=$data['identification_number']?> </li>
            <li class="list-group-item">Birthday : <?=$data['birthday']?> </li>
        </ul>
    </div>
</div>
