<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms */
class RoomsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gyms']
        ];
        $this->set('rooms', $this->paginate($this->Rooms));
        $this->set('_serialize', ['rooms']);
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => ['Gyms', 'Lessons']
        ]);
        $this->set('room', $room);
        $this->set('_serialize', ['room']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $room = $this->Rooms->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['gym_id'] = 1;
            
            $room = $this->Rooms->patchEntity($room, $this->request->data);

            if ($this->Rooms->save($room)) {
                debug($room->errors());
                $this->Flash->success('The room has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                debug($room->errors());

                $this->Flash->error('The room could not be saved. Please, try again.');
            }
        }
        $gyms = $this->Rooms->Gyms->find('list', array('conditions' => array('Gyms.id' => '1')));
        $this->set(compact('room', 'gyms'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->data);
            $this->request->data['gym_id'] = 1;
            if ($this->Rooms->save($room)) {
                $this->Flash->success('The room has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The room could not be saved. Please, try again.');
            }
        }
        $gyms = $this->Rooms->Gyms->find('list', ['limit' => 200]);
        $this->set(compact('room', 'gyms'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);
        if ($this->Rooms->delete($room)) {
            $this->Flash->success('The room has been deleted.');
        } else {
            $this->Flash->error('The room could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
