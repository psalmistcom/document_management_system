<?php
require_once 'config.php';
class Auth extends Database {

    // registering users 
    public function register($name, $email, $password) {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'pass' => $password]);
        return $stmt;
    }

    //Cehck if user already registers 
    public function alreadyExist($table, $value, $col_check) {
        $sql = "SELECT $col_check FROM $table WHERE $col_check = '$value'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //Existing User Login 
    public function login($email) {
        $sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Current User In Session 
    public function currentUser($email) {
        $sql = "SELECT * FROM users WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function add_Category($uid, $cat_title){
        $sql = "INSERT INTO category (uid, cat_title) VALUES (:uid, :cat_title)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'uid'=>$uid, 
            'cat_title'=>$cat_title
        ]);
        return true;
    }
    public function update_Category($cat_title, $id){
        $sql = "UPDATE category SET cat_title = :cat_title WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id'=>$id, 
            'cat_title'=>$cat_title
        ]);
        return true;
    }

    public function get_all($table){        
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function select_all_condition($table, $conditions, $value, $uid){        
        $sql = "SELECT * FROM $table WHERE uid='$uid' AND $conditions != '$value'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function select_single_condition(){        
        $sql = "SELECT documents.id, documents.doc_name, documents.doc_type, documents.doc_size, documents.doc_cateogory, documents.main_doc, documents.created_at, users.name, users.email FROM documents INNER JOIN users ON documents.uid = users.id WHERE documents.deleted = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function select_single_condition_bin(){        
        $sql = "SELECT documents.id, documents.doc_name, documents.doc_type, documents.doc_size, documents.doc_cateogory, documents.main_doc, documents.created_at, users.name, users.email FROM documents INNER JOIN users ON documents.uid = users.id WHERE documents.deleted = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getCatWithID($id){
        $sql = "SELECT * FROM category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete_category($id){
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

    public function addDocument($uid, $doc_name, $doc_type, $doc_size, $doc_cateogory, $main_doc) {
        $sql = "INSERT INTO documents (uid, doc_name, doc_type, doc_size, doc_cateogory, main_doc) VALUES (:uid, :doc_name, :doc_type, :doc_size, :doc_cateogory, :main_doc)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'uid'=>$uid, 
            'doc_name'=>$doc_name,
            'doc_type'=>$doc_type,
            'doc_size'=>$doc_size,
            'doc_cateogory'=>$doc_cateogory,
            'main_doc'=>$main_doc
        ]);
        return true;
    }

    public function counting_things($table, $condition, $status){
        $sql = "SELECT * FROM $table WHERE $condition = '$status'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        return $count;
    }
    public function counting_rows($table){
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        return $count;
    }
    public function second_counting_things($table, $condition, $status, $conditions, $statuses){
        $sql = "SELECT * FROM $table WHERE $condition = '$status' AND $conditions = '$statuses'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        return $count;
    }
    // Download Doc
    public function download_doc($id){
        $sql = "SELECT * FROM documents WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // trash document
    public function trash_document($id){
        $sql = "UPDATE documents SET deleted = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id'=>$id, 
        ]);
        return true;
    }

    // trash document
    public function restore_document($id){
        $sql = "UPDATE documents SET deleted = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id'=>$id, 
        ]);
        return true;
    }

    //get document with ID
    public function getDocWithID($id){
        $sql = "SELECT * FROM documents WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function currentDocument ($tbl_name, $uid){
        $sql = "SELECT * FROM $tbl_name WHERE uid = $uid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    public function update_document($id, $doc_name, $doc_type, $doc_size, $doc_cateogory, $main_doc) {
        $sql = "UPDATE documents SET doc_name = :doc_name, doc_type = :doc_type, doc_size = :doc_size, doc_cateogory = :doc_cateogory, main_doc = :main_doc WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id'=>$id, 
            'doc_name'=>$doc_name, 
            'doc_type'=>$doc_type, 
            'doc_size'=>$doc_size, 
            'doc_cateogory'=>$doc_cateogory, 
            'main_doc'=>$main_doc
        ]);
        return true;
    }

    // Update user statuses
    public function update_user_states($column, $value, $id){
        $sql = "UPDATE users SET $column = :value WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id'=>$id, 
            'value'=>$value
        ]);
        return true;
    }
    


}
