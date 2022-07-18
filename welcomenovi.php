<?php 
session_start();
$location="";

function head_there($l){
    header($l);
    exit();
}
if ((isset($_SESSION['id']) == '') || $_SESSION['admin']==true)
{
    $location = "location: index.php";
    head_there($location);
}
require_once "sqlconnection.php";
$resultNumRows= "";
$taskRezultat = "";


    $sql = "SELECT task.TaskID, korisnik.Id, task.Naslov, task.Telo, task.Datum, task.Completed, task.KorisnikCompleted, task.Kategorija, korisnik.Ime, korisnik.Email, task.Komentar FROM task join korisnik on task.id=korisnik.id where korisnik.id= ? order by TaskID desc";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
        
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $bazaTaskID, $bazaId,$bazaNaslov,$bazaTelo,$bazaDatum,$bazaCompleted,$bazaKorisnikCompleted,$bazaKategorija,$bazaIme,$bazaEmail,$bazaKomentar);
            


            $resultNumRows= mysqli_stmt_num_rows($stmt);
            $taskRezultat = array();
            ////////////^big^boy^//////////////////////////////////////////////////////////////////////////////////
            
            $i=0;
            
                while(mysqli_stmt_fetch($stmt)){
                    $taskRezultat[$i] = array(
                        "TaskID"=>$bazaTaskID,
                        "Id"=>$bazaId,
                        "Naslov"=>$bazaNaslov,
                        "Telo"=>$bazaTelo,
                        "Datum"=>$bazaDatum,
                        "Completed"=>$bazaCompleted,
                        "KorisnikCompleted"=>$bazaKorisnikCompleted,
                        "Kategorija"=>$bazaKategorija,
                        "ImePosaljioca"=>$bazaIme,
                        "EmailPosaljioca"=>$bazaEmail,
                        "Komentar"=>$bazaKomentar
                    );
                    $i++;
                }
            
        } else{
            echo "error";
            echo mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="welcomeAdmin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="welcomeAdmin.js" ></script>
    
</head>
<body>
<div class="container">
 <div class="user-profile-area">
  <div class="task-manager">task manager</div>
  <div class="side-wrapper">
   <div class="user-profile">
    <img src="https://assets.codepen.io/3364143/Screen+Shot+2020-08-01+at+12.24.16.png" alt="" class="user-photo">
    <!-- ovde ces da dodas sa phpom da iz sesije uzima admin ime i email -->
    <div class="user-name"><?php echo $_SESSION["username"];?></div> 
    <div class="user-mail"><?php echo $_SESSION["username"];?></div>
   </div>
   <div class="user-notification">
    <div class="notify">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" fill="currentColor">
      <path d="M13.533 5.6h-.961a.894.894 0 01-.834-.57.906.906 0 01.197-.985l.675-.675a.466.466 0 000-.66l-1.32-1.32a.466.466 0 00-.66 0l-.676.677a.9.9 0 01-.994.191.906.906 0 01-.56-.837V.467A.467.467 0 007.933 0H6.067A.467.467 0 005.6.467v.961c0 .35-.199.68-.57.834a.902.902 0 01-.983-.195L3.37 1.39a.466.466 0 00-.66 0L1.39 2.71a.466.466 0 000 .66l.675.675c.25.25.343.63.193.995a.902.902 0 01-.834.56H.467A.467.467 0 000 6.067v1.866c0 .258.21.467.467.467h.961c.35 0 .683.202.834.57a.904.904 0 01-.197.984l-.675.676a.466.466 0 000 .66l1.32 1.32a.466.466 0 00.66 0l.68-.68a.894.894 0 01.994-.187.897.897 0 01.556.829v.961c0 .258.21.467.467.467h1.866c.258 0 .467-.21.467-.467v-.961c0-.35.202-.683.57-.834a.904.904 0 01.984.197l.676.675a.466.466 0 00.66 0l1.32-1.32a.466.466 0 000-.66l-.68-.68a.894.894 0 01-.187-.994.897.897 0 01.829-.556h.961c.258 0 .467-.21.467-.467V6.067a.467.467 0 00-.467-.467zM7 9.333C5.713 9.333 4.667 8.287 4.667 7S5.713 4.667 7 4.667 9.333 5.713 9.333 7 8.287 9.333 7 9.333z" /></svg>
    </div>
    <div class="notify alert">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
      <path d="M10.688 95.156C80.958 154.667 204.26 259.365 240.5 292.01c4.865 4.406 10.083 6.646 15.5 6.646 5.406 0 10.615-2.219 15.469-6.604 36.271-32.677 159.573-137.385 229.844-196.896 4.375-3.698 5.042-10.198 1.5-14.719C494.625 69.99 482.417 64 469.333 64H42.667c-13.083 0-25.292 5.99-33.479 16.438-3.542 4.52-2.875 11.02 1.5 14.718z" />
      <path d="M505.813 127.406a10.618 10.618 0 00-11.375 1.542C416.51 195.01 317.052 279.688 285.76 307.885c-17.563 15.854-41.938 15.854-59.542-.021-33.354-30.052-145.042-125-208.656-178.917a10.674 10.674 0 00-11.375-1.542A10.674 10.674 0 000 137.083v268.25C0 428.865 19.135 448 42.667 448h426.667C492.865 448 512 428.865 512 405.333v-268.25a10.66 10.66 0 00-6.187-9.677z" /></svg>
    </div>
    <div class="notify alert">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
      <path d="M467.812 431.851l-36.629-61.056a181.363 181.363 0 01-25.856-93.312V224c0-67.52-45.056-124.629-106.667-143.04V42.667C298.66 19.136 279.524 0 255.993 0s-42.667 19.136-42.667 42.667V80.96C151.716 99.371 106.66 156.48 106.66 224v53.483c0 32.853-8.939 65.109-25.835 93.291L44.196 431.83a10.653 10.653 0 00-.128 10.752c1.899 3.349 5.419 5.419 9.259 5.419H458.66c3.84 0 7.381-2.069 9.28-5.397 1.899-3.329 1.835-7.468-.128-10.753zM188.815 469.333C200.847 494.464 226.319 512 255.993 512s55.147-17.536 67.179-42.667H188.815z" /></svg>
    </div>
   </div>
   <div class="progress-status">1</div>
   <!-- za ova 3 progresa mozes iz baze da uzem broj completed i ne completed tasks -->
   <div class="progress">
    <div class="progress-bar"></div>
   </div>
   <div class="task-status">
    <div class="task-stat">
     <div class="task-number">1</div>
     <div class="task-condition">Completed</div>
     <div class="task-tasks">tasks</div>
    </div>
    <div class="task-stat">
     <div class="task-number">1</div>
     <div class="task-condition">To do</div>
     <div class="task-tasks">tasks</div>
    </div>
    <div class="task-stat">
     <div class="task-number">1</div>
     <div class="task-condition">All</div>
     <div class="task-tasks">Tasks</div>
    </div>
   </div>
  </div>
      <!-- ovo mozes da stavis kada employee pravi task ti mozes da izabere flare i time ce ti pisati koji trenutno projekti su aktivni -->
  <div class="side-wrapper">
   <div class="project-title">Projects</div>
   <div class="project-name">
    <div class="project-department">Marketing</div>
    <div class="project-department">Design</div>
    <div class="project-department">Development</div>
    <div class="project-department">Management</div>
   </div>
  </div>
  <!-- ovo je dobro ne diraj -->
  <div class="side-wrapper">
   <div class="project-title">Team</div>
   <div class="team-member">
    <img src="https://images.unsplash.com/flagged/photo-1574282893982-ff1675ba4900?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80" alt="" class="members">
    <img src="https://assets.codepen.io/3364143/Screen+Shot+2020-08-01+at+12.24.16.png" alt="" class="members">
    <img src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" alt="" class="members">
    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=998&q=80" alt="" class="members">
    <img src="https://images.unsplash.com/photo-1541647376583-8934aaf3448a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80" alt="" class="members">
   </div>
  </div>
 </div>
 <div class="main-area">
  <div class="header">
   <div class="search-bar">
    <input type="text" placeholder="Search...">
   </div>
        <div class="inbox-calendar">
            <input type="checkbox" class="inbox-calendar-checkbox">
            <div class="toggle-page">
            <span>Inbox</span>
            </div>
            <div class="layer"></div>
        </div>
        <!--  PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// -->
   <a href="logout.php" class="color-menu-daddy" >
   <div class="add-button" >
     SIGN OUT
   </div></a>
  </div>
  <div class="main-container">
    <div class="inbox-container">
        <div class="inbox">
        <div class="msg msg-department anim-y">
        Marketing
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 492 492">
        <path d="M484.13 124.99l-16.11-16.23a26.72 26.72 0 00-19.04-7.86c-7.2 0-13.96 2.79-19.03 7.86L246.1 292.6 62.06 108.55c-5.07-5.06-11.82-7.85-19.03-7.85s-13.97 2.79-19.04 7.85L7.87 124.68a26.94 26.94 0 000 38.06l219.14 219.93c5.06 5.06 11.81 8.63 19.08 8.63h.09c7.2 0 13.96-3.57 19.02-8.63l218.93-219.33A27.18 27.18 0 00492 144.1c0-7.2-2.8-14.06-7.87-19.12z"></path>
        </svg>
        </div>

        <?php
        if($resultNumRows>0){
            for ($k=0; $k < $resultNumRows; $k++) { 
            // bice ovde jedan if marketing if desing itd if($taskRezultat[$k]["Kategorija"]==$_GET["kategorija"])

            if($k==0){
                $pri = "selected-bg";
                
            }else{
                $pri = "";
                
            }
            if($taskRezultat[$k]["Completed"]){
                $pri2 = "checked";
            }else{
                $pri2 = "";
            }
            echo '
            <div class="msg anim-y '.$pri.' bigL " data-vrednost="'.$taskRezultat[$k]["TaskID"].'">
            <input data-checkbox-vrednost="'.$taskRezultat[$k]["TaskID"].'"type="checkbox" name="msg" id="mail'.$taskRezultat[$k]["TaskID"].'" class="mail-choice msg-mail-choice" '.$pri2.' disabled>
            <label for="mail'.$taskRezultat[$k]["TaskID"].'"></label>
            <div class="msg-content">
            <div class="msg-title">'.$taskRezultat[$k]["Naslov"].'</div>
            <div class="msg-date">'.$taskRezultat[$k]["Datum"].'</div>
            </div>
            <img src="https://assets.codepen.io/3364143/Screen+Shot+2020-08-01+at+12.24.16.png" alt="" class="members mail-members">
            </div>
            ';

            }

        } 
        
        ?>
        
        </div>

        <!-- PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// PRIMETI ME /// -->

        <!-- <div class="add-task">
        <button class="add-button">Add task</button>
        </div> -->
    </div>
    <div class="mail-detail">
        <div class="mail-detail-header">
            <div class="mail-detail-profile">
                <img src="https://assets.codepen.io/3364143/Screen+Shot+2020-08-01+at+12.24.16.png" alt="" class="members inbox-detail" />
                <div class="mail-detail-name"><?php echo $taskRezultat[0]["ImePosaljioca"];?></div>
            </div>
            
        </div>
            
                <div class="mail-contents">
                
                <!-- OVDE CE DA SE APPENDUJE -->
                </div>
                          
            
    </div>
    <div class="calendar-container">
        <h1>Napravi novi task</h1>
        <form action="welcomeObrada.php" method="post">
                    <p>Unesi naslov</p>
                    <input type="text" name="nNaslov" id="" placeholder="Naslov">
                    <p>Unesi telo</p>
                    <textarea name="nTelo" id="" cols="30" rows="10" placeholder="Telo"></textarea>
                    <p>Unesi datum</p>

                    <input type="date" name="nDatum" id="" value="2022-07-14">
                    
                    <p>Kojoj kategoriji pripada tvoj projekat</p>
                    
                    <input type="radio" name="nKategorija" value="Marketing"id="" checked>Marketing
                    <input type="radio" name="nKategorija" value="Design"id="">Design
                    <input type="radio" name="nKategorija" value="Development"id="">Development
                    <input type="radio" name="nKategorija" value="Management"id="">Management
                    <p>Da li si zavrsio task</p>
                    <input type="radio" name="nCompletedKorisnik" value="1"id="" checked>Da
                    <input type="radio" name="nCompletedKorisnik" value="0"id="">Ne
                    <br>
                    <br>
                    <br>
                <button type="submit" class="add-button">SUBMIT</button>
                
            </form>
    </div>
  </div>

    
</div>
</div>

</body>
  <script>
    let konacniNiz = <?php echo json_encode($taskRezultat);?>;
    let konacniBrojRedova = <?php echo $resultNumRows;?>;
    let sidePaneli = [];
    for (let index = 0; index < konacniBrojRedova; index++) {
      let cek="";
      let cek1="";
      let komentar="";
      if(konacniNiz[index]['Completed']==1){
        cek ="checked";
      }else if(konacniNiz[index]['Completed']==0){
        cek ="";
      } 
      if(konacniNiz[index]['KorisnikCompleted']==1){
        cek1 ="checked";
      }else{
        cek1 ="";
      } 
      if(konacniNiz[index]['Komentar']!=""){
        komentar = "<br>Komentar: <br>"+konacniNiz[index]['Komentar']+"!";
      }
      sidePaneli[index]='<div class="mail-contents-subject"><input type="checkbox" data-checkbox-vrednost="'+konacniNiz[index]['TaskID']+'"name="msg1" id="mail'+konacniNiz[index]['TaskID']*1000+'" class="mail-choice"'+cek+' disabled><label for="mail'+konacniNiz[index]['TaskID']*1000+'"></label><div class="mail-contents-title">'+konacniNiz[index]["Naslov"]+'</div></div><div class="mail"><div class="mail-time"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10" /><path d="M12 6v6l4 2" /></svg>'+konacniNiz[index]["Datum"]+'</div><div class="mail-inside">'+konacniNiz[index]["Telo"]+''+komentar+'</div><div class="mail-checklist"><input type="checkbox" name="msg2" id="mail'+((konacniNiz[index]['TaskID']*1000)+1)+'" class="mail-choice" '+cek1+' disabled><label for="mail'+((konacniNiz[index]['TaskID']*1000)+1)+'">User completed this task.</label></div></div>'



    }
    
    //slobodno preskoci ovu sta god da gledas
    document.querySelector(".mail-contents").innerHTML= sidePaneli[0];
    


    document.querySelectorAll(".bigL").forEach(element => {
      
      element.addEventListener("click", e=>{
        document.querySelectorAll(".bigL").forEach(element => element.classList.remove("selected-bg"));
        element.classList.add("selected-bg");
        let vrednost =element.dataset.vrednost;
        for (let index = 0; index < konacniBrojRedova; index++) {
          if(konacniNiz[index]['TaskID']==vrednost){
            
            document.querySelector(".mail-contents").innerHTML= sidePaneli[index];
          }          
        }
      })     
    });




    document.querySelector('.inbox-calendar').addEventListener("click", e=>{
        document.querySelector('.calendar-container').classList.toggle('calendar-show');
        document.querySelector('.inbox-container').classList.toggle('hide');
        document.querySelector('.mail-detail').classList.toggle('hide');

    });




  </script>
</html>