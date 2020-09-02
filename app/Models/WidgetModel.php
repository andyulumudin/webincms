<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class WidgetModel extends Model
{
    protected $table = "widget";
    protected $primaryKey = 'widget_id';
 
    public function getWidget($id = false)
    {
        if($id === false){
            return $this->db->table($this->table)->get()->getResultArray();
        } else {
            return $this->find($id);
        }   
    } 

    public function getList($position = false)
    {
        if($position !== false){
            return $this->db->table($this->table)->where('widget_position', $position)->orderBy('widget_order', 'asc')->get()->getResultArray();
        }
        return false; 
    } 

    public function insertWidget($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateWidget($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteWidget($id)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}