<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class RelationModel extends Model
{
    protected $table = "role_relation";
    protected $primaryKey = 'role_id';
 
    public function getRelation($id = false)
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
            return $this->db->table($this->table)->where('object_type', $type)->get()->getResultArray();
        }
        return false;  
    } 

    public function insertRelation($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateRelation($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteRelation($id)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}