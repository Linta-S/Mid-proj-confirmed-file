<!DOCTYPE html>
<html>
    <head>

        <style>
            .error {color: #FF0000;}
        </style>
        <title>Registration Form</title>
    </head>
    <body background="pic.jpg">
        <?php

            $firstname = $lastname = $gender =$address= $email = $username = $password =$confirmpassword = $phone="";
            $firstnameerr = $lastnameerr= $gendererr =$addresserr = $emailerr = $usernameerr = $passworderr =$confirmpassworderr = $phoneerr= $notavailable = "";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['fname'])) {
                    $firstnameerr = "Please Fill up the firstname!";
                }
                else
                {
                    $firstname= $_POST ['fname'];
                }

                if(empty($_POST['lname'])) {                    
                    $lastnameerr = "Please Fill up the lastname!";
                    
                }
                else
                {
                    $lastname= $_POST ['lname'];
                }

                if(empty($_POST['gender'])) {                    
                    $gendererr = "Please Fill up the gender!";
                    
                }
                else
                {  $gender = $_POST ['gender'];
            }

               if(empty($_POST['address'])) {                    
                    $addresserr = "Please Fill up the Address!";
                    
                }
                else
                {
                    $address = $_POST ['address'];
                }

                 if(empty($_POST['uname'])) {                    
                    $usernameerr = "Please Fill up the username!";
                }
                else
                {
                    $username = $_POST ['uname'];
                }

                if(empty($_POST['pass'])) {                    
                    $passworderr = "Please Fill up the password!";
                }
                else
                {
                    $password = $_POST['pass'];
                }
                if (empty($_POST['confirmpassword']))
                {
                $confirmpassworderr = "Confirm your password";
                }
                else
                {
                $confirmpassword = $_POST['confirmpassword'];
                }
                if(empty($_POST['email'])) {                    
                    $rec_emailerr = "Please Fill up the recovery email!";
                }
                else
                {
                    $rec_email = $_POST ['email'];

                }
                if(empty($_POST['phone'])) {                    
                    $phoneerr = "Please Fill up the phone number!";
                }
                {
                    $phone = $_POST['phone'];
                }



if ( $firstnameerr == "" && $lastnameerr== "" && $gendererr == "" && $addresserr == "" && $emailerr == "" && $usernameerr == "" && $passworderr == "" &&  $phoneerr== "" && $notavailable = "")

    {

        $signUp_details = array('firstname'=> $firstname, 'lastname' => $lastname,'gender' => $gender,'address'=> $address, 'email' => $email , 'username' => $username,'psw'=>$password, 'phone' => $phone );


        signUp_details_encode($signUp_details);


        if(file_exists("Details.txt"))

        {
            $regDetail_open =fopen("Details.txt" , "r");
            $value = fread($regDetail_open,filesize("Details.txt"));
            fclose($$regDetail_open);


            $data_filter = explode("\n", $value);
            for ($i=0 ; $i <count ($data_filter)-1; $i++)
            {
                $json_decode =json_decode($data_filter[$i],true);

             if ($json_decode['email']==$email or $json_decode['username']== $username)
             { 
                echo "Username already exists";
             }

            else
            {
                if ($password != $confirmpassword) 
                      //if($reg_details['password'] == $reg_details['confirmpassword']) 
                      {
                         echo "Password not matched";
                      }

            else
                      {
                         $reg_open1 = fopen("Details.txt", "a");
                         fwrite($reg_open1, $reg_details_encode . "\n");
                         fclose($reg_open1);

                         $login_details = array('username'=>$username,'password'=>$password);
                         $login_details_encode = json_encode($login_details);

                         $login_open = fopen("login.txt", "a");
                         fwrite($login_open, $login_details_encode . "\n");
                         fclose($login_open);

                        $_SESSION['message'] = "You have clicked on button successfully";
                        if(isset($_COOKIE["type"]))
                        {
                         header("location: login.php");
                        }
                         echo "success";
                         echo "<br>";
                      }


            }
            }
        }
    }
    else 
                {
                   if ($password != $confirmpassword) 
                   //if($reg_details['password'] == $reg_details['confirmpassword']) 

                    {
                      echo "Password not matched";
                    } 

                    else
                    {
                      $reg_open2 = fopen("Details.txt", "a");
                      fwrite($reg_open2, $reg_details_encode . "\n");
                      fclose($reg_open2);

                      $login_details = array('username'=>$username,'password'=>$password);
                      $login_details_encode = json_encode($login_details);

                      $login_open = fopen("login.txt", "a");
                      fwrite($login_open, $login_details_encode . "\n");
                      fclose($login_open);

                    $_SESSION['message'] = "You have clicked on button successfully";

                      header("location: login.php");
                      echo "success";
                      echo "<br>";
                    }

                   
                }


            }

            ?>
       <center>
 
        <h1>Registration Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend align=center><b>Basic Information:</b></legend>
            
                <label for="firstname">First Name:</label>
                <input type="text" placeholder="write your First name" name="fname" id="firstname">
                <span class="error">* <?php echo $firstnameerr;?></span>
                <br>
                <br>
                <label for="lastname"> Last Name:</label>
                <input type="text" placeholder="write your Last name" name="lname" id="lastname">
                <span class="error">* <?php echo $lastnameerr;?></span>
                <br>
                <br>
                <label for="gender">Gender:  </label>
                <input type="radio" name="gender" id="male" value="male">  
                <label for="gender">Male </label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="gender">Female </label>
                <input type="radio" name="gender" id="other" value="other">
                <label for="gender">Other </label>
                <?php echo $gendererr; ?>
                <br>
                <br>

              


            </fieldset>

            <fieldset>
                <legend  align=center><b>Account Information:</b></legend>
             
                <label for="username">Username:</label>
                <input type="text" placeholder="write your  User name" name="uname" id="username">
                <span class="error">* <?php echo $usernameerr; echo $notavailable;?></span>
                <br>
                <br>

                <label for="parmanent_address">Password:</label>
                <input type="password" placeholder="Write your Password" name="pass" id="password">
                <span class="error">* <?php echo $passworderr;?></span>               
                <br>
                <br>
              <label for="confirmpassword">Confirm Password:</label>
              <input type="password" placeholder="Confirm your Password" id="confirmpassword" name="confirmpassword" >
              <span class="error">* <?php echo $confirmpassworderr;?></span>
              <br>
                <br>
                <!--<label for="rec_email">Recovery email:</label>
                <input type="email" placeholder="write your Email" id="email" name="email">
                <?php echo $emailerr; ?> -->
                
                </fieldset>

                 
                <fieldset>
                <legend  align=center><b>Contact Information :</b></legend>
                <label for="email">Email:</label>
                <input type="email" placeholder="write your email address" id="email" name="e-mail">
                <span class="error">* <?php echo $emailerr;?></span>
                <br>
                <br>
                <label for="Address">Address :</label>
                <input type="text" placeholder="write your  Address" id="address" name="address">
                <span class="error">* <?php echo $addresserr;?></span>
                 

                <br>
                <br>
                <label for="Phone">Phone-Number :</label>
                <input type="number" placeholder="write your  Phone-number" id="phone" name="phone">
                <span class="error">* <?php echo $phoneerr;?></span>
                           
               </fieldset>

            <input type="submit" value="Submit" > 
        </form>
        
    </body>
</html>