//Logout
function logOut(){
    if(confirm("Are you sure you want to log out?")){
        window.location = "logout.php";
        return false;
    }
}

//Profile
var pfl = document.querySelector('.toplinks img');
var drop = document.querySelector('.profile');
var toplink = document.querySelector('.toplinks');

//pfl.addEventListener('click', function(){
//    if (drop.style.display === 'none'){
//        drop.style.display = 'block';
//        document.addEventListener('click', closeProfile);
//    }
//    else {
//        drop.style.display = 'none';
//        document.removeEventListener('click', closeProfile);
//    }
//});

$(document).ready(function(){
   $(pfl).click(function(){
      $(drop).fadeToggle(400); 
   });
});

$(document).click(function(event) {
    if (!$(event.target).closest(drop).length && !$(event.target).closest(pfl).length && !$(event.target).closest(view).length) {
      $(drop).fadeOut(400);
    }
  });

//
//function closeProfile(event) {
//    if (!toplink.contains(event.target) && !view.contains(event.target) && !drop.contains(event.target)) {
//      drop.style.display = 'none';
//      document.removeEventListener('click', closeProfile);
//    }
//  }

//View Profile Picture
var view = document.querySelector('.view');
var pic = document.querySelector('.profile img');
var viewclose = document.getElementById("closeview");

$(document).ready(function(){
    $(pic).click(function(){
        if ($(view).css('display') === 'none'){
        $(view).css('display', 'flex');
    }
    else {
        $(view).css('display', 'none');
    }
    });
});

$(document).ready(function(){
   $(view).click(function(){
       if (!pic.contains(this)) {
      $(view).css('display', 'none');
    }
   });
});

//pic.addEventListener('click', function(){
//    if (view.style.display === 'none'){
//        view.style.display = 'flex';
//    }
//    else {
//        view.style.display = 'none';
//    }
//});

//view.addEventListener('click', function(event) {
//    if (!pic.contains(event.target)) {
//      view.style.display = 'none';
//    }
//  });

////Account Setting
//var acc = document.querySelector('.acc');
//var set = document.querySelector('.setting');
//var arror = document.querySelector('.arrow');
//
//acc.addEventListener('click', function(){
//    if (set.style.display === 'none'){
//        set.style.display = 'block';
//        arror.style.transform = 'rotate(90deg)';
//        document.addEventListener('click', closeSet);
//    }
//    else {
//        set.style.display = 'none';
//        arror.style.transform = 'rotate(0deg)';
//        document.addEventListener('click', closeSet);
//    }
//});
//
//function closeSet(event) {
//    if (!drop.contains(event.target) && !set.contains(event.target) && !view.contains(event.target) && !profileChanger.contains(event.target)) {
//      set.style.display = 'none';
//      arror.style.transform = 'rotate(0deg)';
//      document.removeEventListener('click', closeSet);
//    }
//  }

//Hidden Menu
var menu = document.getElementById("menuList");
var openbtn = document.getElementById("open");
var closebtn = document.getElementById("close");
var viewProfile = document.querySelector('.hp a img');

openbtn.addEventListener('click', function(){
    menu.style.transform = 'translateX(0%)';
});

closebtn.addEventListener('click', function(){
    menu.style.transform = 'translateX(200%)';
});

document.addEventListener('click', function(event) {
    if (!menu.contains(event.target) && event.target !== openbtn && !view.contains(event.target)) {
        menu.style.transform = 'translateX(200%)';
    }
});

$(document).ready(function(){
    $(viewProfile).click(function(){
        if ($(view).css('display') === 'none'){
        $(view).css('display', 'flex');
    }
    else {
        $(view).css('display', 'none');
    }
    });
});

//viewProfile.addEventListener('click', function(){
//    if (view.style.display === 'none'){
//        view.style.display = 'flex';
//    }
//    else {
//        view.style.display = 'none';
//    }
//});

//Setting changer
var profileView = document.querySelector('.settingPic');

//profileView.addEventListener('click', function(){
//    if (view.style.display === 'none'){
//        view.style.display = 'flex';
//    }
//    else {
//        view.style.display = 'none';
//    }
//});

$(document).ready(function(){
    $(profileView).click(function(){
        if ($(view).css('display') === 'none'){
        $(view).css('display', 'flex');
    }
    else {
        $(view).css('display', 'none');
    }
    });
});
