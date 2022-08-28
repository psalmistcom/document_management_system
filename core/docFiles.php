<?php
    require_once 'auth.php';
    $docs = new Auth();

    $docid = "";
    $docuid = "";
    $doc_doc_name = "";
    $main_doc = "";

    $docData = $docs->currentDocument('documents', $cid);
    // var_dump($docData);
    // $docid = $docData['id'];
    // $docuid = $docData['uid'];
    // $doc_doc_name = $docData['doc_name'];
    // $main_doc = $docData['main_doc'];
