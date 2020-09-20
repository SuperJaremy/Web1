function validateData(){
    let x,y,r;
    x= parseLocal(document.forms['data']['x'].value);
    if(x===""){
        alert("Координата x не выбрана");
        return false;
    }
    y=parseLocal(document.forms['data']['y'].value);
    if(y==="" || isNaN(y) || y<-3 || y>5 || equals(y,5) || equals(y,-3)){
        alert("Неверная координата y");
        return false;
    }
    else
        document.forms['data']['y'].value=y;
    r=parseLocal(document.forms['data']['r'].value);
    if(r==="" || isNaN(r) || r<1 || r>4 || equals(r,4) || equals(r,1)){
        alert("Неверный радиус R");
        return false;
    }
    else
        document.forms['data']['r'].value=r;
}
function equals(a,b){
    let epsilon = 2**-50;
    return Math.abs(a-b)<epsilon;
}
function parseLocal(num){
    return num.replace(',','.');
}