<?php
/*
Plugin Name:  ManagementSystem Plugin
Description: Plugin Development Tutorial
Author: Mamus Eferha
Version: 1.0
*/

if(! defined('ABSPATH')){
    die('Will you get out of here!');
  }
//$user_id = get_current_user_id();

include_once('ms_db.php');

register_activation_hook( plugin_dir_path(__FILE__),'ms_install_table' ); 

function ms_add_scripts(){
    wp_enqueue_style('ms-main-script', plugins_url(). '/managementSystem/css/style.css');
    wp_enqueue_script('ms-main-script', plugins_url().'/managementSystem/js/main.js', array( 'jquery', 'wp-util' ), '0.1.0', true );
  }
add_action('wp_enqueue_scripts', 'ms_add_scripts');

function ms_side_nav(){
?> 
    <div class="wrapper">
        <div class="sidebar">
            <h2>Marginal Value</h2>
            <ul>
                <li><a href="http://127.0.0.1/wordpress/marginal-value/">Dashboard</a></li>
                <li><a href="http://127.0.0.1/wordpress/patients/">Patients</a></li>
                <li><a href="http://127.0.0.1/wordpress/encounters/">Encounter</a></li>
                <li><a href="http://127.0.0.1/wordpress/logout/">Logout</a></li>
            </ul> 
        </div>
        <div class="main_content">      
        </div>
    </div>
<?php
}

function wpb_nav_display(){
    ob_start();
    ms_side_nav();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('sidenavigationbar', 'wpb_nav_display');

function ms_patient_table (){
    //DISPLAY DATA IN HTML TABLE FROM DATABASE
    global $wpdb;
    $manage_table = $wpdb->prefix.'mbSystem';
    $ms_results = $wpdb->get_results("SELECT * FROM $manage_table");
 
?> 
    <div class="top-wrapper">
    <input type="text" id="myInput" placeholder="Search for patient...">
    <button class="btn" id="modalBtn">Add new patient</button>
    </div>
    <div id="modalForm" class="modal">
        <form class="formContent" action="" method="post">
        <span class="closeBtn">&times;</span>
        <h2>ADD NEW PATIENT</h2>
        <label>Full Name</label>
        <input type="text" id="patient_name" name="patient_name"> 
        <label>Age</label>
        <input type="text" id="patient_age" name="patient_age">
        <label>Gender</label>
        <select name="patient_gender">
            <option>Male</option>
            <option>Female</option>
        </select>
        <input type="submit" name="submit" value="Save" id="savePatient">        
    </form>
    </div>    
    <table id="myTable">
        <tr class="header">
            <th style="width:20%;">ID</th>
            <th style="width:20%;">NAME</th>
            <th style="width:20%;">AGE</th>
            <th style="width:20%;">GENDER</th>
            <th style="width:20%;">DELETE</th>
        </tr>
    <?php foreach ( $ms_results as $row ){
        $id = $row->id;
        $name = $row->name;
        $age = $row->age;
        $gender = $row->gender
    ?>
        <tr>
            <td><?php echo $id;?></td>
            <td><a href="<?php echo 'http://127.0.0.1/wordpress/patients/&id=' .$id;?>"</a><?php echo $name;?></td>
            <td><?php echo $age;?></td>
            <td><?php echo $gender;?></td>
        </tr>
    
<?php 
}
?>
 </table>
 <?php
    if ( isset($_GET['id'])){
        include_once('ms_updateForm.php');
    }
 }

function wpb_patient_data(){
    ob_start();
    ms_patient_table();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('patientdata', 'wpb_patient_data');

//INSERT DATA INTO DATABASE
if ( isset( $_POST['submit'] ) && isset($_SERVER['REQUEST_URI'])){

        global $wpdb;
        $manage_table = $wpdb->prefix.'mbSystem';

       $wpdb->insert( $manage_table, array(
            'name' => $_POST['patient_name'], 
            'age' => $_POST['patient_age'],
            'gender' => $_POST['patient_gender'], 
            ),
           array( '%s', '%s', '%s' ) 
       );
       header ('Location: ' . $_SERVER['REQUEST_URI']);
       exit();
    }


