<?php

require_once 'Model.php';

class ModelEvenement
{
    private $famille_id;
    private $id;
    private $iid;
    private $event_type;
    private $event_date;
    private $event_lieu;

    /**
     * @param $famille_id l'id de la famille
     */
    public function __construct($famille_id = NULL, $id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid = $iid;
            $this->event_type = $event_type;
            $this->event_date = $event_date;
            $this->event_lieu = $event_lieu;
        }
    }

    /**
     * @return mixed|null
     */
    public function getFamilleId()
    {
        return $this->famille_id;
    }

    /**
     * @param mixed|null $famille_id
     */
    public function setFamilleId($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed|null
     */
    public function getIid()
    {
        return $this->iid;
    }

    /**
     * @param mixed|null $iid
     */
    public function setIid($iid)
    {
        $this->iid = $iid;
    }

    /**
     * @return mixed|null
     */
    public function getEventType()
    {
        return $this->event_type;
    }

    /**
     * @param mixed|null $event_type
     */
    public function setEventType($event_type)
    {
        $this->event_type = $event_type;
    }

    /**
     * @return mixed|null
     */
    public function getEventDate()
    {
        return $this->event_date;
    }

    /**
     * @param mixed|null $event_date
     */
    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;
    }

    /**
     * @return mixed|null
     */
    public function getEventLieu()
    {
        return $this->event_lieu;
    }

    /**
     * @param mixed|null $event_lieu
     */
    public function setEventLieu($event_lieu)
    {
        $this->event_lieu = $event_lieu;
    }



    /**
     * @return array|false|null le tableau de résultats de la requete
     */
    public static function getAll() {
        try {
            $database = Model::getInstance();

            /*$requete1 = "select id from famille where nom=?";
            $preparation1 = $database->prepare($requete1);
            $preparation1->execute([$_SESSION["famille"]]);
            $famille_id = $preparation1->fetch()["id"];

            foreach($preparation1 as $row){
                print_r($row);
            }

            echo "<h1>$famille_id</h1>";
            echo "<h1>{$_SESSION["famille"]}</h1>";*/

            $requete2 = "select * from evenement where famille_id = (select id from famille where nom=?)";
            //$preparation2 = $database->prepare($requete2);
            $preparation2 = $database->prepare($requete2);

            $preparation2->execute([$_SESSION["famille"]]);

            $results = $preparation2->fetchAll(PDO::FETCH_CLASS, "ModelEvenement");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * @param $nom : le nom de la famille
     * @return int|mixed|null : l'id de la famille insérée
     */
    public static function insert($nom) {
        try {
            $database = Model::getInstance();

            $individu = $_GET["individu"];
            $individu = implode(" : ", $individu);

            $nom = $individu[0];
            $prenom = $individu[1];

            echo "<h1>$nom</h1>";
            echo "<h1>$prenom</h1>";

            //recherche de famille_id
            $requete_famille = "select id from famille where nom = ?";
            $preparation_famille = $database->prepare($requete_famille);
            $preparation_famille->execute([$nom]);
            $famille_id = $preparation_famille->fetch()["famille_id"];

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from evenement";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into evenement value (:famille_id, :id, :iid, :event_type, :event_date, :event_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid' => $iid,
                'id' => $id,
                'event_type' => $_GET["type"],
                'event_date' => $_GET["date"],
                'event_lieu' => $_GET["lieu"]
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


}