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
     * @param $famille_id : l'id de la famille
     * @param $id : l'id de l'événement
     * @param $iid : l'id de l'individu
     * @param $event_type : le type d'événement
     * @param $event_date : la date de l'événement
     * @param $event_lieu : le lieu de l'événement
     */
    public function __construct($famille_id = NULL, $id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->setFamilleId($famille_id);
            $this->setId($id);
            $this->setIid($iid);
            $this->setEventType($event_type);
            $this->setEventDate($event_date);
            $this->setEventLieu($event_lieu);
        }
    }

    /**
     * @return mixed|null : l'id de la famille
     */
    public function getFamilleId()
    {
        return $this->famille_id;
    }

    /**
     * @param mixed|null $famille_id : l'id de la famille
     */
    public function setFamilleId($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    /**
     * @return mixed : l'id de l'événement
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
     * Fonction qui permet de recueillir tous les événements d'une famille dans un tableau.
     * @return array|false|null : le tableau de résultats de la requete
     */
    public static function getAll() {
        try {
            $database = Model::getInstance();

            $requete2 = "select * from evenement where famille_id = (select id from famille where nom=?)";
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
     * Fonction qui permet d'insérer un nouvel événement.
     * @return array|null : tableau contenant l'id de la famille, l'id de l'événement, l'id de l'individu
     */
    public static function insert() {
        try {
            $database = Model::getInstance();

            //On obtient le nom et le prénom de la personne concernée par l'évènement
            $individu = $_GET["individu"];
            $individu = explode(" : ", $individu);
            $nom = $individu[0];
            $prenom = $individu[1];

            //recherche de famille_id
            $requete_famille = "select id from famille where nom = ?";
            $preparation_famille = $database->prepare($requete_famille);
            $preparation_famille->execute([$_SESSION["famille"]]);
            $famille_id = $preparation_famille->fetch()["id"];

            //recherche de l'id de l'individu (iid dans la table)
            $requete_iid = "select id from individu where nom = :nom and prenom = :prenom";
            $preparation_iid = $database->prepare($requete_iid);
            $preparation_iid->execute([
                'nom' => $nom,
                'prenom' => $prenom
            ]);
            $iid = $preparation_iid->fetch()["id"];

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
     * Fonction qui permet de retourner la date et le lieu de naissance d'un individu.
     * @param $famille_id : l'id de la famille
     * @param $iid : l'id de l'individu
     * @return array|null : Retourne la date et le lieu de naissance
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
     * Fonction qui permet de retourner la date et le lieu de décès d'un individu.
     * @param $famille_id : l'id de la famille
     * @param $iid : l'id de l'individu
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