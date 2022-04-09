<?php


class JeloController extends AutorizacijaController
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'jela' . DIRECTORY_SEPARATOR;
    private $nf;
    private $poruka;
    private $jelo;

    public function __construct()
    {
        parent::__construct();
        $this->jelo = new stdClass();
        $this->jelo->naziv='';
        $this->jelo->sastav='';
        $this->jelo->cijena='';
        
    }

    public function index()
    {
        $jela = Jelo::read();
        
        $this->view->render($this->viewDir . 'index',[
        'jela' => $jela,
        'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/jeloindex.css">'
       ]);
    }


    public function view($id = null)
    {
        $jelo = $this->Jelo->get($id, [
            'contain' => ['Narudzba'],
        ]);

        $this->set(compact('jelo'));
    }
	
	
	    public function add()
    {
        $jelo = $this->Jelo->newEmptyEntity();
        if ($this->request->is('post')) {
            $jelo = $this->Jelo->patchEntity($jelo, $this->request->getData());
            if ($this->Jelo->save($jelo)) {
                $this->Flash->success(__('The jelo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jelo could not be saved. Please, try again.'));
        }
        $narudzba = $this->Jelo->Narudzba->find('list', ['limit' => 200])->all();
        $this->set(compact('jelo', 'narudzba'));
    }
	
	
	
	    public function edit($id = null)
    {
        $jelo = $this->Jelo->get($id, [
            'contain' => ['Narudzba'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jelo = $this->Jelo->patchEntity($jelo, $this->request->getData());
            if ($this->Jelo->save($jelo)) {
                $this->Flash->success(__('The jelo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jelo could not be saved. Please, try again.'));
        }
        $narudzba = $this->Jelo->Narudzba->find('list', ['limit' => 200])->all();
        $this->set(compact('jelo', 'narudzba'));
    }
	
	
	
	    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jelo = $this->Jelo->get($id);
        if ($this->Jelo->delete($jelo)) {
            $this->Flash->success(__('The jelo has been deleted.'));
        } else {
            $this->Flash->error(__('The jelo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    }   