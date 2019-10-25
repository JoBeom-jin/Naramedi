
if(mes == 1 ) {
        cont.style.display="none";
        my_modal2.style.display = "block";
        sessionStorage.setItem("message", 0);
}


function info_open() {
    cont.style.display="none";
    info_modal.style.display="block";    
}

function my_open() {
    info_modal.style.display="none";
    my_modal.style.display="block";    
}


function my_open2() {
    info_modal.style.display="none";
    my_modal2.style.display="block";    
}

function my_open3() {
    info_modal.style.display="none";
    my_modal3.style.display="block";    
}

function my_open4() {
    info_modal.style.display="none";
    my_modal4.style.display="block";     
}

function my_open5() {
    info_modal.style.display="none";
    my_modal5.style.display="block";     
}



function close_menu() {
    info_modal.style.display="block";
    my_modal.style.display="none";    
}


function close_menu2() {
    info_modal.style.display="block";
    my_modal2.style.display="none";    
}

function close_menu3() {
    info_modal.style.display="block";
    my_modal3.style.display="none";    
}

function close_menu4() {
    info_modal.style.display="block";
    my_modal4.style.display="none";     
}

function close_menu5() {
    info_modal.style.display="block";
    my_modal5.style.display="none";     
}


function modify1() {
location.href='/index.php/Infomodify';
sessionStorage.setItem("code", 1);
}

function modify2() {
location.href='/index.php/Infomodify';
sessionStorage.setItem("code", 2);
}

function modify3() {
location.href='/index.php/Infomodify';
sessionStorage.setItem("code", 3);
}

function modify4() {
location.href='/index.php/Infomodify';
sessionStorage.setItem("code", 4);
}

function modify5() {
location.href='/index.php/Infomodify';
sessionStorage.setItem("code", 5);
}

function search() {
location.href='/index.php/Hospital_search';     
sessionStorage.setItem("op_code", 3);   
}