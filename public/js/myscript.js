function dropFunc(e){
    let elmID=e.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML;
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "deleteUser.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("getData="+elmID);
}
function editFunc(e) {
    let elmId = e.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML;
    let Elm = document.querySelector('.editForm');
    let addElmDiv =document.createElement("div");
    addElmDiv.setAttribute("class", "form-group");
    Elm.appendChild(addElmDiv);
    let addElmIn=document.createElement("input");
    addElmIn.setAttribute('class',"form-control");
    addElmIn.setAttribute('id',"inEmail");
    addElmIn.setAttribute('placeholder',"Enter New Email");
    addElmDiv.appendChild(addElmIn);
    let addElmIn2=document.createElement("input");
    addElmIn2.setAttribute('class',"form-control");
    addElmIn2.setAttribute('id',"inPass");
    addElmIn2.setAttribute('placeholder',"Enter New Password");
    addElmIn2.style.marginTop="1rem";
    addElmDiv.appendChild(addElmIn2);

    let addBtn=document.createElement('button');
    addBtn.innerHTML="Update";
    addBtn.style.marginTop="1rem";
    addBtn.setAttribute('class',"btn btn-primary");
    // addBtn.setAttribute('name',"editSub");
    addElmDiv.appendChild(addBtn);
    addBtn.onclick=function (){
         finalEdit();
    }
    function finalEdit(){
        let valInEmail=document.querySelector('#inEmail').value;
        let valInPass=document.querySelector('#inPass').value;
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "editUser.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("getData="+elmId+","+valInEmail+","+valInPass);
    }
}