/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function check()
{
    var admId;
    var admPassword
    admId = document.getElementById('adminId').value;
    admPassword = document.getElementById('password').value;

    if(admId == 'admin')
    {
        if(admPassword == 'admin123')
        {
            alert('Hi admin, welcome back !');
            window.location.assign('adminPage.php');
            
        }
    }

    else
    {
        alert('Incorrect combination of password or ID, please try again !');
        location.reload();
        
    }
}


