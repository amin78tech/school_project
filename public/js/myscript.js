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
let time_min=document.querySelector('.exam_time').innerHTML;
let time_second=60;
setInterval(timer,'1000');
function timer(){
    time_second--;
    if (time_second==0){
        time_min--
        time_second=60;
        if (time_min==0){
            let get_exam=document.querySelector('.getExamId').getAttribute('value');
            let xhttp = new XMLHttpRequest();
            xhttp.open("GET", "http://localhost:8000/student/done/exam/"+get_exam);
            xhttp.send()
            window.location="http://localhost:8000/overview";
        }
    }
    document.querySelector('.exam_time').innerHTML='time: '+time_min+' minute';
}
function activeInputAns(e){
    if (e.srcElement.parentNode.previousSibling.previousSibling.disabled==false){
        e.srcElement.parentNode.previousSibling.previousSibling.disabled=true;
    }else {
        e.srcElement.parentNode.previousSibling.previousSibling.disabled=false;
    }
}

function getTime(){
    let get_time=document.querySelector('.exam_time').textContent;
    let data=get_time.replace(/[^0-9]/g,"");
    let get_User=document.querySelector('.getUserId').getAttribute('value');
    let get_exam=document.querySelector('.getExamId').getAttribute('value');
    let get_token=document.querySelector('.csrf_token').getAttribute('content');
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost:8000/student/done/exam/time/"+get_User+"/"+get_exam+"/"+data);
    xhttp.send()
}
