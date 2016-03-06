     <select name="<?php echo $name;?>" id="<?php echo $name;?>" class="input-xlarge">
         <option selected="selected" value="-1"><?php echo $default_value;?></option>
<?php
     foreach ($details as $key => $value) {
          echo '         <option value="'.$key.'">'.$value."</option>\n";
     }
?>
    </select>
