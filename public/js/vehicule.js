flag = 0;

function submitform(){
    document.getElementById("formsearch").submit();
}

function show(el) {

    img = el;

    if (flag == 1) {
        flag = 0;
        // Set image size to original
        img.style.transform = "scale(1)";
        img.style.transition = "transform 0.80s ease";
        img.classList.remove("center");


    } else if (flag == 0) {
        flag = 1;
        img.classList.add("center");
        // Set image size to 1.5 times original
        img.style.transform = "scale(8)";
        // Animation effect
        img.style.transition = "transform 0.7s ease";

    }

}

function hidetab() {

    form = document.getElementById("formsearch");

    form.classList.add("formtop");

}



   

    