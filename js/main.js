//ADD NEW PATIENT MODAL
var modal = document.getElementById('modalForm');
var modalBtn = document.getElementById('modalBtn');
var closeBtn = document.querySelector('.closeBtn');
var form = document.querySelector('.formContent')
//var editBtn = document.getElementById('editBtn');

modalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', windowClick);

function openModal(){
    modal.style.display = 'block';
}
function closeModal(){
    modal.style.display = 'none';
}
function windowClick(e){
    if(e.target == modal){
    modal.style.display = 'none';
    }
}

// ms_update_form();

// function ms_update_form(){
//     global $wpdb;
//     $manage_table = $wpdb->prefix.'mbSystem';
//     $ms_results = $wpdb->get_results("SELECT * FROM $manage_table WHERE id = $ms_id");
//     foreach($ms_results as $cols){
        
   
//     ?>
//     <form class="formContent" action="" method="post">
//         <span class="closeBtn">&times;</span>
//         <h2>ADD NEW PATIENT</h2>
//         <label>Full Name</label>
//         <input type="text" id="patient_name" name="patient_name" value="<?php echo $cols->name?>"> 
//         <label>Age</label>
//         <input type="text" id="patient_age" name="patient_age" value="<?php echo $cols->age?>">
//         <label>Gender</label>
//         <select name="patient_gender" value="<?php echo $cols->gender?>">
//             <option>Male</option>
//             <option>Female</option>
//         </select>
//         <input type="submit" name="submit" value="Update" id="savePatient">        
//     </form>
//     <?php
// }

// }
