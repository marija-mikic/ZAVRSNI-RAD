<?php

class KosaricaController extends AutorizacijaController
{
    private $viewDir = 
    'privatno' . DIRECTORY_SEPARATOR . 
        'kosarica' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }

    
     



   /* public function dodajNovi(){		
      
        
            Narudzba::create((array)$this->smjer);
            //$this->index();
            header('location:' . App::config('url').'smjer/index');
        else{
            $this->view->render($this->viewDir.'novi',[
                'poruka'=>$this->poruka,
                'smjer'=>$this->smjer
            ]);
	}
    */

    public function add(){
        //u bazu na narudžbu dodati atribut zavrseno boolean
        // vidjeti u bazu postoji li narudzba na kupcu koja ima završeno false
        //ako ima artikl dodati na taj id narudzbe 
        //ako nema prvo kreirati novu narudzbu na kupca s završeno false i na tu narudžbu dodati artikl
        //

        if(isset($_POST["add"])){
            if(isset($_SESSION["cart"])){
                $item_array_id = array_column($_SESSION["cart"], "sifra");
                if(!in_array($_GET["sifra"], $item_array_id)){
                    $count = count($_SESSION["cart"]);
                    
                    $item_array = array(
                        'sifra' => $_GET["sifra"],
                        'naziv' => $_POST["naziv"],
                        'cijena' => $_POST["cijena"],
                        'kolicina' => $_POST["kolicina"],
                        
                    );
                    $_SESSION["cart"][$count] = $item_array;
                    echo '<script>window.location="index"</script>';
                } else {					
                    echo '<script>window.location="index"</script>';
                }
            } else {
                $item_array = array(
                    'sifra' => $_GET["sifra"],
                    'naziv' => $_POST["naziv"],
                    'cijena' => $_POST["cijena"],
                    'kolicina' => $_POST["kolicina"]
                );
                $_SESSION["cart"][0] = $item_array;
            }
        }
    }
    
    

}