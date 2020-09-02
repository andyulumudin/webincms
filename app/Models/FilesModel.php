<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class FilesModel extends Model
{
    protected $table = "files";
    protected $primaryKey = 'file_id';
 
    public function getFiles($id = false)
    {
        if($id === false){
            return $this->db->table($this->table)->get()->getResultArray();
        } else {
            return $this->find($id);
        }   
    } 

    public function insertFiles($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateFiles($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteFiles($id)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}