<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php print $title; ?></title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
</head>
 <!-- container --> 
  <section class="showcase">
    <div class="container">
      <div class="pb-2 mt-4 mb-2 border-bottom">
      <h2>Tables list</h2>            
        <div class="btn-group">
            <button class='btn btn-info btn-sm btn-add' style="margin-right:0.5rem;">Add New</button>
            <button class='btn btn-info btn-sm' onclick="location.href='<?php echo base_url();?>Auth/logout'">Logout</button>
        </div>
      </div>
      <?php 
        if($this->session->flashdata('true')){
        ?>
          <div class="alert alert-success"> 
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong><?php echo $this->session->flashdata('true'); $this->session->unset_userdata('true');?></strong> 
          </div>
        <?php    
          } else if($this->session->flashdata('err')){
        ?>
            <div class = "alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong><?php echo $this->session->flashdata('err'); $this->session->unset_userdata('err');?></strong> 
            </div>
        <?php } else if($this->session->flashdata('invalid')){?>
          <div class = "alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong><?php echo $this->session->flashdata('invalid'); $this->session->unset_userdata('invalid');?></strong> 
            </div>
        <?php } ?>
        <div class="row"><?php echo validation_errors('<div class="col-12 col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div></div>'); ?></div>
      <div class="row justify-content-center">
      <table width="600" cellspacing="5" cellpadding="5" border="1">
        <tr style="background:#CCC">
            <th>S.No</th>
            <th>ID</th>
            <th>NAME</th>
            <th>MAGENTO_ID</th>
            <th>ACTION</th>
        </tr>
        <?php
            $i=1;
            foreach($data as $row)
            {
              echo "<tr>";
              echo "<td>".$i."</td>";
              echo "<td>".$row->ID."</td>";
              echo "<td>".$row->NAME."</td>";
              echo "<td>".$row->magento_id."</td>";
              echo "<td><a href='#' class='btn btn-info btn-sm btn-edit' data-id='$row->ID' data-name='$row->NAME' data-magento_id='$row->magento_id'><i class='fas fa-edit'></i></a> <a href='#' class='btn btn-info btn-sm btn-delete' data-id='$row->ID'><i class='fas fa-trash-alt'></i></a></td>";
              echo "</tr>";
              $i++;
            }
        ?>
        </table>  
      </div>
    </div>
  </section>

  <!-- Modal Add Data-->
  <form action="<?php print site_url('TablesList/addData');?>" method="post" id="addForm">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>        
        <div class="modal-body">        
          <div class="form-group">
            <label>ID</label>
            <input type="text" class="form-control" name="ID" placeholder="ID" maxlength="2">
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>              
          <div class="form-group">
            <label>Magento ID</label>
            <input type="text" class="form-control" name="magento_id" placeholder="Magento ID" maxlength="2">
          </div>                      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </div>
    </div>
    </div>
  </form>
<!-- End Modal Add Data-->

<!-- Modal Edit Data-->
<form action="<?php print site_url('TablesList/updateData');?>" method="post" id="editForm">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
        <div class="form-group">
          <label>NAME</label>
          <input type="text" class="form-control name" name="name" placeholder="Name">
        </div>            
        <div class="form-group">
          <label>Magento ID</label>
          <input type="text" class="form-control magento_id" name="magento_id" placeholder="Magento ID" maxlength="2">  
        </div>        
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" class="id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </div>
  </div>
  </div>
</form>
<!-- End Modal Edit Data-->

 <!-- Modal Delete Data-->
 <form action="<?php print site_url('TablesList/deleteData');?>" method="post">
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">        
          <h4>Are you sure want to delete this Data?</h4>          
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" class="id">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- End Modal Delete Data-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script src="<?=base_url('application/assets/js/helper.js');?>"></script>

