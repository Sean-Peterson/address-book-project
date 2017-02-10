<?php

    class Contact
    {
        private $name;
        private $number;
        private $address;

        function __construct($name, $number, $address)
        {
            $this->name = $name;
            $this->number = $number;
            $this->address = $address;
        }

        function get($property)
        {
            if (property_exists($this, $property)) {
                return $this->$property;
            } else {
                return "That is not a property";
            }
        }

        function set($property, $value)
        {
            if (property_exists($this, $property)){
                $this[$property] = $value;
            } else{
                return "That property does not exist";
            }
        }

        function save()
        {
            array_push($_SESSION['contact_array'], $this);
        }

        static function getAll()
        {
            return $_SESSION['contact_array'];
        }

        static function delete()
        {
            return $_SESSION['contact_array'] = array();
        }

    }
 ?>
