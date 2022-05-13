<?php

namespace App\Model;

use Base\AbstractModel;
use Base\Db;
use Illuminate\Database\Eloquent\Model;

class User extends AbstractModel
{
    const GENDER_FEMALE = 2;
    const GENDER_MALE = 1;

    public $table = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $createdAt;
    public $gender;

    public function __construct($data = [])
    {
        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->gender = $data['gender'];
            $this->createdAt = $data['created_at'];
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
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
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
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
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getGenderString(): string
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    /**
     * @param mixed $gender
     */
    public function setGender(int $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function save()
    {

        $db = Db::getInstance();
        $insert = "INSERT INTO users (`name`, `email`, `password`, `gender`) VALUES (
            :name, :email, :password, :gender
        )";
        $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':gender' => $this->getGender()
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    public function delete()
    {
        $db = Db::getInstance();
        $delete = "DELETE FROM users WHERE `id` = :id";
        $db->exec($delete, __METHOD__, [
            ':id' => $this->id,
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    public function updates($id,$name, $email, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        $db = Db::getInstance();
        $insert = "UPDATE users SET name = '$name',email = '$email', password = '$password' WHERE id = '$id'";

        $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':gender' => $this->getGender()
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getByName(string $name): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name";
        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name
        ]);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getPasswordHash(string $password)
    {
        return sha1(',.lskfjl' . $password);
    }

    public static function getAll()
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users ORDER BY id DESC LIMIT 5;";
        $data = $db->fetchAll($select, __METHOD__, [
            ]
        );

        if (!$data) {
            return null;
        }

        return $data;
    }

}