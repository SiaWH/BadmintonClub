
function logOut()
{
    var confirmation = confirm('Log Out ! Are you sure ?');

    if (confirmation)
    {
        alert('Log out successfully');
        window.location.assign('./adminLogin.php');
    }

    else
    {
        alert('Log out canceled.');
    }

}


function manageEvent()
{
    window.location.assign('./adminPage.php');
}

function manageAdmin()
{
    window.location.assign('./manageAdmin.php');
}


function addEvent()
{
    window.location.assign('./addEvent.php');
}

function show() 
{
  const control = document.getElementById('controlMenu');
  
  console.log(control);
  
  if (control.classList.contains('hide')) 
  {
    control.classList.remove('hide');
  } 
  else 
  {
    control.classList.add('hide');
  }
}


//Dark mode
var stat = 0;
function dark()
{
        if(stat == 0 )
            {
            document.getElementById('t1').style.backgroundColor = "#063970";
            document.getElementById('h1').style.color = "white";
            document.body.style.background = "black";
            document.getElementById('title1').style.color = "white";
            document.getElementById('title1').style.backgroundColor = "darkcyan";
            document.getElementById('listEvents').style.backgroundColor = "#000066";

            stat = 1;
            }
            
            else if( stat == 1)
            {
            document.getElementById('t1').style.backgroundColor = "white";
            document.getElementById('h1').style.color = "black";
            document.body.style.backgroundImage = "url('./picture/background.jpg')";
            document.getElementById('title1').style.color = "black";
            document.getElementById('title1').style.backgroundColor = "white";
            document.getElementById('listEvents').style.backgroundColor = "white";
            stat = 0;
            }
            
            
}



function addAdmin()
{
    window.location.assign('./addAdmin.php');
}

function manageUser()
{
    window.location.assign('./manageUser.php');
}

function modifyEvent()
{
    window.location.assign('./modifyEvent.php');
}

function manageCurrent()
{
    window.location.assign('./manageCurrent.php');
}    
    
function viewTrainees()
{
    window.location.assign('./viewTrainees.php');
}

