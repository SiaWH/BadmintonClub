/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

function addAdmin()
{
    window.location.assign('./addAdmin.php');
}

function manageUser()
{
    window.location.assign('./manageUser.php');
}

function manageCurrent()
{
    window.location.assign('./manageCurrent.php');
} 

function checkReview()
{
    window.location.assign('./checkReview.php');
}
