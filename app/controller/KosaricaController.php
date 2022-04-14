<?php

class KosaricaController extends AutorizacijaController
{
    private $viewDir = 
    'privatno' . DIRECTORY_SEPARATOR . 
        'kosarica' . DIRECTORY_SEPARATOR;

    public function index()
    {
    $kosarica= Kosarica::dohvatiNarudzbu($_SESSION['autoriziran']->id);
        foreach($kosarica as $proizvod){
            $proizvod->priceFormatted=$this->nf->format($proizvod->cijena);
    {
        $this->view->render($this->viewDir . 'index', [
            'css' => $this->cssDir . 'index.css',
            'narudzba' =>$narudzba,
            'javascript'=>'<script src="'. App::config('url'). 'public/js/custom/removeFromCart.js"></script> '
        ]);
    }
    }
    }
      
        //u bazu na narudžbu dodati atribut zavrseno boolean
        // vidjeti u bazu postoji li narudzba na kupcu koja ima završeno false
        //ako ima artikl dodati na taj id narudzbe 
        //ako nema prvo kreirati novu narudzbu na kupca s završeno false i na tu narudžbu dodati artikl
        //

    public function dodaj($proizvodId, $kolicina=1)
    {
        $proizvodId = $_SESSION['autoriziran']->id;
        if (Kosarica::viewNarudzba($kupacId) == null) {
            Kosarica::kreiraj($kupacId);
        }
        $narudzbaId = Kosarica::viewNarudzba($kupacId)->id;
    }

    public function izbaciizKosarice($proizvodId)
    {
        $kupacId = $_SESSION['autoriziran']->id;
        $narudzbaId = Kosarica::viewNarudzba($kupacId)->id;
    }


        
    

}