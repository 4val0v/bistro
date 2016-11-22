<?php
    namespace frontend\components;
    
    class Wall
    {
        public $group_id;
        public function __construct($name)
        {
            $pos=strripos($name, '.com');
            $name=substr($name, $pos+5);
            if(strpos($name, 'club')===0)
                $this->group_id=substr($name,4);
            else 
            {
                $group_id=file_get_contents("https://api.vk.com/method/groups.getById?group_ids=".$name);
                $group_id=json_decode($group_id);
                $this->group_id=$group_id->response[0]->gid;
            }
                
        }
        
        public function getWall()
        {
            $wall = file_get_contents("https://api.vk.com/method/wall.get?owner_id=-".$this->group_id."&count=10"); 
            $wall = json_decode($wall);
            return $wall->response;
        }
        
    }
?>