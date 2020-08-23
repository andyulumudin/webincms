<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = 'user_id';
 
    public function authUser($username = false, $password = false)
    {
        if($username === false){
            return false;
        } else {
            $user = $this->table($this->table)->where('user_account', $username)->first();
            $hash = $user['user_password'];
            if(password_verify($password, $hash)) {
                return $user;
            } else {
                return false;
            }
        }
    } 
 
    public function getUser($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->find($id);
        }   
    } 

    public function insertUser($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateUser($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}