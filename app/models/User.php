<?php

namespace site\app\models;

use site\app\controllers\UserController;

class User extends Model
{
    private static $instance = null;
    private $id;
    private $login;
    private $password;
    private $group_id;
    private $last_login;
    private $authorization_date;
    private $status;
    private $author_id;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function getAllGroups(){
        return $this->db->select("SELECT * FROM user_groups");
    }
    public function addUser($data,$currentUserId){
        $birdthday =  date('Y-m-d', strtotime($data['birdthday']));
        $peopleId = $this->db->insert("
        INSERT INTO
            people
        SET 
            name = '{$data['name']}',
            surname = '{$data['surname']}',
            birthday ='{$birdthday}',
            identification_number = '{$data['identification_number']}'
            ");
        return $this->db->insert("
        INSERT INTO
            users
        SET
            login = '{$data['login']}',
            email = '{$data['email']}',
            status = 'N',
            activated = 'N',
            people_id = {$peopleId},
            author_id = {$currentUserId} 
        ");

    }
    public function getUser($id)
    {
        $user = $this->db->selectOne("
        SELECT
            users.login,
            users.group_id,
            users.authorization_date,
            users.status,
            users.last_login,
            users.author_id,
            people.name,
            people.surname,
            users.email,
            people.birthday,
            people.identification_number
        FROM
            users 
            JOIN people ON users.people_id = people.id 
            JOIN user_groups ON users.group_id = user_groups.id 
        WHERE
            users.id = {$id} 
        ");
        if($user){
            $this->setLogin($user['login']);
            $this->setGroupId($user['group_id']);
            $this->setLastLogin($user['last_login']);
            $this->setAuthorizationDate($user['authorization_date']);
            $this->setStatus($user['status']);
            $this->setAuthorId($user['author_id']);
            return $user;
        }

        return false;


    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->group_id;
    }

    /**
     * @param mixed $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * @param mixed $last_login
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;
    }

    /**
     * @return mixed
     */
    public function getAuthorizationDate()
    {
        return $this->authorization_date;
    }

    /**
     * @param mixed $authorization_date
     */
    public function setAuthorizationDate($authorization_date)
    {
        $this->authorization_date = $authorization_date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @param mixed $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function login($username, $password)
    {
        return $this->db->selectOne("
        SELECT
            users.id,
            users.login,
            users.group_id,
            people.name,
            people.surname,
            people.identification_number,
            user_groups.name as group_name
        FROM
            users 
            JOIN people ON users.people_id = people.id
            JOIN user_groups ON users.group_id = user_groups.id
            WHERE 
                login like '{$username}' AND 
                password like MD5('$password') AND 
                activated = 'Y'
        ");
    }

    public function getList($query ="",$perPage = 10, $page = 1)
    {
        $start = ($page -1) * $perPage;
        $q="SELECT
            A.id ,
            A.login,
            A.email,
            people.name ,
            people.surname ,
            people.identification_number,
            people.birthday,
            user_groups.name as group_name,
            users.login  as author_name
        FROM users A 
            JOIN people on A.people_id = people.id
            JOIN user_groups ON A.group_id = user_groups.id
            JOIN users ON users.id = A.author_id
        WHERE
            A.deleted = 'N'
            {$query}  
        LIMIT {$start}, {$perPage} ";
        echo $q;
        return $this->db->select($q
        );
    }

    public function register($login, $email,  $name, $password): bool
    {
        if ($this->userExist($login)) {
            return false;
        }
        $peopleID = $this->db->insert("
        INSERT INTO 
            people 
        SET 
            name = '{$name}'
           
        ");
        return (bool)$this->db->insert("
        INSERT INTO 
            users
        SET
            people_id = $peopleID,
            login = '{$login}',
            password = MD5('{$password}'),
            status = 'Y',
            activated = 'N',
            email = '{$email}'
            "
        );
    }

    /**
     * Функция проверки существования пользователя
     *
     * @param $login - логин пользователя
     * @return bool - результат операции
     */
    public function userExist($login): bool
    {
        return (bool) !empty($this->db->selectOne("
        SELECT
            login
        FROM
            users
        WHERE
            users.login LIKE '{$login}' "
        ));
    }
    /**
     * Функция удаления существующего пользователя
     *
     * @param $id - идентификатор пользователя
     * @return bool - результат операции
     */
    public function delete($id):bool
    {
        return (bool)  $this->db->update("
        UPDATE 
            users 
        SET 
            deleted = 'Y',
            status = 'N',
            activated = 'N' 
        WHERE 
            id = {$id} 
        ");
    }

    public function getPeopleId($id){
        return $this->db->selectOne("
        SELECT 
            people_id
        FROM 
            users
        WHERE
            users.id = {$id} 
        ")['people_id'];
    }

    public function update($id, $data){
        $this->db->update("
        UPDATE 
            users
        SET 
            login = '{$data['login']}',
            email = '{$data['email']}',
            group_id = {$data['group_id']},
            updated_at = NOW()
        WHERE 
            users.id = {$id}
        ");
        $peopleid = $this->getPeopleId($id);
        $birthday =  date('Y-m-d', strtotime($data['birthday']));
        return $this->db->update("
        UPDATE
            people
        SET 
            name = '{$data['name']}',
            surname = '{$data['surname']}',
            identification_number = '{$data['identification_number']}',
            birthday = '{$birthday}'
        WHERE people.id = {$peopleid}   
        ");

    }

    public function finishRegistration($password, $hash){
        return (bool) ( $this->db->update("
           UPDATE
                users
            SET
                password = '{$password}',
                status = 'Y',
                activated = 'Y'
            WHERE 
                MD5(login) like '{$hash}' 
            LIMIT 1
        "));
    }
    public function isActivated($hash){
        return $this->db->selectOne("
            SELECT 
                login,
                activated,
                status
            FROM 
                users
            WHERE 
                MD5(login) like '{$hash}' 
        ");
    }
    public function activateAccount($hash){
        return (bool) $this->db->update(
            "UPDATE 
                users 
            SET 
                activated = 'Y' 
            WHERE 
                MD5(login) = '{$hash}' LIMIT 1"
        );

    }

}