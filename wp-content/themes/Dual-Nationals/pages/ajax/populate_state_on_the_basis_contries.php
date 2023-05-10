<?php 
if(count($result_state) >0){?>
 <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
<select id="state" name="mepr_address_state">
    <option value="">Select state</option>
    <?php
 foreach ($result_state as $key => $value) {
    $cou= get_user_meta(get_current_user_id(),'mepr-address-country',true);
    $selected = (isset($selected_state) && $selected_state ==  $value->name) ? 'selected' : ''; ?>
    <option value="<?php echo $value->name;?>" iso2="<?php echo $value->id;?>" <?php echo  $selected;?>>
        <?php echo $value->name;?></option>
    <?php  } ?>
</select>
<?php
}else{?>
<p classs="No_Country">No states of this Country</p>
<input type="hidden" name="mepr_address_state" value="No states of this Country">
<?php
}
?>