<div id="black">        

<a href="index.php?page=release&subpage=release" id="arrow"></a>


<h3> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $receive->get_receive_date($id);?> 

<?php if($receive->get_receive_save($id) == 0){
            echo " (Open Transaction)";
          }else{
            echo " (Saved Transaction)";
          }
          ?></h3>
</div>  

<div>
  <?php
    if($release->get_release_save($id) == 0){
  ?>
<a id="add" class="btn-jsactive" onclick="document.getElementById('id01').style.display='block'"></a>
<a id="save" class="btn-jsactive" onclick="document.getElementById('id02').style.display='block'"></a>
      <?php
    }
    ?>
</div>

<div id="subcontent">
    <table id="data-list">
      <tr>
        <th>#</th>
        <th>Product</th>
        <th>Quantity</th>
      </tr>
<?php
$count = 1;
$count = 1;
if($release->list_release_items($id) != false){
foreach($release->list_release_items($id) as $value){
   extract($value);
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><?php echo $product->get_product_name($product_id);?></td>
        <td><?php echo $rel_qty;?></td>
      </tr>
      <tr>
<?php
 $count++;
}
}else{
  echo "No Record Found.";
}
?>
    </table>
</div>


<div id="id01" class="modal">
  <div #id="form-update" class="modal-content">
    <div id="black" class="container">
   
      <h2>Select Product</h2>
      <p>Provide required...</p>

      <form method="POST" id="itemForm" action="processes/process.release.php?action=additem">
      <input type="hidden" id="relid" name="relid" value="<?php echo $id;?>"/>
        <label for="product_id">Product</label>
            <select name="product_id" id="product_id">
            <?php
            $count = 1;
            $count = 1;
            if($product->list_products() != false){
            foreach($product->list_products() as $value){
            extract($value);
            
            ?>
                <option value="<?php echo $product_id;?>"><?php echo $product_name;?></option>
            <?php
            }
          }
            ?>
            </select>
            <label for="qty">Released Quantity</label>
            <input type="number" id="qty" class="input" name="qty" placeholder="Quantity..">
       </form> 
      <div class="clearfix">
      <button class="submitbtn" onclick="itemSubmit()">Release</button>
        <button class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
        
      </div>
      </div>
    </div>
  </div>
</div>
<div id="id02" class="modal">
<form method="POST" id="itemSave" action="processes/process.release.php?action=saveitem">
      <input type="hidden" id="relid" name="relid" value="<?php echo $id;?>"/>
      </form>
      <div #id="form-update" class="modal-content">
    <div id="black" class="container">
      <h2>Save Transaction</h2>
      <p>Are you sure you want to save this transaction?</p>
      <div class="clearfix">
        <button class="confirmbtn" onclick="saveSubmit()">Confirm</button>
        <button class="cancelbtn" onclick="document.getElementById('id02').style.display='none'">Cancel</button>
      </div>
    </div>
    </div>
       
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');
var modal_save = document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }else if(event.target == modal_save){
    modal_save.style.display = "none";
  }
}
function saveSubmit() {
    document.getElementById("itemSave").submit();
  }

function itemSubmit() {
  document.getElementById("itemForm").submit();
}
</script>