/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function removeParticipant()
{
    var confirmation = confirm('Are you sure you want to delete participant?');
    
    if(confirmation)
    {
        alert('Participant removed');
    }
    
    else
    {
        alert('Operation canceled');
    }
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

var stat = 0;
function dark()
{
     if(stat == 0 )
            {
            document.getElementById('t1').style.backgroundColor = "#063970";
            document.body.style.background = "black";
            document.getElementById('h1').style.color = "white";
            document.getElementById('title').style.backgroundColor = "darkcyan";
            document.getElementById('participantDetails').style.backgroundColor = "darkcyan";
            document.getElementById('n').style.backgroundColor = "darkblue";


            stat = 1;
            }
            
            else if( stat == 1)
            {
            document.getElementById('t1').style.backgroundColor = "white";
            document.body.style.backgroundImage = "url('./picture/background.jpg')";
            document.getElementById('h1').style.color = "black";
            document.getElementById('title').style.backgroundColor = "black";
            document.getElementById('participantDetails').style.backgroundColor = "black";
            document.getElementById('n').style.backgroundColor = "black";
            
            stat = 0;
            }
}


