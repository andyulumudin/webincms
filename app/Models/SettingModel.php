<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class SettingModel extends Model
{
    protected $table = "setting";
    protected $primaryKey = 'setting_name';
 
    public function getSetting($id = false)
    {
        if($id === false){
            return $this->db->table($this->table)->get()->getResultArray();
        } else {
            return $this->find($id);
        }   
    } 

    public function insertSetting($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateSetting($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteSetting($id)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}