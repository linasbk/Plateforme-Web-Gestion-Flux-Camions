



function show(el) {

    img = el;

        // Set image size to original
        
        img.classList.toggle("scalebig");
        img.classList.toggle("center");
        img.classList.toggle("scalesmall");

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

   

    