<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController{

    //default pagination settings for this controller
    //values when this was written are unrelated examples from tutorial.
    //all values here apply to default model (user),
    // to define defaults for another model use:
    //$paginate=array('Post' => array (...),'Author' => array (...));
   /* public $paginate = array(
        'fields' => array('Post.id', 'Post.created'),
        'limit' => 25,
        'order' => array(
            'Post.title' => 'asc'
        ),
        'contain' => array('Article')
    );*/

    public function isAuthorized($user) {

        if (in_array($this->action, array('edit', 'delete'))) {
            //$this->request->params['pass'] is the passed parameters at the end of url
            //checking if requested user for edit is same as logged in user
            if ($this->Auth->user('id') == $this->request->params['pass'][0]) {
                return true;
            }
        }
        //if none of the other ones have returned true, then we run parent
        return parent::isAuthorized($user);
    }

    public function beforeFilter(){
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'delete');
    }

    public function login(){
        if ($this->request->is('post')){
            if($this->Auth->login()) {
                return $this->redirect(array('controller' => 'items'));
            }
            $this->Session->setFlash('Invalid User/Pass');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function add(){
        if ($this->request->is('post')){
            $this->User->create();
            if ($this->User->save($this->request->data)){
                $this->Session->setFlash('The user has been saved');
                return $this->redirect(array('action'=> 'index'));
            } else $this->Session->setFlash('Could not save User');
        }
    }

    public function index(){
        $this->set('users',$this->User->find('all'));
        /*
        //example of recursive callwith parameters (needs containable property on models)
        $this->set('johnAndNotNice',$this->User->find('all',  array(
            //search params for assoc
            //make sure to use alias for contain model, not name
            'contain' => array(
                'WatchItem' => array(
                    'conditions' => array(
                        'description' => 'not nice'
                    )
                )
            ),
            //these conditions apply to User, saying i want john (3)
            'conditions' => array(
                'id'=>3
            )
        ))); */
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //IMAGE NEEDS TO BE RESIZED FOR THUMBNAILS !!!!
            if($this->request->data['User']['Image']['size']) {
                //an image is an array of image data. this function accepts arrays of images (array of arrays)
                $imgArray = array($this->request->data['User']['Image']);
                $fileOK = $this->uploadFiles('img/profile_img', $imgArray);
                //array returns "urls" if file save successful
                //here we put url in model
                if (array_key_exists('urls', $fileOK)) {
                    // save the url in the form data, (cut off the "img/" beginning of the path")
                    $this->request->data['User']['img'] = substr($fileOK['urls'][0], 4);
                }
            }
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        //only if post, otherwise go back (i imagine, havent tested)
      //  $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}