<?php
include('db.php');
if($_POST)
{
    $q = mysql_real_escape_string($_POST['search']);
    $strSQL_Result = mysql_query("SELECT u.ID, u.user_nicename, um2.meta_value as location
FROM wp_users AS u 
LEFT JOIN wp_usermeta AS um1 ON u.ID = um1.user_id 
LEFT JOIN wp_usermeta AS um2 ON u.ID = um2.user_id and um2.meta_key = 'shipping_address_1'
WHERE u.user_nicename like '%$q%' and um1.meta_key = 'wp_user_level' AND um1.meta_value = '2'");
    while($row=mysql_fetch_array($strSQL_Result))
    {
        $nicename   = $row['user_nicename'];
        $location      = $row['location'];
        $b_nicename = '<strong>'.$q.'</strong>';
        $b_location    = '<strong>'.$q.'</strong>';
        $final_nicename = str_ireplace($q, $b_nicename, $nicename);
        $final_location = str_ireplace($q, $b_location, $location);
        ?>
			
            <div class="show" align="left">
                <span class="name"><?php echo $final_nicename; ?></span><br/>
				<span class="name"><?php echo $final_location; ?></span>
            </div>
        <?php
    }

}
?>