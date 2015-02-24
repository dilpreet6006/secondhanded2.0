<?php
App::uses('Component', 'Controller');
class SearchComponent extends Component {
    // returns arrays of objects
    /*
     *  searchItems($params = null, $user = null)
     *      $params: array()
     *          "searchString"
     *          "semester"
     */

    /*  NOTES:
     *      expand searchString capabilities
     *      add search fields
     *      write getSuggestions() and searchUsers()
     *
     */

    public function search($params = null, $user = null) {
        //get items model needed to search
        $model = ClassRegistry::init('Item');

        $conditions = array();

        //search array is weird, only searchString is under Item, related probably to half the form being inserted on demand
        //fix array here, maybe this should be fixed for real? maybe not.. doesnt seem to be a real problem
        //$params['searchString'] = $params['Item']['searchString'];

        //now it seems the situation above has changed due to separating the form. they are now all under "items"
        $params = $params['Item'];

        //add search string condition
        if(array_key_exists('searchString', $params)
            && $params['searchString'] != ''){
            $conditions["Item.title LIKE"] = "%".$params['searchString']."%";
        }

        //add semester condition
        if(array_key_exists('semester', $params)
            && $params['semester'] != ''
            && $params['semester'] != 'ANY'){
            $conditions["Item.semester "] = $params['semester'];
        }

        //add field condition
        if(array_key_exists('field', $params)
            && $params['field'] != ''
            && $params['field'] != 'ANY'){
            //$conditions["Item.semester "] = $params['semester'];
        }

        //perform search
        $result = $model->find('all', array('conditions' => $conditions));

        return $result;
    }

    public function getSuggestions($user){
        for($i = 0; $i > count($user['WatchItem']);$i++){

        }
    }
}