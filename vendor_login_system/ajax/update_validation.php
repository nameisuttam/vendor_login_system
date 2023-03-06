<?php
include "../connect.php";
function test_input($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = array();
    $id = test_input(($_POST['id']));
    $vendor_first_name = test_input($_POST['vendor_first_name']);
    $vendor_last_name = test_input($_POST['vendor_last_name']);
    $email = test_input($_POST['email']);
    $mobile = test_input($_POST['mobile']);
    $address = test_input($_POST['address']);
    $gender = test_input($_POST['gender']);
    $alldata = test_input($_POST['hobbies']);
    $business = test_input($_POST['business']);
    $salary = test_input($_POST['salary']);
    $city = test_input($_POST['city']);
    $state = test_input($_POST['state']);
    $date_of_birth = test_input($_POST['date_of_birth']);

    if (empty($vendor_first_name)) {
        $error[] = "First name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $vendor_first_name)) {
            $error[] = "Only letters and white space allowed";
        }
    }
    if (empty($vendor_last_name)) {
        $error[] = "Last name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $vendor_last_name)) {
            $error[] = "Only letters and white space allowed";
        }
    }
    if (empty($email)) {
        $error[] = "Email id is required";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Invalid email format";
        }
    }
    if (empty($mobile)) {
        $error[] = "Mobile Number is required";
    } else {
        if (!preg_match("/^[0-9]{10}+$/", $mobile)) {
            $error[] = "Invalid Number";
        }
    }
    if (empty($address)) {
        $error[] = "Address is required";
    }
    if (empty($gender)) {
        $error[] = "Select gender";
    }
    if (!empty($_POST["hobbie"])) {
        foreach ($_POST["hobbie"] as $alldata) {
            // echo $error . '<br>';
        }
    } else {
        $error[] = "At least Select one hobbie";
    }
    if (empty($business)) {
        $error[] = "Select business required";
    }
    if (empty($salary)) {
        $error[] = "salary is required";
    } else {
        if (!preg_match('/^([0-9_]*)$/i', $salary)){
            $error[] = "Only numbers are allowed";
        }
    }
    if (empty($city)) {
        $error[] = "Please select city";
    } 
    if (empty($state)) {
        $error[] = "Please select state";
    } 
    if(empty($date_of_birth)){
        $error[] = "Please fill the date of birth";
    }
    $count = count($error);
}

if ($count > 0) {
    foreach ($error as $value) {
        echo $value . "<br>";
    }
} else {
        $alldata = implode(',', $_POST['hobbie']);
        $update = "UPDATE `vendor_login_system` SET `vendor_first_name` = '$vendor_first_name', `vendor_last_name` = '$vendor_last_name',`email` = '$email',`mobile` = '$mobile', `address` = '$address', `gender` = '$gender', `hobbies` = '$alldata',`business` = '$business',`salary` = '$salary', `city` = '$city', `state` = '$state', `date_of_birth` = '$date_of_birth' WHERE `id` = '$id'";
        $result = mysqli_query($connect, $update);
        if ($result) {
            echo "<span class='success'>Recored Successfully Updated</span>";
        } else {
            echo mysqli_error($connect);
        }
    }

