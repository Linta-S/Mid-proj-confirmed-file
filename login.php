<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
    </head>
    <body>
        <?php
          
            $username = $password ="";
            $usernameerr = $passworderr ="";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['uname'])) {                    
                    $usernameerr = "Please Fill up the Username!";
                }

                else if(empty($_POST['pass'])) {                    
                    $passworderr = "Please Fill up the password!";
                }

                else {
                    $username = $_POST['uname'];
                    $password = $_POST['pass'];

                    $log_file = fopen("Login.txt", "r");
                    
                    $data = fread($log_file, filesize("Login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['username'] == $username && $json_decode['password'] == $password) 
                        {
                            session_start();
                            $_SESSION['user'] = $username;
                            header("Location: wellcome.php");
                        }
                    }
                    echo "Wrong Password! Please Try Again.";
                }
            }
        ?>

        <center>
             <img src="picc.PNG" alt="picture" style="height":.1px ; "width":.1px;>
        <h1 align= center>Login Form</h1>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <br>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
          
            <fieldset>
                <legend align=center ><b>Login</b></legend>
            
                <label for="username">Username:</label>
                <input type="text" name="uname" id="username" align =center>
                <?php echo $usernameerr; ?>

                <br>
                <br>

                <label for="parmanent_address">Password:</label>
                <input type="password" name="pass" id="password" align =center>
                <?php echo $passworderr; ?>
                
                </fieldset>
           
           <input type="submit" value="Login" align =center>
            <!--   
             <br><a href='wellcome.php'><input type=button value="LogIn" name="log" align =center></a>--> 


        <br>
        <br>
         <br>
        <br>
         <br>
        <br>
          <fieldset>
         <label for="text">Do You want to sign up first?</label>
        </fieldset>
         <br>
        <!-- <a href='product.php'>Do You want to sign up first?</a><br> --> 
         <br><a href='registration.php'><input type=button value="Sign Up" name="Change Password" ></a>
        </form>
        
    </body>
</html>
