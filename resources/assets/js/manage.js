const accordians = document.getElementsByClassName('has-submenu');
const adminSlideoutButton = document.getElementById('admin-slideout-button');

for (var i=0; i < accordians.length; i++)
{

   if (accordians[i].classList.contains('is-active'))
   {
     const submenu = accordians[i].nextElementSibling;
      // meu is closed by default .. so open it
      submenu.style.maxHeight = submenu.scrollHeight + "px";
      submenu.style.marginTop = "0.75em";
      submenu.style.marginBottom = "0.75em";        
   }


   accordians[i].onclick = function() 
   {
     this.classList.toggle('is-active');
     
     const submenu = this.nextElementSibling;
     if (submenu.style.maxHeight) 
     {
        // open so close it
        submenu.style.maxHeight = null;
        submenu.style.marginTop = null;
        submenu.style.marginBottom = null;        
     }
     else
     {
      // meu is closed so open it
        submenu.style.maxHeight = submenu.scrollHeight + "px";
        submenu.style.marginTop = "0.75em";
        submenu.style.marginBottom = "0.75em";        
     }
   }
}

adminSlideoutButton.onclick = function() 
{
   this.classList.toggle('is-active');
   document.getElementById('admin-side-menu').classList.toggle('is-active');
}
