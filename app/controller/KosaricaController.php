<?php

class KosaricaController extends AutorizacijaController
{
    private $viewDir = 
    'privatno' . DIRECTORY_SEPARATOR . 
        'kosarica' . DIRECTORY_SEPARATOR;

    public function index()
    {
    //$kosarica= Kosarica::dohvatiNarudzbu($_SESSION['autoriziran']->sifra);
//foreach($kosarica as $proizvod){
       //     $proizvod->priceFormatted=$this->nf->format($proizvod->cijena);
    {
        $this->view->render($this->viewDir . 'index', [
            'css' => $this->cssDir . 'index.css',
            'narudzba' =>$narudzba,
            
        ]);
        
    }
    }
   
      
        //u bazu na narudžbu dodati atribut zavrseno boolean
        // vsifrajeti u bazu postoji li narudzba na kupcu koja ima završeno false
        //ako ima artikl dodati na taj sifra narudzbe 
        //ako nema prvo kreirati novu narudzbu na kupca s završeno false i na tu narudžbu dodati artikl
        //

    public function dodaj($proizvodsifra, $kolicina=1, $pizza=false)
    {
        $kupacsifra = $_SESSION['autoriziran']->sifra;
        if (Kosarica::viewNarudzba($kupacsifra) == null) {
            Kosarica::kreiraj($kupacsifra);
        }
        $narudzbasifra = Kosarica::viewNarudzba($kupacsifra)->sifra; 
              print_r($narudzbasifra);  
        }         
        

    public function izbaciizKosarice($proizvodsifra)
    {
        $kupacsifra = $_SESSION['autoriziran']->sifra;
        $narudzbasifra = Kosarica::viewNarudzba($kupacsifra)->sifra;
    }


        
    

}
