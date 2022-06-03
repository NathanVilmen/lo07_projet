<?php

require_once 'Model.php';

class ModelIndividu
{
    private $famille_id;
    private $id;
    private $nom;
    private $prenom;
    private $sexe;
    private $pere;
    private $mere;

    /**
     * @param $famille_id l'id de la famille
     */
    public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $mere = NULL, $pere = NULL, $sexe = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->sexe = $sexe;
            $this->pere = $pere;
            $this->mere = $mere;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed|null $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed|null
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed|null $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed|null
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed|null $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed|null
     */
    public function getPere()
    {
        return $this->pere;
    }

    /**
     * @param mixed|null $pere
     */
    public function setPere($pere)
    {
        $this->pere = $pere;
    }

    /**
     * @return mixed|null
     */
    public function getMere()
    {
        return $this->mere;
    }

    /**
     * @param mixed|null $mere
     */
    public function setMere($mere)
    {
        $this->mere = $mere;
    }

    /**
     * @return array|false|null le tableau de résultats de la requete
     */
    public static function getAllFromFamily($nom_famille) {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = (select id from famille where nom = ?)";
            $statement = $database->prepare($query);
            $statement->execute([$nom_famille]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * @param $nom : le nom de l'individu à ajouter
     * @param $prenom : le prénom de l'individu à ajouter
     * @param $sexe : le sexe de l'individu à ajouter
     * @return mixed|null : l'id de l'individu ajouté
     */
    public static function insert($famille, $nom, $prenom, $sexe) {
        try {

            $database = Model::getInstance();

            //Recherche de famille_id correspondant à la famille sélectionnée
            $famille_id=ModelFamille::getIdFamille($famille);

            // Attribution de l'encodage du sexe
            if ($sexe='Masculin')
                $sexe='M';
            else
                $sexe='F';

            //Recherche de l'id à utiliser pour l'insertion
            $id=ModelIndividu::getMaxIdFromFamily($famille_id);
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into individu (famille_id, id, nom, prenom, sexe)value (:famille_id, :id, :nom, :prenom, :sexe)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'sexe'=>$sexe
            ]);
            $results=array($famille_id, $id, $nom, $prenom, $sexe);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * @param $famille_id : l'id de la famille pour laquelle on cherche l'id max
     * @return mixed|null : l'id max de des individus d'une famille
     */
    public static function getMaxIdFromFamily($famille_id){
        try {
            $database = Model::getInstance();
            $query = "select max(id) from individu where famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);

            //Pas sûr pour cette partie là : on veut récupérer juste l'id
            $result=$statement->fetch();
            $id=$result[0];
            echo "id=".$id;
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}