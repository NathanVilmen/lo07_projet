<?php

require_once 'Model.php';

class ModelLien
{
    private $famille_id;
    private $id;
    private $iid1;
    private $iid2;
    private $lien_type;
    private $lien_date;
    private $lien_lieu;

    /**
     * Constructeur de ModelLien
     * @param $famille_id : l'id de la famille
     * @param $id : l'id du lien
     * @param $iid1 : l'id du premer individu
     * @param $iid2 : l'id du second individu
     * @param $lien_type : le type de lien
     * @param $lien_date : la date du lien
     * @param $lien_lieu : le lieu du lien
     */
    public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL) {
        // valeurs nulles si pas de passage de paramètres
        if (!is_null($id)) {
            $this->setFamilleId($famille_id);
            $this->setId($id);
            $this->setIid1($iid1);
            $this->setIid2($iid2);
            $this->setLienType($lien_type);
            $this->setLienDate($lien_date);
            $this->setLienLieu($lien_lieu);
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
    public function getIid1()
    {
        return $this->iid1;
    }

    /**
     * @param mixed|null $iid1
     */
    public function setIid1($iid1)
    {
        $this->iid1 = $iid1;
    }

    /**
     * @return mixed|null
     */
    public function getIid2()
    {
        return $this->iid2;
    }

    /**
     * @param mixed|null $iid2
     */
    public function setIid2($iid2)
    {
        $this->iid2 = $iid2;
    }

    /**
     * @return mixed|null
     */
    public function getLienType()
    {
        return $this->lien_type;
    }

    /**
     * @param mixed|null $lien_type
     */
    public function setLienType($lien_type)
    {
        $this->lien_type = $lien_type;
    }

    /**
     * @return mixed|null
     */
    public function getLienDate()
    {
        return $this->lien_date;
    }

    /**
     * @param mixed|null $lien_date
     */
    public function setLienDate($lien_date)
    {
        $this->lien_date = $lien_date;
    }

    /**
     * @return mixed|null
     */
    public function getLienLieu()
    {
        return $this->lien_lieu;
    }

    /**
     * @param mixed|null $lien_lieu
     */
    public function setLienLieu($lien_lieu)
    {
        $this->lien_lieu = $lien_lieu;
    }

    /**
     * Fonction qui permet de récupérer dans un tableau tous les liens de la famille d'un individu.
     * @return array|false|null Le tableau de résultats de la requête
     */
    public static function getAll() {
        try {
            $database = Model::getInstance();

            $requete1 = "select * from lien where famille_id = (select id from famille where nom=?)";
            $preparation1 = $database->prepare($requete1);

            $preparation1->execute([$_SESSION["famille"]]);

            $results = $preparation1->fetchAll(PDO::FETCH_CLASS, "ModelLien");
            return $results;
        }
        catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Fonction qui permet de mettre à jour l'id du parents d'un individu.
     * @return array|null Un tableau avec des infos sur le parent ajouté
     */
    public static function update(){
        try{
            $database = Model::getInstance();

            //On cherche le sexe du parent
            $parent = $_GET["parent"];
            $parent = explode(" : ", $parent);
            $nom_parent = $parent[0];
            $prenom_parent = $parent[1];

            $requete_parent = "select id, sexe from individu where nom = :nom and prenom = :prenom";
            $preparation_parent = $database->prepare($requete_parent);
            $preparation_parent->execute([
                'nom' => $nom_parent,
                'prenom' => $prenom_parent,
            ]);
            $tuple1 = $preparation_parent->fetch();
            $parent_id = $tuple1[0];
            $sexe = $tuple1[1];

            //On cherche l'enfant
            $enfant = $_GET["enfant"];
            $enfant = explode(" : ", $enfant);
            $nom_enfant = $enfant[0];
            $prenom_enfant = $enfant[1];

            /*$requete_enfant = "select id from individu where nom = :nom and prenom = :prenom";
            $preparation_enfant = $database->prepare($requete_enfant);
            $preparation_enfant->execute([
                'nom' => $nom_enfant,
                'prenom' => $prenom_enfant,
            ]);
            $tuple2 = $preparation_parent->fetch();
            $enfant_id = $tuple2[0];*/

            if($sexe == "H") {
                $requete_lien = "update individu set pere = :parent_id where nom = :nom and prenom = :prenom";
            }
            else{
                $requete_lien = "update individu set mere = :parent_id where nom = :nom and prenom = :prenom";
            }
            $preparation_lien = $database->prepare($requete_lien);
            $preparation_lien->execute([
                'parent_id' => $parent_id,
                'nom' => $nom_enfant,
                'prenom' => $prenom_enfant,
            ]);
            return array($sexe, $parent_id, $nom_parent, $prenom_parent);
        }
        catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Fonction qui permet d'insérer un lien.
     * @return array|null un tableau avec des infos sur la personne ajoutée
     */
    public static function insert() {
        try {
            $database = Model::getInstance();

            //On cherche le nom et prenom de l'homme
            $homme = $_GET["homme"];
            $homme = explode(" : ", $homme);
            $nom_homme = $homme[0];
            $prenom_homme = $homme[1];

            //On cherche le nom et prenom de la femme
            $femme = $_GET["femme"];
            $femme = explode(" : ", $femme);
            $nom_femme = $femme[0];
            $prenom_femme = $femme[1];

            //recherche de famille_id
            $requete_famille = "select id from famille where nom = ?";
            $preparation_famille = $database->prepare($requete_famille);
            $preparation_famille->execute([$_SESSION["famille"]]);
            $famille_id = $preparation_famille->fetch()["id"];

            //recherche de l'id de l'homme (iid1 dans la table)
            $requete_iid1 = "select id from individu where nom = :nom and prenom = :prenom";
            $preparation_iid1 = $database->prepare($requete_iid1);
            $preparation_iid1->execute([
                'nom' => $nom_homme,
                'prenom' => $prenom_homme
            ]);
            $iid1 = $preparation_iid1->fetch()["id"];

            //recherche de l'id de la femme (iid2 dans la table)
            $requete_iid2 = "select id from individu where nom = :nom and prenom = :prenom";
            $preparation_iid2 = $database->prepare($requete_iid2);
            $preparation_iid2->execute([
                'nom' => $nom_femme,
                'prenom' => $prenom_femme
            ]);
            $iid2 = $preparation_iid2->fetch()["id"];

            //recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from lien";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple
            $query = "insert into lien value (:famille_id, :id, :iid1, :iid2, :lien_type, :lien_date, :lien_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'iid1' => $iid1,
                'iid2' => $iid2,
                'lien_type' => $_GET["type"],
                'lien_date' => $_GET["date"],
                'lien_lieu' => $_GET["lieu"]
            ]);
            return array($famille_id, $iid1, $iid2);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Fonction qui permet de trouver le conjoint d'un individu.
     * @param $famille_id l'id de la famille dont on cherche le conjoint
     * @param $iid l'id de la personne dont on cherche le conjoint
     * @param $sexe : sexe de la personne dont on cherche le conjoint
     * @return array|false|null L'id du mari/femme
     */
    public static function getUnionMarried($famille_id, $iid, $sexe){
        try{
            $database = Model::getInstance();

            // Test si femmme ou Homme. La BDD des liens est organisée pour que l'homme soit en premier (iid1) et
            // la femme en deuxième (iid2). Si c'est un homme, je cherche les iid2, si c'est une femme, je cherche des iid1
            if ($sexe == 'H'){
                /* ids des unions */
                $query6 = "select iid2 from lien where iid1=:iid1 and famille_id=:famille_id and (lien_type='MARIAGE' or lien_type='COUPLE' or lien_type='PACS')";
                $statement = $database->prepare($query6);
                $statement->execute([
                    'famille_id'=>$famille_id,
                    'iid1'=> $iid
                ]);
                $result6=$statement->fetchAll();
                return $result6;
            } else{
                $query7 = "select iid1 from lien where iid2=:iid2 and famille_id=:famille_id and (lien_type='MARIAGE' or lien_type='COUPLE' or lien_type='PACS')";
                $statement = $database->prepare($query7);
                $statement->execute([
                    'famille_id'=>$famille_id,
                    'iid2'=> $iid
                ]);
                $result7=$statement->fetchAll();
                return $result7;
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}