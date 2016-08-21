<?php

class Viesti extends BaseModel {

    public $id, $ketjuId, $kayttajaId, $sisalto, $paivays, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_sisalto');
    }
    
      public function save() {
        $query = DB::connection()->prepare('INSERT INTO Viesti (ketjuId, kayttajaId, sisalto, paivays) VALUES (:ketjuId, :kayttajaId, :sisalto, :paivays) RETURNING id');
        
        $query->execute(array('ketjuId' => $this->ketjuId, 'kayttajaId' => $this->kayttajaId, 'sisalto' => $this->sisalto, 'paivays' => date("M Y d")));
        
        $row = $query->fetch();
        
        $this->id = $row['id'];
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Viesti');

        $query->execute();

        $rows = $query->fetchAll();
        $viestit = array();

        foreach ($rows as $row) {
            $viestit[] = new Viesti(array(
                'id' => $row['id'],
                'ketjuId' => $row['ketjuid'],
                'kayttajaId' => $row['kayttajaid'],
                'sisalto' => $row['sisalto'],
                'paivays' => $row['paivays']
            ));
        }
        return $viestit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Viesti WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $viesti = new Viesti(array(
                'id' => $row['id'],
                'ketjuId' => $row['ketjuid'],
                'kayttajaId' => $row['kayttajaid'],
                'sisalto' => $row['sisalto'],
                'paivays' => $row['paivays']
            ));
            
            return $viesti;
        }
    }
    
    public static function ketjun_viestit($ketjuId) {
        $query = DB::connection()->prepare('SELECT * FROM Viesti WHERE ketjuid = :ketjuid');
        $query->execute(array('ketjuid' => $ketjuId));
        $rows = $query->fetchAll();
        
        $viestit = array();
        
        foreach($rows as $row) {
            $viestit[] = new Viesti(array(
                'id' => $row['id'],
                'ketjuId' => $row['ketjuid'],
                'kayttajaId' => $row['kayttajaid'],
                'sisalto' => $row['sisalto'],
                'paivays' => $row['paivays']
            ));
        }
        
        return $viestit;
    }
    
    public function validoi_sisalto() {
        $errors = array();
        if ($this->sisalto == '') {
            $errors[] = 'Viesti ei saa olla tyhjä.';
        }
        if (strlen($this->sisalto > 299)) {
            $errors[] = 'Viestin maksimipituus 300 merkkiä.';
        }
        return $errors;
    }

}
