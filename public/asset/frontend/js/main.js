document.querySelector(".header-nav-menu-icon").onclick= function()
{

    document.querySelector('.modal-over').classList.add('active')
}
document.querySelector(".modal-icon-close").onclick= function()
{

    document.querySelector('.modal-over').classList.remove('active')
}
let listNavItems=   document.getElementsByClassName("header-nav-main-item-link");
for(var i= 0; i< listNavItems.length; i++)
{
    if(!listNavItems[i].classList.contains('active'))
        listNavItems[i].onmouseover = function()
        {
            this.classList.add('active');

        }
    listNavItems[i].onmouseout = function()
    {
        this.classList.remove('active');

    }

}