flag = 0;



function show(el) {

    img = el;

    if (flag == 1) {
        flag = 0;
        // Set image size to original
        
        img.classList.remove("scalebig");
        img.classList.add("scalesmall");
        img.classList.remove("center");
     


    } else if (flag == 0) {
        flag = 1;
        img.classList.remove("scalesmall");
        img.classList.add("scalebig");
        img.classList.add("center");
     

    }

}

function hidetab() {

    form = document.getElementById("formsearch");

    form.classList.add("formtop");

}


  

function impri() {
    var divToPrint = document.getElementById("searchtable");
    divToPrint.style.border = "1px solid black";
    divToPrint.style.borderCollapse = "collapse";
    newWin = window.open("");
    newWin.document.write("<br><br>");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}

   

    