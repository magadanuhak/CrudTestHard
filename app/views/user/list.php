<div class="page-title">Users</div>
<a href="user/add"  class="btn btn-success">Add User</a>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Login</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">ID Number</th>
            <th scope="col">Birthday</th>
            <th scope="col">Group</th>
            <th scope="col">Author</th>
            <th scope="col">Edit</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($data["users"] as $user){ ?>
                <tr>
                    <th scope="row"><?=$user["id"]?></th>
                    <td><?=$user["login"]?></td>
                    <td><?=$user["name"]?></td>
                    <td><?=$user["surname"]?></td>
                    <td><?=$user["identification_number"]?></td>
                    <td><?=\site\app\Utils::formatDate($user["birthday"], "Y-m-d") ?></td>
                    <td><?=$user["group_name"]?></td>
                    <td><?=$user["author_name"]?></td>
                    <td><a href="user/edit/<?=$user['id'] ?>" class="btn btn-info">Edit</a></td>
                    <td><a href="user/delete/<?=$user['id'] ?>" class="btn btn-danger delete">Delete</a></td>
                </tr>
            <?

            }

        ?>

    </tbody>
</table>


