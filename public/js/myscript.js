num=2;
function AddOption(){
    let input=document.createElement('input');
    input.setAttribute('class','form-control');
    input.setAttribute('placeholder',num++);
    input.setAttribute('name','option[]');
    let get_elm=document.querySelector('.addOp');
    get_elm.appendChild(input);
}
function removeDisable(e){
    let count_arr=e.srcElement.parentNode.parentNode.childNodes.length-2;
    if (e.srcElement.parentNode.parentNode.childNodes[count_arr].childNodes[1].disabled==false){
        e.srcElement.parentNode.parentNode.childNodes[count_arr].childNodes[1].disabled=true;
    }else {
        e.srcElement.parentNode.parentNode.childNodes[count_arr].childNodes[1].disabled=false;
    }
}
