<?php

declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 

// Here when a user write a wrong data we just let the correct data in it's place and remove the wrong  
function signup_inputs() {

            //1- Knowing if the username is already wrote in the box and it's not taken before (not an error)
            if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])
                 && !isset($_SESSION["errors_signup"]["is_username_invalid"])) {
                // Right data stay in the box and wrong vanished to write it again
                echo    '<div class="mb-3"> 
                            <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username.."
                                    value = "' . $_SESSION["signup_data"]["username"] . '" >
                        </div>';		
            //if it's not the case and we don't have any sort of wrong data or error message then we show the regular output            
            } else {
                echo    '<div class="mb-3"> 
                            <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username..">
                        </div>';
            }
            //2- the password as we don't want to show it back even if it's wrong
                echo    '<div class="mb-3"> 
                            <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="pwd" placeholder="Enter your password..">
                        </div>';
            //3- like what we did in username if the mail is already wrote in the box and it's vaild and not taken before (not an error)
            if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_invalid"]) 
                && !isset($_SESSION["errors_signup"]["email_registered"])) {
                echo    '<div class="mb-3"> 
                            <label class="form-label">E-Mail</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter your E-mail.."
                                    value = "' . $_SESSION["signup_data"]["email"] . '" >
                        </div>';        
                //if it's not the case and we don't have any sort of wrong data or error message then we show the regular output            
                } else {
                echo    '<div class="mb-3"> 
                            <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter your E-mail..">
                        </div>';
                }
                //4- like what we did before if the phone number is already wrote in the box and it's vaild and not taken before (not an error)
                if (isset($_SESSION["signup_data"]["phoneNum"]) && !isset($_SESSION["errors_signup"]["phone_wrong"]) 
                && !isset($_SESSION["errors_signup"]["phone_registered"])) {

                    echo  '<div class="mb-3"> 
                                <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phoneNum" placeholder="Enter your Phone Number.."
                                        value = "' . $_SESSION["signup_data"]["phoneNum"] . '" >
                            </div>';         
                    //if it's not the case and we don't have any sort of wrong data or error message then we show the regular output output            
                } else {
                    echo    '<div class="mb-3"> 
                                <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phoneNum" placeholder="Enter your Phone Number..">
                             </div>';
                }
        }
//Checking the signup errors
function checking_signup_errors() {

    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];
        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }
        unset($_SESSION['errors_signup']);

    } else if (isset($_GET['signup']) && $_GET['signup'] === "success") {
        echo '<br>';
        echo '<p class="form-success">Signup Success! <br> Now write your name and password in the Login form to log in to the blog.</p>';
    }
}
