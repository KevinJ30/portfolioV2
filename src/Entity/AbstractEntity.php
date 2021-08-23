<?php

namespace App\Entity;

class AbstractEntity {

    /**
     * Retourne les données correspondant au field
     *
     * @param string $field
     * @return mixed
     **/
    public function get(string $field) {
        $methodName = 'get' . ucfirst($field);
        if(method_exists($this, $methodName)) {
            $value =  $this->$methodName();

            if(is_array($value)) {
                return current($value);
            }

            return $value;
        }
    }

}