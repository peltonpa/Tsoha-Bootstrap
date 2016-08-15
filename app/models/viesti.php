<?php

class Viesti extends BaseModel {

    public $id, $kayttajaId, $alueId, $sisalto, $paivays, $otsikko;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Viesti');

        $query->execute();

        $rows = $query->fetchAll();
        $viestit = array();

        foreach ($rows as $row) {
            $viestit[] = new Viesti(array(
                'id' => $row['id'],
               // 'kayttajaId' => $row['kayttajaId'],
              //  'alueId' => $row['alueId'],
                'sisalto' => $row['sisalto'],
                'paivays' => $row['paivays'],
                'otsikko' => $row['otsikko']
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
               // 'kayttajaId' => $row['kayttajaId'],
                //'alueId' => $row['alueId'],
                'sisalto' => $row['sisalto'],
                'paivays' => $row['paivays'],
                'otsikko' => $row['otsikko']
            ));

            return $viesti;
        }
    }

}