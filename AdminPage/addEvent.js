/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    
    function checkOthers()
    {
        var venue = document.getElementById('eventVenue').value;
    
        if (venue === "others")
        {
            document.getElementById('eventVenue').options[2].value = document.getElementById('others').value;
        }

    }
    
    
            
    function back()
    {
                window.location.assign('http://localhost/demoWeb/adminPage.php');
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
            


            stat = 1;
            }
            
            else if( stat == 1)
            {
            document.getElementById('t1').style.backgroundColor = "white";
            document.body.style.backgroundImage = "url('./picture/background.jpg')";
            document.getElementById('h1').style.color = "black";
            document.getElementById('title').style.backgroundColor = "black";
            
            
            stat = 0;
            }
}