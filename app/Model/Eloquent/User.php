<?php

namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read $id
 * @property-read $name
 * @property-read $email
 * @property-read $password
 * @property-read $created_at
 * @property-read $gender
 */

class User extends Model
{
    const GENDER_FEMALE = 2;
    const GENDER_MALE = 1;

    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'created_at',
        'gender'];

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
     * @param mixed $created_at
     */
 /*   public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
*/
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

/*    public function save()
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
    }*/

    public function delete()
    {
        return self::where('id',$this->id)->delete();

   /*     $db = Db::getInstance();
        $delete = "DELETE FROM users WHERE `id` = :id";
        $db->exec($delete, __METHOD__, [
            ':id' => $this->id,
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;*/
    }

    public function updates($id,$name, $email, $password)
    {
        return self::where('id',$this->id)->updateOrInsert(['name' => $this->name, 'email' => $this->email,'password' => $this->password,'gender'=> 1]);

        /*$this->id = $id;
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

        return $id;*/
    }

    public static function getById(int $id): ?self
    {
        return self::query()->find($id);

   /*     $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);
        if (!$data) {
            return null;
        }
        return new self($data);*/
    }

    public static function getByName(string $name): ?self
    {
        return self::query()->where('name','=',$name)->first();
       /* return self::query()->find($name)->get();*/


  /*      $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name";
        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name
        ]);

        if (!$data) {
            return null;
        }

        return new self($data);*/
    }

    public static function getPasswordHash(string $password)
    {
        return sha1(',.lskfjl' . $password);
    }

    public static function getAll()
    {
        return self::query()->limit(10)->offset(0)->orderBy('id','DESC')->get();
       /* $db = Db::getInstance();
        $select = "SELECT * FROM users ORDER BY id DESC LIMIT 5;";
        $data = $db->fetchAll($select, __METHOD__, []);
        if (!$data) {
            return null;
        }
        return $data;*/
    }

}