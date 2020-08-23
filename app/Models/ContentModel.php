<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ContentModel extends Model
{
    protected $table = "content";
    protected $primaryKey = 'content_id';
 
    public function getContent($type = false, $id = false)
    {
        if($id === false){
            return $this->db->table($this->table)->where('content_type', $type)->get()->getResultArray();
        } else {
            return $this->find($id);
        }   
    } 

    public function insertContent($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateContent($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteContent($id)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}