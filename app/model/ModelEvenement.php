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
     * @return int|mixed|null : l'id de la famille insérée
     */
    public static function insert() {
        try {
            $database = Model::getInstance();

            //On obtient le nom et le prénom de la personne concernée par l'évènement
            //echo "<h1>{$_GET["individu"]}</h1>";
            $individu = $_GET["individu"];
            $individu = explode(" : ", $individu);
            $nom = $individu[0];
            $prenom = $individu[1];

            //echo "<h1>$nom</h1>";
            //echo "<h1>$prenom</h1>";

            //recherche de famille_id
            $requete_famille = "select id from famille where nom = ?";
            $preparation_famille = $database->prepare($requete_famille);
            $preparation_famille->execute([$_SESSION["famille"]]);
            $famille_id = $preparation_famille->fetch()["id"];

            //echo "<h1>f = $famille_id</h1>";

            //recherche de l'id de l'individu (iid dans la table)
            $requete_iid = "select id from individu where nom = :nom and prenom = :prenom";
            $preparation_iid = $database->prepare($requete_iid);
            $preparation_iid->execute([
                'nom' => $nom,
                'prenom' => $prenom
            ]);
            $iid = $preparation_iid->fetch()["id"];
            //echo "<h1>iid = $iid</h1>";

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from evenement";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            //echo "<h1>id = $id</h1>";

            // ajout d'un nouveau tuple;
            $query = "insert into evenement value (:famille_id, :id, :iid, :event_type, :event_date, :event_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'iid' => $iid,
                'event_type' => $_GET["type"],
                'event_date' => $_GET["date"],
                'event_lieu' => $_GET["lieu"]
            ]);
            return array($famille_id, $id, $iid);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * @param $famille_id
     * @param $iid
     * @return array|null Retourne la date et le lieu de naissance
     */
    public static function getBirthInfos($famille_id, $iid){
        try {
            $database = Model::getInstance();

            /* Infos naissance */
            $query1="select event_date, event_lieu from evenement where famille_id=:famille_id and event_type='NAISSANCE' and iid=:iid";
            $statement = $database->prepare($query1);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid'=> $iid
            ]);
            $result=$statement->fetch();

            return array($result[0], $result[1]); //0 => date , 1 => lieu
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * @param $famille_id
     * @param $iid
     * @return array|null Retourne la date et le lieu de décès
     */
    public static function getDeathInfos($famille_id, $iid){
        try{
            $database = Model::getInstance();

            /* Infos décès */
            $query2="select event_date, event_lieu from evenement where famille_id=:famille_id and event_type='DECES' and iid=:iid";
            $statement = $database->prepare($query2);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid'=> $iid
            ]);
            $result=$statement->fetch();

            return array($result[0], $result[1]); //0 => date , 1 => lieu
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}