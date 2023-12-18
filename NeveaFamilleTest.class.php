<?php

/**

*

* @version $Id$

* @author Jérémy Bouty - Nevea

* @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License

* @package NEVEA_PLANNER

* @copyright S.A.S. NEVEA

*

*/

class NeveaFamilleTest extends Dcp\Family\Document
{

    public $defaultedit = "FORMATION:EDITNEVEAFAMILLETEST";

    public $defaultview = "FORMATION:VIEWNEVEAFAMILLETEST";


    /**

     * @templateController

     */
    public function viewNeveaFamilleTest()
    {

        $aData = $this->readData();
        $aTest = $this->getArrayRawValue();
        $aColomn = $this->makeColumns();
        $aFile = explode("<BR>",$this->getHtmlAttrValue('nft_ar_file', 2));
        $aImg = explode("<BR>",$this->getHtmlAttrValue('nft_ar_image', 2));
        $aEnum = explode("<BR>",$this->getHtmlAttrValue('nft_ar_enum', 2));
        // var_dump($aTest);

        // Fonction de remplacement de valeur d'un tableau
        /*function changeValueArray($key, &$array)
        {
            for ($index=0; $index < count($array); $index++){
                //var_dump($aImg[$index]);
                $aTest[$index][$key] = $array[$index];
            }
        }*/

        // Remplacement des valeurs de tableau $aTest: source par $aEnum
        for ($index=0; $index < count($aEnum); $index++){
            //var_dump($aImg[$index]);
            $aTest[$index]["nft_ar_enum"] = $aEnum[$index];
        }

        // Remplacement des valeurs de tableau $aTest: source par $aImg
        for ($index=0; $index < count($aTest); $index++){
            //var_dump($aImg[$index]);
            $aTest[$index]["nft_ar_image"] = $aImg[$index];
        }

        // Remplacement des valeurs de tableau $aTest: source par $aFile
        for ($index=0; $index < count($aFile); $index++){
            //var_dump($aImg[$index]);
            $aTest[$index]["nft_ar_file"] = $aFile[$index];
        }
        //var_dump($aTest);

        // Récupère Formated ORM getAttributeValue()
        //var_dump($this->getAttributeValue('nft_ar_array'));
        // $myArray = $this->getAttributeValue('nft_ar_array');

        // Fonction pour changer la valeur d'un tableau avec date
        /*function changeValueArray(&$myArray, $key, $value, $attribut)
        {
            for ($index=0; $index < count($myArray); $index++){
                if ($attribut == 'nft_ar_date') {
                    if ($myArray[$index][$key] == $value) {
                        // Créer une nouvelle instance de la classe DateTime avec la date et l'heure actuelles
                        $date = new DateTime();
                        // Pour définir une date et une heure spécifiques
                        $date->setDate(2027, 01, 31); // Définir la date au 31 janvier 2024
                        $date->setTime(00, 00, 0);   // Définir l'heure à 00:00:00
        
                        $myArray[$index][$attribut] = $date;
                    }
                } else {
                    $myArray[$index][$key] = $value;

                }
            }
        }*/

        // Fonction pour changer la valeur d'un tableau avec date
        function changeValueArrays(&$myArray, $key, $value, $attribut)
        {
            for ($index=0; $index < count($myArray); $index++){
                switch ($attribut) {
                    case "nft_ar_date":
                        if ($myArray[$index][$key] == $value) {
                            // Créer une nouvelle instance de la classe DateTime avec la date et l'heure actuelles
                            $date = new DateTime();
                            // Pour définir une date et une heure spécifiques
                            $date->setDate(2028, 01, 31); // Définir la date au 00 mois année
                            $date->setTime(00, 00, 0);   // Définir l'heure à 00:00:00
            
                            $myArray[$index][$attribut] = $date;
                        }
                        break;
                    default:
                        $myArray[$index][$key] = $value;
                }
            }
        }

        // Appel des fonctions
        changeValueArrays($myArray, 'nft_ar_double', 98.47);
        changeValueArrays($myArray, 'nft_ar_enum', 2, 'nft_ar_date');

        // $this->setAttributeValue('nft_ar_array',$myArray);
        // var_dump($myArray);

        // Donnée brut de DB
        //var_dump($this->getArrayRawValues('nft_ar_array'));

        $urlJs = './FORMATION/Layout/nicolioJs.js';
        $urlCs = './FORMATION/Layout/nicolioCss.css';

        $this->lay->set('isCssJsCustom', false);

            $this->lay->set('myJs', $urlJs);
            $this->lay->set('myCss', $urlCs);
            $this->lay->set('IdDoc', $this->id);
            // var_dump($this->id);
            $this->lay->set('MYARRAY', json_encode($aTest));
            $this->lay->set('MYCOLUMN', json_encode($aColomn));
            // var_dump($aColomn);
            $this->lay->set('MYPIC', json_encode($aImg));
            
            $this->lay->set('idDocumentNeveaFamilleTest', $this->id);

        $html = "<table class='table'><thead><tr><th>Titre</th>
                                        <th>Id</th>
                                        <th>Initid</th>
                                        <th>Révision</th>
                                        <th>Locked</th>
                                        <th>Nombre</th>
                                        </tr>
                                    </thead>";
        foreach($aData as $aDataDetail){
            $html .= "<tr><td>".$aDataDetail["title"]."</td>
                            <td>".$aDataDetail["id"]."</td>
                            <td>".$aDataDetail["initid"]."</td>
                            <td>".$aDataDetail["revision"]."</td>
                            <td>".$aDataDetail["locked"]."</td>
                            <td>".$aDataDetail["nft_int"]."</td>
                        </tr>";
        }
        $html .= "</table>";
        $resp = $this->lay->set('REPONSE_HTML', $html);
        //$error = $this->lay->set('REPONSE_BDD', json_encode($aData));

        //$error = 'toto';

    }

    /**

     * @templateController

     */
    public function editNeveaFamilleTest()
    {

        //TODO

        // Mode création, id = ''

        if($this->id == '')
        {

            $this->lay->set('isNewDoc', true);

            $this->lay->set('fromidDocumentNeveaFamilleTest', $this->fromid);

        }
        else
        {

            $this->lay->set('isNewDoc', false);

            $this->lay->set('idDocumentNeveaFamilleTest', $this->id);

        }

    }

    public function preEdition() 
    {
        //$this->setAttributeValue( 'nft_int', '45');
        // Pour rendre statique l'attribut nft_int en édition
        $this->changeVisibilityAttr('nft_int', 'S');
        // Pour cacher l'attribut nft_date en édition
        $this->changeVisibilityAttr('nft_date', 'H');
    }
 
    public function preConsultation()
    {
        // Pour cacher l'attribut nft_int en consultation
        // $this->changeVisibilityAttr('nft_int', 'H');

        // $aNftArray = $this->getAttributeValue('nft_ar_array');
        // var_dump($aNftArray);
        // var_dump($this->getRawValue("nft_ar_file"));
        
        // $aNftArray = $this->getArrayRawValues('nft_ar_array');
        // foreach ($aNftArray as $key => $aRowNft) {
           
        //     $aInfosFile = explode("|", $aRowNft['nft_ar_file']);
        //     // var_dump($aInfosFile);
        //     $sMimeType = $aInfosFile[0];
        //     $sIdFile = $aInfosFile[1];

        //     if($sMimeType == "text/plain"){
        //         $oVaultFileInfo = Dcp\VaultManager::getFileInfo($sIdFile);
        //         $sCheminFichier = $oVaultFileInfo->path;
        //         $sContenuFichier = file_get_contents($sCheminFichier);
        //         var_dump($oVaultFileInfo, $sCheminFichier, $sContenuFichier);
            
        //     }
             
        //     # code...
        // }
        $aFiles = $this->getArrayRawValues('nft_ar_array');
        $aFile = $aFiles[0]["nft_ar_file"];
        $aFile1 = explode("|", $aFile);
        // Récupérer l'id du file
        $sIdFile = $aFile1[1];
        // Récupérer le chemin du file
        $oVaultFileInfo = Dcp\VaultManager::getFileInfo($sIdFile);
        // var_dump($oVaultFileInfo);
        $sCheminFichier = $oVaultFileInfo->path;
        // Lire le contenu du fichier
        $sContenuFichier = file_get_contents($sCheminFichier);
        // var_dump($sContenuFichier);
        // Diviser le contenu en lignes
        $lignes = explode("\n", $sContenuFichier);

        // Initialiser un tableau pour stocker les données CSV
        $tableau = array();

        // Parcourir chaque ligne et la diviser en valeurs
        foreach ($lignes as $ligne) {
            $donnees = str_getcsv($ligne, ';');
            $tableau[] = $donnees;
        }

        // Supprimer la première ligne (en-tête) si elle contient les noms de colonnes
        $enTete = array_shift($tableau);

        // Afficher le tableau résultant
        // var_dump($tableau);

        /*foreach($tableau as $key => $value)
        {
            echo $key.':<br/>';

            foreach($value as $values)

            echo $values.'<br/>';
            
        }*/

    }

    public function changeVisibilityAttr($attr, $visibility)
    {

        foreach($this->fields as $key => $value)
        {
            // FIXME : cast en string pour contourner gestion chaotique du $key = 0 (en integer) qui passe dans le premier case alors qu'il ne faudrait pas
            $key = (string) $key;

            switch($key)
            {
                // md_fx_module
                case $attr: $this->getAttribute($key)->setVisibility($visibility); break;

                default: break;
            }
        }
 
    }

    public function addNumber()
    {

        $a = 12;
        $b = 5;

        return $a + $b ;

    }

    public function preCreated()
    {

        /*if($this->getAttributeValue('nft_int') != 8) {

            return 'toto';

        } */

        $this->setAttributeValue( 'nft_int', $this->addNumber());

    }

    public function postCreated()
    {

        $this->setAttributeValue('nft_int', $this->addNumber()+10);

        //$this->store();

    }

    public function addDatePerOne()
    {

        /*var_dump(date('YYYY-mm-dd', strtotime(' + 1 day')));

        exit(0);*/
        $date = new \DateTime();
        $date->add(new \DateInterval('P1D'));
        return $date->format('Y-m-d');

    }

    /*public function detectUser()

    {

        $user = getCurrentUser();

        //var_dump($user);

        //exit(0);

        if ($user->login == 'admin') {

            $err = "L\'admin n\'a pas tous les droits";

        }

        return $err;

    }

    public function preDelete()

    {

        return $this->detectUser();

    }*/

    public function postDelete()
    {

        global $action;

        $msg = "La suppression a été faite avec succès !";
        $action->addWarningMsg($msg);

    }

    // Pour récupérer les données dans la table nevea_famille_test
    public function readData()
    {
        $sql = "SELECT title, id, initid, revision, locked, nft_int FROM family.nevea_famille_test";
        $result = array();
        \simpleQuery('', $sql, $result);

        //var_dump($result);

        return $result;
    }

    // Pour récupérer les données sous forme de tableau associatif
    public function getArrayRawValue()
    {
        // $tab = [
        //     ["OrderID" => "27", 
        //     "ShipCountry" => "Belgium",
        //     "ShipCity" => "Tokyo",],
        //     ["OrderID" => "28", 
        //     "ShipCountry" => "Singapore",
        //     "ShipCity" => "Rotterdam",],
        //     ["OrderID" => "29", 
        //     "ShipCountry" => "Germany",
        //     "ShipCity" => "Hamburg",]
        // ];

        // return $tab;
        $data = [];
        $data = $this->getArrayRawValues('nft_ar_array');
        // var_dump($data[1][nft_ar_color]);
        return $data;
            
    }

    public function makeColumn($name, $label){

        $resp = ["field" => $name, "title" => $label];

        return $resp;

    }

    // Pour récupérer les libellés 
    public function makeColumns()
    {
        // $tab = [
        //     ["field" => "nft_ar_money", 
        //     "title" => "labelText"],
        //     ["field" => "labelText", 
        //     "title" => "Time"]
        // ];
        
        // return $tab;
        // var_dump(json_encode($tab));
        $nft_data = $this->attributes->getArrayElements('nft_ar_array');
        // var_dump($nft_data);
        $columns = [];

       foreach($nft_data as $key=> $value)
       {
        // var_dump($key);
        // var_dump($value);

        // var_dump($value->labelText); 

        $column = $this->makeColumn($value->id, $value->labelText);

            array_push($columns, $column);
        
       }

        // var_dump($columns);
      return $columns;
       
    }



    /*

    * Inject a CSS

    */

  /* public function addCSS() {

       global $action;

       $action->parent->addCssRef("FORMATION/Layout/nicolioCss.css");

   }

   public function addJS() {

    global $action;

    $action->parent->addJsRef("FORMATION/Layout/nicolioJs.js");
 
    }

*/

}


?>