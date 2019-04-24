<?php
//Start av session
session_start();
//ladda och starta klass
include 'user.php';
$user = new User();
if(isset($_POST['signupSubmit'])){
    //Kollar om det finns något där
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['telefon']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Lösenorden matchar inte, Skriv in matchande lösenord!.';
        }else{
            //Kollar om en användare redan finns i databasen
            $prevCon['where'] = array('email'=>$_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if($prevUser > 0){
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'En användare med samma emailadress finns redan.';
            }else{
                //Lägger till användaren i databasen
                $userData = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'telefon' => $_POST['telefon']
                );
                $insert = $user->insert($userData);
                //Sätter status på användaren
                if($insert){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Du har lyckandes skapat en användare, Logga in med dina inloggnigsuppgifter!.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Ett error har uppstått, Försök vänligen igen.';
                }
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Alla fält är nödvändiga, Fyll i alla fält och försök igen.';
    }
    //Lagrar sessionen av sessdata
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'login.php':'register.php';
    //Skickas vidare till hemsidan
    header("Location:".$redirectURL);
}elseif(isset($_POST['loginSubmit'])){
    //Kollar om formuläret är tomt
    if(!empty($_POST['email']) && !empty($_POST['password'])){
    	 //tar användardata from användar klassen
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'status' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        //Sätter användardatan baserat på användar
        if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Welcome '.$userData['first_name'].'!';
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Fel Email eller lösenord, Försök igen med rätt.';
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Skriv in email och lösenord.';
    }
    //Lagrar sessdata i en session
    $_SESSION['sessData'] = $sessData;
    //Skickar vidare till login.php
    header("Location:login.php");
}elseif(!empty($_REQUEST['logoutSubmit'])){
    //Tar bort sessitionsdatan
    unset($_SESSION['sessData']);
    session_destroy();
    //sparar logutsdatan i en ny sessiton
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'Du är nu inloggad på din användare.';
    $_SESSION['sessData'] = $sessData;
    //Skickas vidare till login.php
    header("Location:login.php");
}else{
    //Skickas vidare direkt till login.php
    header("Location:login.php");
}
