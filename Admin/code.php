<?php
//include('security.php');
session_start();
include("includes/database.php");

echo "hello";

if(isset($_POST['submit']))
{
        //Add Data Base connecttion

         $username=$_POST['username'];
         $password=$_POST['password'];
          $cpassword=$_POST['confirmpassword'];
          $email=$_POST['email'];
      


        //  $speciality=$_POST['speciality'];
        // $date=$_POST['date'];

        
        if(empty($username) || empty($email) || empty($password) || empty($cpassword) )
        {
            $_SESSION['status']="Empty Feilds";
            header("Location:register.php?emptyfeilds&username=.$username");
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9]*/",$username))
        {
            $_SESSION['status']="Invalid Username";
            header("Location:register.php?invalidusername&username=.$username");
            exit();
            
        }
        else if($cpassword!=$password)
        {
            $_SESSION['status']="Password and Confirm Password doesnot match";
            header("Location:register.php?passworddoesnotmatches&username=.$username");
            exit();
        }
        if(strlen($password)>1)
        {
        
            $sql="select username from `admin_users` where username='$username'";
            $query_count=mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($query_count)) {
                $_SESSION['status']="Username taken";
                header("Location:register.php?usernametaken&username=.$username");
                exit();
            

            }    
                else{
                   $hashedPass=password_hash($password,PASSWORD_DEFAULT);
                
                   
                $sql2="insert into admin_users(username,password,email,role,mobile,status) values('$username','$hashedPass','$email','1','123','1')";
                $query_r=mysqli_query($conn,$sql2);

                if($query_r)
                {
                            $_SESSION['success']="Registration Successful";
                            header("Location:register.php?SUCCESS!=registered");
                            exit();
                }
                else{
                    $_SESSION['status']="Query Failed";
                    header("Location:register.php?queryfailesd2&hashedpassword=.$hashedPass");
                    exit();
                            
                           
                }

            
            }
            


        }
        else{
            $_SESSION['status']="Admin Profile not added";
            header("Location:register.php?LengthIsLessThan8");
                            exit();
        }
        
}


?>
<?php

    if(isset($_POST['mess']))
    {
        $email=$_POST['email'];
        $message=$_POST['message'];

        $from=$_SESSION['username'];

        if(empty($email) || empty($message))
        {
            header('Location:message_box.php?EmptyFeilds');
            exit();
        }
        else{
            $sql="INSERT INTO `admin` (`id`, `from`, `to`, `message`, `status`) VALUES (NULL, '$from', '$email', '$message', 'unread');";
            $query=mysqli_query($conn,$sql);
            if($query)
            {
                header('Location:messages.php?MessageSent');
            exit();
            }
            else{
                header('Location:message_box.php?QueryFailed');
            exit();
            }
        }
    }


?>































<!-- 
if(empty($username)  || empty($email) || empty($speciality) || empty($password) || empty($cpassword))
        {
            header("Location:register.php?emptyfeilds&username=".$username);
            exit(); 
        }
        else if(!preg_match("/^[a-zA-Z0-9]*/",$username))
        {
            header("Location:register.php?invalidusername&username=".$username);
            exit();
        } else if($password!=$cpassword)
        {
            header("Location:register.php?passwordnotmatched&username=".$username);
            exit();
        }
        else{
            $sql="select username from admin where username= ?";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql))
            {
            header("Location:register.php?queryfailed1&username=".$username);
            exit();
            } else{
                mysqli_stmt_bind_param($stmt,"s",$username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $rowCount = mysqli_stmt_num_rows($stmt);
                if($rowCount>0)
                {
                 header("Location:register.php?usernametaken&username=".$username);
                exit();
                }
                else{
                    $sql="insert into attendance(username,password,email,speciality_id) values (?,?,?,?) ";
                    $stmt=mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql))
                    {
                    header("Location:register.php?queryfailed2&username=".$username);
                    exit();
                    }
                        else{

                            $hashedPass=password_hash($password,PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt,"ssss",$username,$hashedPass,$email,$speciality);
                            mysqli_stmt_execute($stmt);
                            
                            header("Location:register.php?SUCCESS!=registered");
                            exit();
                           
                            
                            
                        }       
                    
                }

            }
            
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);    -->
