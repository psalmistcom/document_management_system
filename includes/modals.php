<div class="modal fade" id="addDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="errordocument" class="text-danger"></p>
                <form method="post" id="adddocumentForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doc_name"> Document Name</label>
                                <input type="text" name="doc_name" id="doc_name" class="form-control" required placeholder="Document Title">
                            </div>
                        </div>                            
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doc_cateogory"> Document Category</label>
                                <select name="doc_cateogory" id="doc_cateogory" class="form-control">
                                    <option value=""> Select Document Category</option>                                    
                                    <?php foreach($getCategories as $key => $getCategory): ?>
                                        <option value="<?=$getCategory['cat_title']; ?>"><?=$getCategory['cat_title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="main_doc"> upload Document</label> <br/>
                                <img src="<?= BASE_URL . '/assets/img/no-image-icon-0.jpg'; ?>" id="main_doc_placeholder" style="height: 100px;" alt="">
                                <input type="file" name="main_doc" id="main_doc" value="" style="display: none;">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-bg-primary" id="adddocumentFormBTN"> Add Document</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>                
        </div>
    </div>
</div>

<!-- Edit Document Modal -->
<div class="modal fade" id="editDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="updateErrordocument" class="text-danger"></p>
                <form method="post" id="updateDocumentForm" enctype="multipart/form-data">
                    <input type="hidden" id="docid" name="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doc_name"> Document Name</label>
                                <input type="text" name="doc_name" id="document_name" class="form-control" required placeholder="Document Title">
                            </div>
                        </div>                            
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doc_cateogory"> Document Category</label>
                                <select name="doc_cateogory" id="document_cateogory" class="form-control">
                                    <option value=""> Select Document Category</option>                                    
                                    <?php foreach($getCategories as $key => $getCategory): ?>
                                        <option value="<?=$getCategory['cat_title']; ?>"><?=$getCategory['cat_title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="main_doc" id=""> Update Document</label> <br/>
                                <input type="hidden" name="oldImage" id="doc_file_main">
                                <input type="hidden" name="doc_doc_type" id="doc_doc_type">
                                <input type="hidden" name="doc_doc_size" id="doc_doc_size">                                
                                <input type="file" name="update_main_doc" id="main_doc" value="">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-bg-primary" id="updateDocumentFormBTN"> Update Document</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>                
        </div>
    </div>
</div>




<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="errorcategory" class="text-danger"></p>
                <form method="post" id="addcategoryForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doc_name"> Category Title</label>
                                <input type="text" name="cat_title" id="cat_title" class="form-control" placeholder="eg Finance">
                            </div>
                        </div>                                                    
                        <div class="col-md-12">
                            <div class="">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-bg-primary" id="addcategoryFormBTN"> Add Category</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>                
        </div>
    </div>
</div>

<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Update Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="update_errorcategory" class="text-danger"></p>
                <form method="post" id="updatecategoryForm">
                    <input type="hidden" id="catid" name="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doc_name"> Category Title</label>
                                <input type="text" name="update_cat_title" id="catTitle" class="form-control" placeholder="eg Finance">
                            </div>
                        </div>                                                    
                        <div class="col-md-12">
                            <div class="">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-bg-primary" id="updatecategoryFormBTN"> Update Category</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>                
        </div>
    </div>
</div>



