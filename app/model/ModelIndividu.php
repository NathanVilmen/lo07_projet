<?php

require_once 'Model.php';
require_once 'ModelLien.php';
require_once 'ModelEvenement.php';

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
     * @param $famille_id : l'id de la famille de l'individu
     * @param $id : l'id de l'individu
     * @param $nom : le nom de l'individu
     * @param $prenom : le prenom de l'individu
     * @param $mere : l'id de la mere de l'individu
     * @param $pere : l'id du pere de l'individu
     * @param $sexe : le sexe encodé de l'individu
     */
    public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $mere = NULL, $pere = NULL, $sexe = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->setFamilleId($famille_id);
            $this->setId($id);
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setSexe($sexe);
            $this->setPere($pere);
            $this->setMere($mere);
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
     * @param $nom_famille : le nom de la famille qui nous intéresse
     * @return array|false|null : les individus issus de la famille, sous forme d'instances de ModelIndividu
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
            $famille_id=ModelFamille::getIdFamily($famille);

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

            $result=$statement->fetch();
            $id=$result[0];
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * @param $famille : la famille de l'individu sélectionné
     * @param $individu : l'individu sélectionné, avant traitement
     * @return array|null : les informations de l'individu à transmettre au controller
     */
    public static function getIndividuInfo($famille, $individu){

        try{
            $database = Model::getInstance();

            // On récupère le nom et le prénom de l'individu sélectionné
            $individu = explode(" : ", $individu);
            $nom_individu = $individu[0];
            $prenom_individu = $individu[1];

            //On cherche l'id de l'individu
            $query0="select id, sexe from individu where nom=:nom and prenom=:prenom";
            $statement = $database->prepare($query0);
            $statement->execute([
                'nom'=> $nom_individu,
                'prenom'=> $prenom_individu
            ]);
            $result0=$statement->fetch();
            $iid=$result0[0];
            $sexe=$result0[1];

            //On cherche l'année de naissance, le lieu de naissance, l'année de décès et le lieu de décès
            $famille_id = ModelFamille::getIdFamily($famille);

            /* Infos naissance */
            $info_naissance = ModelEvenement::getBirthInfos($famille_id, $iid);
            $date_naissance=$info_naissance[0];
            $lieu_naissance=$info_naissance[1];

            /* Infos décès */
            $info_deces = ModelEvenement::getDeathInfos($famille_id, $iid);
            $date_deces=$info_deces[0];
            $lieu_deces=$info_deces[1];

            // Recherche des parents
            /* Id des parents */
            $query3 = "select pere, mere from individu where famille_id=:famille_id and nom=:nom and prenom=:prenom";
            $statement = $database->prepare($query3);
            $statement->execute([
                'famille_id' => $famille_id,
                'nom'=> $nom_individu,
                'prenom'=> $prenom_individu

            ]);
            $result3=$statement->fetch();
            $id_pere=$result3[0];
            $id_mere=$result3[1];

            /* Noms des parents */
            $query4 = "select nom, prenom from individu where famille_id=:famille_id and id=:id_pere";
            $statement = $database->prepare($query4);
            $statement->execute([
                'famille_id'=>$famille_id,
                'id_pere'=> $id_pere
            ]);
            $result4=$statement->fetch();
            $nom_pere=$result4[0];
            $prenom_pere=$result4[1];

            $query5 = "select nom, prenom from individu where famille_id=:famille_id and id=:id_mere";
            $statement = $database->prepare($query5);
            $statement->execute([
                'famille_id'=>$famille_id,
                'id_mere'=> $id_mere
            ]);
            $result5=$statement->fetch();
            $nom_mere=$result5[0];
            $prenom_mere=$result5[1];

            // Recherche des unions et des enfants issus de ces unions
            $id_mariees = ModelLien::getUnionMarried($famille_id, $iid, $sexe);

            //Alors si $id_unions est NULL, cela veut bien dire qu'il n'y a pas d'union.

            /* Noms des mariées */
            $noms_mariees=array();
            $prenoms_mariees=array();

            $enfants_mariees = array();  //Tableau des enfants pour chaque union

            $noms_enfants=array();
            $prenoms_enfants=array();

            //id_mariees c'est plusieurs iid1 ou iid2
            foreach($id_mariees as $id){
                //print_r($id);
                //On cherche le nom et le prénom du conjoint
                $query8 = "select nom, prenom from individu where id=:id and famille_id=:famille_id";
                $statement = $database->prepare($query8);
                $statement->execute([
                    'id'=> $id[0],
                    'famille_id'=>$famille_id
                ]);
                $result8=$statement->fetch();
                $noms_mariees[]=$result8[0];
                $prenoms_mariees[]=$result8[1];



                // Recherche des enfants de chaque union
                $query9="select nom, prenom from individu where famille_id=:famille_id and ((pere=:id1 and mere=:id2) or (pere=:id2 and mere=:id1))";
                $statement = $database->prepare($query9);
                $statement->execute([
                    'famille_id'=>$famille_id,
                    'id1'=> $iid,
                    'id2'=> $id[0]
                ]);
                $enfants_mariees[]=$statement->fetchAll();
            }
            return array($nom_individu, $prenom_individu, $date_naissance, $lieu_naissance, $date_deces, $lieu_deces, $nom_pere, $prenom_pere, $nom_mere, $prenom_mere, $noms_mariees, $prenoms_mariees, $enfants_mariees);
        }
        catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}