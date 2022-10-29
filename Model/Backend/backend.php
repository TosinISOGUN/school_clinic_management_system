<?php
require('../Database/database.php');
require('../../Controller/commonFunctions/functions.php ');
require('../../Controller/Classes/doctor.php');
require('../../Controller/Classes/patient.php');
$doctor = new Doctor();
$patient = new Patient();

if ($_POST['btn_doctor']) {
    $doctor->processDoctorInfo($_POST['name'], $_POST['date_of_birth'], $_POST['phone'], $_POST['email'], $_POST['doctor_type']);
}

if($_POST['btn_patient']){
$patient->processPatientInfo($_POST['name'], $_POST['email'], $_POST['blood_group'], $_POST['genotype'], $_POST['sickness'],$_POST['address'], $_POST['department'], $_POST['program'], $_POST['faculty'], $_POST['age'], $_POST['level']);
}
