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
     * @param $famille_id l'id de la famille
     */
    public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL) {
        // valeurs nulles si pas de passage de paramètres
        if (!is_null($id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid1 = $iid1;
            $this->iid2 = $iid2;
            $this->lien_type = $lien_type;
            $this->lien_date = $lien_date;
            $this->lien_lieu = $lien_lieu;
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
     * @return array|false|null le tableau de résultats de la requete
     */
    public static function getAll() {
        try {
            $database = Model::getInstance();

            $requete1 = "select * from lien where famille_id = (select id from famille where nom=?)";
            //$preparation1 = $database->prepare($requete1);
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

    public static function update(){
        try{
            $database = Model::getInstance();

            //On cherche le sexe du parent
            $parent = $_GET["parent"];
            $parent = explode(" : ", $parent);
            $nom_parent = $parent[0];
            $prenom_parent = $parent[1];

            $requete_parent = "select sexe, id from individu where nom = :nom and prenom = :prenom";
            $preparation_parent = $database->prepare($requete_parent);
            $preparation_parent->execute([
                'nom' => $nom_parent,
                'prenom' => $prenom_parent,
            ]);
            $tuple = $preparation_parent->fetch();
            $sexe = $tuple[0];
            $parent_id = $tuple[1];
            //echo "<h1>sexe = $sexe</h1>";
            //echo "<h1>parent_id = $parent_id</h1>";

            if($sexe == "H") {
                $requete_lien = "update individu set pere = :parent_id where nom = :nom and prenom = :prenom";
            }
            else{
                $requete_lien = "update individu set mere = :parent_id where nom = :nom and prenom = :prenom";
            }
            $preparation_lien = $database->prepare($requete_lien);
            $preparation_lien->execute([
                'parent_id' => $parent_id,
                'nom' => $nom_parent,
                'prenom' => $prenom_parent,
            ]);
            return array($sexe, $parent_id, $nom_parent, $prenom_parent);
        }
        catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}