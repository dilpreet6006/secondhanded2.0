<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public function beforeFilter() {
        $this->Auth->allow('index', 'view', 'logout', 'search');
    }


    //Basic authorization settings
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'items',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'items',
                'action' => 'index'
            ),
            'authenticate' => array(
                //important section, seems to be the instructions on handling for data
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    //fields specify what these auth variables are called in model
                    'fields' => array(
                        'username' => 'name'
                        //password conforms to default 'password' field
                    )
                )
            ),
            //authorize defines access rights after being logged in.
            //'controller' means the function definition is found in the controllers
            //without authorize enabled, all logged-in users can access all functions
            'authorize' => array('Controller'),
            //this is a workaround to a cakephp bug.
            //bug causes unauthorized redirect to referrer to duplicate the base path, so that it becomes localhost/website/website/controller/action
            //the bug was "fixed" by someone here: https://github.com/cakephp/cakephp/issues/4812
            //but i applied the patch and the problem persist, so this workaround just directs all unauthorized requests to items/index
            'unauthorizedRedirect' => [
                'controller' => 'items',
                'action' => 'index',
                'prefix' => false
            ]
        )
    );

    //this gets called by Auth component. well, auth calls the method extension in the controller, who then calls this one
    //here we only check if they are admin, else they are invalid
    //on controller method we delegate certain access to non admins
    public function isAuthorized($user){
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        return false;
    }

    // got this method off the internet, seems to work fine
    /**
     * uploads files to the server
     * @params:
     *		$folder 	= the folder to upload the files e.g. 'img/files'
     *		$formdata 	= the array containing the form files
     *		$itemId 	= id of the item (optional) will create a new sub folder
     * @return:
     *		will return an array with the success of each file upload
     */
    function uploadFiles($folder, $formdata, $itemId = null) {
        // setup dir names absolute and relative
        $folder_url = WWW_ROOT.$folder;
        $rel_url = $folder;

        // create the folder if it does not exist
        if(!is_dir($folder_url)) {
            mkdir($folder_url);
        }

        // if itemId is set create an item folder
        if($itemId) {
            // set new absolute folder
            $folder_url = WWW_ROOT.$folder.'/'.$itemId;
            // set new relative folder
            $rel_url = $folder.'/'.$itemId;
            // create directory
            if(!is_dir($folder_url)) {
                mkdir($folder_url);
            }
        }

        // list of permitted file types, this is only images but documents can be added
        $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');

        // loop through and deal with the files
        foreach($formdata as $file) {
            // replace spaces with underscores
            $filename = str_replace(' ', '_', $file['name']);
            // assume filetype is false
            $typeOK = false;
            // check filetype is ok
            foreach($permitted as $type) {
                if($type == $file['type']) {
                    $typeOK = true;
                    break;
                }
            }

            // if file type ok upload the file
            if($typeOK) {
                // switch based on error code
                switch($file['error']) {
                    case 0:
                        // check filename already exists
                        if(!file_exists($folder_url.'/'.$filename)) {
                            // create full filename
                            $full_url = $folder_url.'/'.$filename;
                            $url = $rel_url.'/'.$filename;
                            // upload the file
                            $success = move_uploaded_file($file['tmp_name'], $url);
                        } else {
                            // create unique filename and upload file
                            ini_set('date.timezone', 'Europe/London');
                            $now = date('Y-m-d-His');
                            $full_url = $folder_url.'/'.$now.$filename;
                            $url = $rel_url.'/'.$now.$filename;
                            $success = move_uploaded_file($file['tmp_name'], $url);
                        }
                        // if upload was successful
                        if($success) {
                            // save the url of the file
                            $result['urls'][] = $url;
                        } else {
                            $result['errors'][] = "Error uploaded $filename. Please try again.";
                        }
                        break;
                    case 3:
                        // an error occured
                        $result['errors'][] = "Error uploading $filename. Please try again.";
                        break;
                    default:
                        // an error occured
                        $result['errors'][] = "System error uploading $filename. Contact webmaster.";
                        break;
                }
            } elseif($file['error'] == 4) {
                // no file was selected for upload
                $result['nofiles'][] = "No file Selected";
            } else {
                // unacceptable file type
                $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
            }
        }
        return $result;
    }
}
