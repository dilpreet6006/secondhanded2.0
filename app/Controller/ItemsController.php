<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController{

    //calling search component, i can add a property array here, that will automatically fill matching properties
    //
    public $components = array('Search');
    public $uses = array('User', 'Item', 'Comment');

    //extending authorize rules of parent appcontroller
    //method called by auth, as per $this->Auth->authorize('controller');
    //gets called when user is logged in and requests a page
    public function isAuthorized($user) {
        //All registered users can  access add and watch.
        if (in_array($this->action, array('add','watch', 'add_comment'))) {
            return true;
        }
        // The owner of a post can edit and delete it
        // line below checks if action requested is edit or delete
        if (in_array($this->action, array('edit', 'delete'))) {
            //$this->request->params['pass'] is the passed parameters at the end of url
            $postId = (int) $this->request->params['pass'][0];
            //isOwnedby() method is defined in Item model
            $this->Item->isOwnedBy($postId, $user['id']);
            if ($this->Item->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
        //if none of the other ones have returned true, then we run parent
        return parent::isAuthorized($user);
    }

    public function index(){
        if($this->Auth->user()) {
            // not sure how to get an array of items with their full respective owners..
            $this->set('user',$this->User->findById($this->Auth->user('id')));
            $this->render('home', 'shruti_basic');
        } else $this->layout = 'landing_layout';
   }

    public function search(){
        //debug($this->Search->search());
        if($this->request->is('post')){
            if(isset($this->request->data['Item']['searchString'])){
                //save searchstring to send it back as a hidden field
                $this->set('searchString',$this->request->data['Item']['searchString']);
            }
            //debug($this->request->data);
            //search array is weird, only searchString is under Item, related probably to half the form being inserted on demand
            //here we attach all the parameters that were submitted to the parameters for the search component
            $this->set('results', $this->Search->search($this->request->data,$this->Auth->user()));
           // debug((array_key_exists('semester', $this->request->data)));
            /*$this->set('results', $this->Search->search(array(
                'searchString' => $this->request->data['Item']['searchString'],
                'semester' =>
                    (isset($this->request->data['semester'])&&($this->request->data['semester'] != ''))
                        ? $this->request->data['semester'] : null,
            )));*/
        }  else $this->set('results', array());
        $this->set('user',$this->User->findById($this->Auth->user('id')));


        $this->layout = 'shruti_basic';
    }

    public function view($id = null){
        //check we have id param
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        //this uses contain to get the author association of comment, and goes all the way to the author of the target comment!
        //recursive 2 achieves this but also gets a massive amount of useless data
        //watchers not included because not listed in contain
        $item = $this->Item->find('first', array(
            'conditions' => array('Item.id' => $id),
            'recursive' => 1,
            //awesome!
            'contain' => array('Owner','Comment.Author','Comment.Target.Author')
        ));
        if ($item) {
            $this->set('item', $item);
        } else throw new NotFoundException(__('Invalid post'));

        $this->set('user',$this->User->findById($this->Auth->user('id')));
        $this->layout = 'shruti_basic';
    }

    public function add(){
        if ($this->request->is('post')){
            if($this->request->data['Item']['Image']['size']) {
                //an image is an array of image data. this function accepts arrays of images (array of arrays)
                $imgArray = array($this->request->data['Item']['Image']);
                $fileOK = $this->uploadFiles('img/files', $imgArray);
                //array returns "urls" if file save successful
                //here we put url in model
                if (array_key_exists('urls', $fileOK)) {
                    // save the url in the form data, (cut off the "img/" beginning of the path")
                    $this->request->data['Item']['img_url'] = substr($fileOK['urls'][0], 4);
                }
            }
            //put currently logged in user as owner_id
            //alias doesnt go here, for some reason, didnt work.
            //tried many ways, this is the only way i found that works
            $this->request->data['Item']['owner_id'] =
                $this->Auth->user('id');
            //attempt so save
            if ($this->Item->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
            //    return $this->redirect(array('action' => 'index'));
        } else $this->Session->setFlash('Could not save Item');
        }
        $this->set('user',$this->User->findById($this->Auth->user('id')));
        $this->layout = 'shruti_basic';
    }

    public function watch(){
        // data received from call below and form in view:
        //'Item' => array('Item' => array((int) 0 => '1'),'User' => array((int) 0 => '3'))
        if ($this->request->is('post')) {
            // we picked 'multiple' = true, so only get one result.
            // here we get the watcher ids and submit a simple array of ids under watchers, instead of objects
            // seems to work fine. when calling the item next time, it gets the whole objects.
            $itemChosen = $this->Item->findById($this->request->data['Item']['Item'][0]);
            $watcherIds = array();
            foreach ($itemChosen['Watcher'] as $watcher){
                array_push($watcherIds,$watcher['id']);
            }
            //check if already in list. if not, include
            if (!in_array($this->request->data['Item']['Watcher'][0],$watcherIds)) {
                array_push($watcherIds, $this->request->data['Item']['Watcher'][0]);
                $itemChosen['Watcher'] = $watcherIds;
                $this->Session->setFlash(__('Watch added.'));
            }
            $this->Item->save($itemChosen);
        }

        //use alias as magic variable for it to work gracefully with forms
        //this gives an array of only id => name
        $this->set('watchers',$this->User->find('list'));
        $this->set('items',$this->Item->find('list'));
    }


public function add_comment($itemId = null, $target = null, $parent_id = null){
    //check we have id param
    if ($this->request->is(array('post', 'put'))){
        if ($itemId) {
            $this->Comment->create();

            $this->Comment->set(array(
                'author_id' => $this->Auth->user('id'),
                'item_id' => $itemId,
                'target_id' => $target,
                'parent_id' => $parent_id,
                'body' => $this->request->data['Comment']['body']
            ));
            $this->Comment->save();
        } else {
            $this->Session->setFlash(__('Comment Failed'));
            return $this->redirect(array(
                'controller' => 'items',
                'action' => 'index'
            ));
        }
        $this->redirect(array(
            'controller' => 'items',
            'action' => 'view',
            $itemId
        ));
    }

    //check item exists
    //if so, pass object to view
   // $item = $this->Item->findById($id);
    //if ($item) {
     //   $this->set('item', $item);
    //} else throw new NotFoundException(__('Invalid post'));
}

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Item->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Item->id = $id;
            if ($this->Item->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {

        //interesting method, can only run this by clicking a button
        //cant type in url
    //    if ($this->request->is('get')) {
    //       throw new MethodNotAllowedException();
    //   }

        if ($this->Item->delete($id)) {
            $this->Session->setFlash(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }
}