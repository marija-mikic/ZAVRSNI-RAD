<?php

class KosaricaController extends AutorizacijaController
{
    private $viewDir = 'kosarica' . DIRECTORY_SEPARATOR;

    public function index()
    {
        {
            $this->view->render($this->viewDir . 'index', [
                'narudzba' => $narudzba,
            ]);
        }
    }

    public function dodaj($proizvodsifra, $kolicina = 1, $pizza = false)
    {
        $kupacsifra = $_SESSION['autoriziran']->sifra;

        if (Kosarica::viewNarudzba($kupacsifra) === 0) {
            Kosarica::kreiraj($kupacsifra);
        }

        NarudzbaProizvod::kreiraj();
        Kosarica::dodaj(NaruzdbaProizvod);

    }

    public function izbaciizKosarice($proizvodsifra)
    {
        $kupacsifra = $_SESSION['autoriziran']->sifra;
        $narudzbasifra = Kosarica::viewNarudzba($kupacsifra)->sifra;
    }
}
