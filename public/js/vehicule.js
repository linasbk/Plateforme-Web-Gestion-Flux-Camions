flag = 0;



function show(el) {

    img = el;

    if (flag == 1) {
        flag = 0;
        // Set image size to original
        img.style.transform = "scale(1)";
        img.style.transition = "transform 0.35s ease";
        img.classList.remove("center");


    } else if (flag == 0) {
        flag = 1;
        img.classList.add("center");
        // Set image size to 1.5 times original
        img.style.transform = "scale(8)";
        // Animation effect
        img.style.transition = "transform 0.35s ease";

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

   

    