<div class="page-title">Users</div>
<?
//    var_dump(array_filter($_GET['filter']));
?>
<a href="user/add"  class="btn btn-success btn-sm">Add User</a>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th scope="col">
                ID
            </th>
            <th scope="col">
                Login
            </th>
            <th scope="col">
                Name
            </th>
            <th scope="col">
                Surname
            </th>
            <th scope="col">ID Number</th>
            <th scope="col">Birthday</th>
            <th scope="col">Group</th>
            <th scope="col">Author</th>
            <th scope="col">Edit</th>
            <th scope="col">Remove</th>
        </tr>
    <tr>
    <form method="get" name="filter">
        <th scope="col">ID</th>
        <th scope="col">
            <input name="filter[A.login]"
                   class="form-control input-sm"
                   autocomplete="off"
                   value="<?=(isset($_GET['filter']['A.login'])) ? $_GET['filter']['A.login']  : "" ?>">
        </th>
        <th scope="col">
            <input name="filter[people.name]"
                   autocomplete="off"
                   class="form-control input-sm"
                   value="<?=(isset($_GET['filter']['people.name'])) ? $_GET['filter']['people.name']  : "" ?>">
        </th>
        <th scope="col">
            <input name="filter[people.surname]"
                   autocomplete="off"
                   class="form-control input-sm"
                   value="<?=(isset($_GET['filter']['people.surname'])) ? $_GET['filter']['people.surname']  : "" ?>">
        </th>
        <th scope="col">
            <input name="filter[people.identification_number]"
                   autocomplete="off"
                   class="form-control input-sm"
                   value="<?=(isset($_GET['filter']['people.identification_number'])) ? $_GET['filter']['people.identification_number']  : "" ?>">
        </th>
        <th scope="col">
            <input name="filter[people.birthday]"
                   autocomplete="off"
                   type="date"
                   class="form-control input-sm"
                   value="<?=(isset($_GET['filter']['people.birthday'])) ? $_GET['filter']['people.birthday']  : "" ?>">
        </th>
        <th scope="col">
            <select name="filter[A.group_id]" class="form-control input-sm">
                <option value="">Select</option>
            <?

                foreach ($data['user_groups'] as $group){?>
                    <option value="<?=$group['id']?>"
                            <?=(isset($_GET['filter']['A.group_id']))?($_GET['filter']['A.group_id'] == $group['id']) ? "selected" : "" :"" ?>>
                        <?=$group['name']?>
                    </option>
                <?}
            ?>
            </select>
        </th>
        <th scope="col">Author</th>
        <th scope="col">
            <input type="submit" value="Filter" class="btn-sm btn btn-warning">
        </th>
        <th scope="col"><a href="/users/" class="btn-info btn btn-sm">Clear</a></th>
    </form>
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
                    <td><?=\site\app\Utils::formatDate($user["birthday"], "d.m.Y") ?></td>
                    <td><?=$user["group_name"]?></td>
                    <td><?=$user["author_name"]?></td>
                    <td><a href="user/edit/<?=$user['id'] ?>" class="btn btn-info btn-sm">Edit</a></td>
                    <td><a href="user/delete/<?=$user['id'] ?>" class="btn btn-danger btn-sm delete">Delete</a></td>
                </tr>
            <?

            }

        ?>

    </tbody>
</table>


