<?php

class Regions
{
    private $_id;
    private $_nom;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    public function setID($id)
    {
        $id = (int) $id;
        if ($id > 0)
            $this->_id = $id;
    }
    public function setNom($nom)
    {
        if (is_string($nom))
            $this->_nom = $nom;
    }

    public function ID()
    {
        return $this->_id;
    }
    public function Nom()
    {
        return $this->_nom;
    }
}
