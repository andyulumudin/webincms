<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class MenuModel extends Model
{
    protected $table = "menu";
    protected $primaryKey = 'menu_id';
 
    public function getMenu($id = false)
    {
        if($id === false){
            return $this->db->table($this->table)->get()->getResultArray();
        } else {
            return $this->find($id);
        }   
    } 

    public function getList($menu = false)
    {
        if($menu !== false){
            return $this->db->table($this->table)->where('role_id', $menu)->orderBy('menu_order', 'asc')->get()->getResultArray();
        }
        return false; 
    } 

    public function getChidls($id = false)
    {
        if($id !== false){
            return $this->db->table($this->table)->where('menu_parent', $id)->get()->getResultArray();
        }
        return false; 
    } 

    public function insertMenu($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateMenu($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteMenu($id)
    {
        $childs = $this->getChidls($id);
        if($childs) {
            foreach($childs as $child) {
                $this->deleteMenu($child['menu_id']);
            }
        }
        return $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}