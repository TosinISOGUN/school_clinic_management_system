<?php
class Patient extends Database
{
    //Patience datas 
    public $name;
    public $age;
    public $email;
    public $department;
    public $level;
    public $genotype;
    public $blood_group;
    public $sickness;
    public $address;
    public $faculty;


    //Patience table
    private $patient_table = 'patient';


    //View patience info
    public function patientInfo($condition, $fields = "*", $column = "")
    {
        return $this->lookUp($this->patient_table, $fields, $condition, $column);
    }


    //Count patience info from database
    public function numOfPatientRows($condition)
    {
        return $this->countRows($this->patient_table, "*", $condition);
    }


    //Check if the parameter exist in the database
    public function isExist($condition)
    {
        return $this->numOfPatientRows($condition);
    }

    //Validation for patience info
    public function patientsValidation()
    {
        if (Fun::checkForEmptyInput([$this->name, $this->age, $this->contact, $this->department, $this->matric_no, $this->level, $this->course])) {
            Fun::redirect("../../View/patient.php", "err", "None of the fields must be empty");
            exit;
        }
        Fun::redirect("../../View/patient.php", "success", "Data has been saved");
    }

    public function processPatientInfo($name,$email, $blood_group, $genotype, $sickness,$address, $department, $program, $faculty, $age, $level)
    {
        $this->name = $name;
        $this->email = $email;
        $this->blood_group = $blood_group;
        $this->genotype = $genotype;
        $this->sickness = $sickness;
        $this->address = $address;
        $this->department = $department;
        $this->program = $program;
        $this->age = $age;
        $this->faculty = $faculty;
        $this->level = $level;
        $this->patientsValidation();
        $this->savePatientInfo();
    }

    //Save patience info imto the database
    public function savePatientInfo()
    {
        echo 'name';
        exit;
        return $this->save($this->patient_table, "name='$this->name', email='$this->email', blood_group='$this->blood_group', genotype='$this->genotype', sickness='$this->sickness', address='$this->address', department='$this->department', program='$this->program', faculty='$this->faculty', age='$this->age', level='$this->level'");
    }
}
