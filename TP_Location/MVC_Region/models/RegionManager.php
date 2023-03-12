<?php

class RegionManager extends Model{
    public function getRegion(){
        $this->getBdd();
        return $this->getAll('region','Regions');
    }
}
?>