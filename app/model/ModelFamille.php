<?php

require_once 'Model.php';

class ModelFamille
{
    private $id;
    private $nom;

    /**
     * COnstructeur de ModelFamille
     * @param $id : l'id de la famille
     * @param $nom : le nom de la famille
     */
    public function __construct($id = NULL, $nom = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->setId($id);
            $this->setNom($nom);
        }
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
     * Fonction qui permet de récupérer tous les individus d'une famille dans un tableau.
     * @return array|false|null le tableau de résultats de la requete
     */
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from famille order by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Fonction qui permet d'unsérer une nouvelle famille.
     * @param $nom : le nom de la famille
     * @return int|mixed|null : l'id de la famille insérée
     */
    public static function insert($nom) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from famille";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into famille value (:id, :nom)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom
            ]);

            //Ajout d'un individu null
            ModelIndividu::createIndividuNull($nom);

            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Fonction qui permet de récupérer tous les noms de la table famille
     * @return array|false|null : le résultat de la requête, soit un tableau des noms des familles
     */
    public static function getAllName() {
        try {
            $database = Model::getInstance();
            $query = "select nom from famille";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    /**
     * Fonction qui permet de récupérer l'id d'une famille.
     * @param $nom : le nom de la famille pour laquelle on veut connaître l'id
     * @return mixed|null : le résultat de la requête, soit l'id de la famille
     */
    public static function getIdFamily($nom){
        try {
            $database = Model::getInstance();
            $query = "select id from famille where nom=:nom";
            $statement = $database->prepare($query);
            $statement->execute([
                'nom'=>$nom
            ]);
            $results = $statement->fetch()["id"];
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}