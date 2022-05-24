<?php

namespace Controller;

class CartController extends BaseController
{
    private $viewDir = 'cart' . DIRECTORY_SEPARATOR;

    public function index()
    {
        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . 'index')
        ]);
    }

//    public function dodaj($proizvodsifra, $kolicina = 1, $pizza = false)
//    {
//        $kupacsifra = $_SESSION['autoriziran']->sifra;
//
//        if (Cart::viewNarudzba($kupacsifra) === 0) {
//            Cart::kreiraj($kupacsifra);
//        }
//
//        NarudzbaProizvod::kreiraj();
//        Cart::dodaj(NaruzdbaProizvod);
//
//    }
//
//    public function izbaciizKosarice($proizvodsifra)
//    {
//        $kupacsifra = $_SESSION['autoriziran']->sifra;
//        $narudzbasifra = Cart::viewNarudzba($kupacsifra)->sifra;
//    }
}
