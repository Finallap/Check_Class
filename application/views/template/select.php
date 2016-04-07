     <select name="<?php echo $name;?>" id="<?php echo $name;?>" class="input-xlarge">
<?php
	echo '         <option value="-1">'.$default_value."</option>\n";
    foreach ($details as $key => $value)
    {
	    if($select_key==$key)
	    	echo '         <option selected="selected" value="'.$key.'">'.$value."</option>\n";
	    else
	    	echo '         <option value="'.$key.'">'.$value."</option>\n";
    }
?>
    </select>
