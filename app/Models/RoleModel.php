<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class RoleModel extends Model
{
    protected $table = "role";
    protected $primaryKey = 'role_id';
 
    public function getRole($id = false)
    {
        if($id === false){
            return $this->db->table($this->table)->get()->getResultArray();
        } else {
            return $this->find($id);
        }   
    } 

    public function getType($type = false)
    {
        if($type !== false){
            return $this->db->table($this->table)->where('role_type', $type)->get()->getResultArray();
        }
        return false;  
    } 

    public function insertRole($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateRole($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteRole($id)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}