<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author emmett.newman
 */
class Admin extends User {
    
    private $labelId;

    public function getLabelId() {
        return $this->labelId;
    }

    public function setLabelId($labelId) {
        $this->labelId = $labelId;
    }

}
