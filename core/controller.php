<?php
    require_once 'session.php';

    //handle Add new Category Ajax Request
    if(isset($_POST['action']) && $_POST['action'] =='addCategory') {
        // var_dump($_POST);
        unset($_POST['action']);
        $cat_title = $cuser->test_input($_POST['cat_title']);

        if (!empty($cat_title)) {
            if ($cuser->alreadyExist('category', $cat_title, 'cat_title')) {
                echo $cuser->showMessage('Warning', 'This Category already exist');
            }else {                
                $result = $cuser->add_Category($cid, $cat_title);
                if ($result) {
                    echo "categoryAdded";
                }else {
                    echo $cuser->showMessage('danger', 'Something went wrong');
                }
            }
        }else {
            echo $cuser->showMessage('danger', 'some fields are required');            
        }
    }

    // Display Category
    if(isset($_POST['action']) && $_POST['action'] == 'display_category'){
        $output = '';

        $categories = $cuser->get_all('category');
        if ($categories) {
            $output .= '
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Category Title</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            ';

            $i = 1;
            foreach($categories as $category){
                $output .= '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$category['cat_title'].'</td>
                        <td>'.date('F j, Y', strtotime($category['date_added'])).'</td>
                        <td>
                            <a id="'.$category['id'].'" title="Delete Category" href="#" class="deleteCategoryBTN"> <i class="fas fa-trash fa-sm text-danger mr-3"></i></a>
                            <a id="'.$category['id'].'" title="Edit Category" href="#" data-toggle="modal" data-target="#editCategory" class="editCategoryBTN"> <i class="fas fa-edit fa-sm text-success"></i> </a>
                        </td>
                    </tr>
                ';
            }
            echo $output;
        }else{
            echo '<h5 style="padding-left:50px;" class="text-center text-success"> :( You did not have any document category </h5>';
        }
    }


    //Handle Edit Category Ajax Request 
    if(isset($_POST['cat_edit_id'])){
        $id = $_POST['cat_edit_id'];

        $row = $cuser->getCatWithID($id);
        echo json_encode($row);
    }

    //handle Update Category Ajax Request
    if(isset($_POST['action']) && $_POST['action'] =='updateCategory') {
        // var_dump($_POST);
        unset($_POST['action']);
        $id = $cuser->test_input($_POST['id']);
        $cat_title = $cuser->test_input($_POST['update_cat_title']);

        if (!empty($cat_title)) {
            if ($cuser->alreadyExist('category', $cat_title, 'cat_title')) {
                echo $cuser->showMessage('Warning', 'This Category already exist');
            }else {                
                $result = $cuser->update_Category($cat_title, $id);
                if ($result) {
                    echo "categoryUpdated";
                }else {
                    echo $cuser->showMessage('danger', 'Something went wrong');
                }
            }
        }else {
            echo $cuser->showMessage('danger', 'some fields are required');            
        }
    }

    //Handle Delete Category of User 
    if (isset($_POST['cat_del_id'])) {
        $id = $_POST['cat_del_id'];

        $cuser->delete_category($id);
    }
   
 

     //handle Add new Document Ajax Request
     if (isset($_FILES['main_doc'])) {
        $doc_name = $cuser->test_input($_POST['doc_name']);
        $doc_cateogory = $cuser->test_input($_POST['doc_cateogory']);

        $prepare_doc = $_FILES['main_doc']['name'];
        $real_doc_size = $_FILES['main_doc']['size'];
        $doc_size = $real_doc_size / 1024;
        $doc_type = pathinfo($prepare_doc, PATHINFO_EXTENSION);
        
        $main_doc = time() . '_' . $prepare_doc;
        $target = '../assets/docs/' . $main_doc;
        move_uploaded_file($_FILES['main_doc']['tmp_name'], $target);

        if (!empty($doc_name) && !empty($doc_cateogory) && !empty($prepare_doc)) {           
            $result = $cuser->addDocument($cid, $doc_name, $doc_type, $doc_size, $doc_cateogory, $main_doc);
            if ($result) {
                echo "documentAdded";
            }else {
                echo $cuser->showMessage('danger', 'Something went wrong');
            }
        }else {
            echo $cuser->showMessage('danger', 'some fields are required');    
        }
     }

     // Display Document for user
    if(isset($_POST['action']) && $_POST['action'] == 'display_document'){
        $output = '';

        $documents = $cuser->select_all_condition('documents', 'deleted', 1, $cid);
        if ($documents) {
            $output .= '
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Document name</th>
                        <th>Category</th>
                        <th>Document type</th>
                        <th>Document Size</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            ';

            $i = 1;
            foreach($documents as $document){
                $output .= '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$document['doc_name'].'</td>
                        <td>'.$document['doc_cateogory'].'</td>
                        <td style="text-transform: uppercase">'.$document['doc_type'].'</td>
                        <td>'. number_format($document['doc_size'], 2).' kb</td>
                        <td>'.date('F j, Y', strtotime($document['created_at'])).'</td>
                        <td>
                            <a id="'.$document['id'].'" title="Download document" href="#" class="download_doc"> <i class="fas fa-download fa-sm primary-text-color mr-3"></i></a>
                            <a id="'.$document['id'].'" title="Delete document" class="deletedocumentBTN" href="#"> <i class="fas fa-trash fa-sm text-danger mr-3"></i></a>
                            <a id="'.$document['id'].'" title="Edit document" data-toggle="modal" data-target="#editDocument" class="editDocumentBTN" href="#"> <i class="fas fa-edit fa-sm text-success"></i> </a>                            
                        </td>
                    </tr>
                ';
            }
            echo $output;
        }else{
            echo '<h5 style="padding-left:50px;" class="text-center text-success"> :( You did not have any document yet </h5>';
        }
    }


     // Display Document for admin
    if(isset($_POST['action']) && $_POST['action'] == 'display_document_admin'){
        $output = '';

        $documents = $cuser->select_single_condition();
        if ($documents) {
            $output .= '
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>User</th>
                        <th>Document name</th>
                        <th>Category</th>
                        <th>Document type</th>
                        <th>Document Size</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            ';

            $i = 1;
            foreach($documents as $document){
                $output .= '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$document['name'].'</td>
                        <td>'.$document['doc_name'].'</td>
                        <td>'.$document['doc_cateogory'].'</td>
                        <td style="text-transform: uppercase">'.$document['doc_type'].'</td>
                        <td>'. number_format($document['doc_size'], 2).' kb</td>
                        <td>'.date('F j, Y', strtotime($document['created_at'])).'</td>
                        <td>
                            <a id="'.$document['id'].'" title="Download document" href="#" class="download_doc"> <i class="fas fa-download fa-sm primary-text-color mr-3"></i></a>
                            <a id="'.$document['id'].'" title="Delete document" class="deletedocumentBTN" href="#"> <i class="fas fa-trash fa-sm text-danger mr-3"></i></a>
                            <a id="'.$document['id'].'" title="Edit document" data-toggle="modal" data-target="#editDocument" class="editDocumentBTN" href="#"> <i class="fas fa-edit fa-sm text-success"></i> </a>
                        </td>
                    </tr>
                ';
            }
            echo $output;
        }else{
            echo '<h5 style="padding-left:50px;" class="text-center text-success"> :( You did not have any document yet </h5>';
        }
    }

     //Handle Delete Document of User 
     if (isset($_POST['del_doc_id'])) {
        $id = $_POST['del_doc_id'];

        $cuser->trash_document($id);
    }

    //Handle Edit Document Ajax Request 
    if(isset($_POST['document_edit_id'])){
        $id = $_POST['document_edit_id'];

        $row = $cuser->getDocWithID($id);
        echo json_encode($row);
    }

    
    //handle Update Docuemnt Ajax Request
    if (isset($_FILES['update_main_doc'])) {
        unset($_POST['action']);
        // var_dump($_POST);
        // var_dump($_FILES);

        $id = $cuser->test_input($_POST['id']);
        $doc_name = $cuser->test_input($_POST['doc_name']);
        $doc_cateogory = $cuser->test_input($_POST['doc_cateogory']);
        
        $oldImage = $_POST['oldImage'];       
        $folder ='../assets/docs/';

        if (isset($_FILES['update_main_doc']['name']) && ($_FILES['update_main_doc']['name'] != "")) {

            $prepare_doc = $_FILES['update_main_doc']['name'];
            $real_doc_size = $_FILES['update_main_doc']['size'];
            $doc_size = $real_doc_size / 1024;
            $doc_type = pathinfo($prepare_doc, PATHINFO_EXTENSION);
            
            $update_main_doc = time() . '_' . $prepare_doc;
            $target = '../assets/docs/' . $update_main_doc;
            move_uploaded_file($_FILES['update_main_doc']['tmp_name'], $target);
        }else {
            $update_main_doc = $oldImage;
            $doc_type = $_POST['doc_doc_type'];
            $doc_size = $_POST['doc_doc_size'];            
        }

        if (!empty($doc_name) && !empty($doc_cateogory) && !empty($doc_size)) {           
            $result = $cuser->update_document($id, $doc_name, $doc_type, $doc_size, $doc_cateogory, $update_main_doc); 
            if ($result) {
                echo "documentupdated";
            }else {
                echo $cuser->showMessage('danger', 'Something went wrong');
            }
        }else {
            echo $cuser->showMessage('danger', 'some fields are required');    
        }
    }



    // /////////// USERS /////////

     // Display Users
     if(isset($_POST['action']) && $_POST['action'] == 'display_users'){
        $output = '';

        $users = $cuser->get_all('users');
        if ($users) {
            $output .= '
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Date Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            $i = 1;
            foreach($users as $user){
                    if ($user['verified'] === '1') {
                        $verified = '<a id="'.$user['id'].'" class="disApproveUser" title="Disapprove User" href="#"> <i class="fas fa-times fa-sm text-danger"></i> </a>';
                    }else {                        
                        $verified = '<a id="'.$user['id'].'" class="ApproveUser" title="Approve User" href="#"> <i class="fas fa-check fa-sm text-primary"></i> </a>';
                    }
                    if ($user['deleted'] === '1') {
                        $deleted = '<a id="'.$user['id'].'" class="deleteUser" title="Delete User" href="#"> <i class="fas fa-trash fa-sm text-danger mr-3"></i></a>';
                    }else {                        
                        $deleted = '<a id="'.$user['id'].'" class="restoreUser" title="Restore User" href="#"> <i class="fas fa-user fa-sm text-primary mr-3"></i></a>';                        
                    }                
                $output .= '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$user['name'].'</td>
                        <td>'.$user['email'].'</td>
                        <td>'.$user['user_type'].'</td>
                        <td>'.date('F j, Y', strtotime($user['created_at'])).'</td>
                        <td>
                            '.$deleted.'
                            '.$verified.'
                        </td>
                    </tr>
                ';
            }
            echo $output;
        }else{
            echo '<h5 style="padding-left:50px;" class="text-center text-success"> :( You did not have any User </h5>';
        }
    }


    //Handle Delete User 
    if (isset($_POST['del_user_id'])) {
        $id = $_POST['del_user_id'];

        $cuser->update_user_states('deleted', '0', $id);
    }

    //Handle Restore User 
    if (isset($_POST['res_user_id'])) {
        $id = $_POST['res_user_id'];

        $cuser->update_user_states('deleted', '1', $id);
    }
    //Handle disapprove User 
    if (isset($_POST['disapprove_user_id'])) {
        $id = $_POST['disapprove_user_id'];

        $cuser->update_user_states('verified', '0', $id);
    }
    //Handle approve User 
    if (isset($_POST['approve_user_id'])) {
        $id = $_POST['approve_user_id'];

        $cuser->update_user_states('verified', '1', $id);
    }


    // //////////////// BIN ///////////////
         // Display bin Document for user
         if(isset($_POST['action']) && $_POST['action'] == 'display_bin'){
            $output = '';
    
            $documents = $cuser->select_all_condition('documents', 'deleted', 0, $cid);
            if ($documents) {
                $output .= '
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Document name</th>
                            <th>Category</th>
                            <th>Document type</th>
                            <th>Document Size</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
    
                $i = 1;
                foreach($documents as $document){
                    $output .= '
                        <tr>
                            <td>'.$i++.'</td>
                            <td>'.$document['doc_name'].'</td>
                            <td>'.$document['doc_cateogory'].'</td>
                            <td style="text-transform: uppercase">'.$document['doc_type'].'</td>
                            <td>'. number_format($document['doc_size'], 2).' kb</td>
                            <td>'.date('F j, Y', strtotime($document['created_at'])).'</td>
                            <td>
                                <a id="'.$document['id'].'" title="Restore document" class="restoreDocumentBTN" href="#"> <i class="fas fa-check fa-sm text-danger mr-3"></i></a>
                            </td>
                        </tr>
                    ';
                }
                echo $output;
            }else{
                echo '<h5 style="padding-left:50px;" class="text-center text-success"> :( You did not have any bin yet </h5>';
            }
        }


         //Handle Restore Document of User 
     if (isset($_POST['res_bin_id'])) {
        $id = $_POST['res_bin_id'];

        $cuser->restore_document($id);
    }



     // Display bin Document for admin
     if(isset($_POST['action']) && $_POST['action'] == 'display_bin_document'){
        $output = '';

        $documents = $cuser->select_single_condition_bin();
        if ($documents) {
            $output .= '
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>User</th>
                        <th>Document name</th>
                        <th>Category</th>
                        <th>Document type</th>
                        <th>Document Size</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            ';

            $i = 1;
            foreach($documents as $document){
                $output .= '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$document['name'].'</td>
                        <td>'.$document['doc_name'].'</td>
                        <td>'.$document['doc_cateogory'].'</td>
                        <td style="text-transform: uppercase">'.$document['doc_type'].'</td>
                        <td>'. number_format($document['doc_size'], 2).' kb</td>
                        <td>'.date('F j, Y', strtotime($document['created_at'])).'</td>
                        <td>
                            <a id="'.$document['id'].'" title="Restore document" class="restoreDocumentBTN" href="#"> <i class="fas fa-check fa-sm text-danger mr-3"></i></a>
                        </td>
                    </tr>
                ';
            }
            echo $output;
        }else{
            echo '<h5 style="padding-left:50px;" class="text-center text-success"> :( You did not have any bin yet </h5>';
        }
    }
    