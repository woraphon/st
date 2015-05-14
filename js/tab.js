// JavaScript Document


    function display(sID) {

    oObj = document.getElementById(sID);
    if (oObj) {
    oObj.style.display='inline';
    }
    }

    function hide(sID) {
    oObj = document.getElementById(sID);
    if (oObj) {
    oObj.style.display='none';
    }
    }

    function gettab(id){

    for (i=1;i<=5;i++)
    {
    if (id == i)
    {
    display("box_content"+i);
    document.getElementById("li"+i).className ='font18';
    }else{
    hide("box_content"+i);
    document.getElementById("li"+i).className ='font12';
    }
    }

    }
