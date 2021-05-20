function openNav() {
    document.getElementById("pageShadow").style.display = "block";
    document.getElementById("nav").style.display = "block";
}

function closeNav() {
    document.getElementById("pageShadow").style.display = "none";
    document.getElementById("nav").style.display = "none";
}

function openAside() {
    document.getElementById("pageShadow").style.display = "block";
    document.getElementById("aside").style.display = "block";
}

function closeAside() {
    document.getElementById("pageShadow").style.display = "none";
    document.getElementById("aside").style.display = "none";
}

function dropdownToggle(ddNr) {
    elem = document.getElementById("i"+ddNr);
    arrow = elem.firstElementChild.firstElementChild.lastElementChild;
    contents = elem.lastElementChild;

    if(contents.classList.contains("disabled")){
        arrow.classList.replace("up", "down");
        contents.classList.replace("disabled", "enabled");
    } else if (contents.classList.contains("enabled")){
        arrow.classList.replace("down", "up");
        contents.classList.replace("enabled", "disabled");
    }
}

function changePic($string) {
    document.getElementById("bigPic").setAttribute("src", "../../img/product-img/"+$string+".png");
    for (pic of document.getElementsByClassName("productPic")) {
        if(pic.firstElementChild.classList.contains("selectedPic")) {
            pic.firstElementChild.classList.remove("selectedPic");
        }
    }
    document.getElementById($string).classList.add("selectedPic");
}

function firstPicSelected() {
    firstPic = document.getElementsByClassName("productPic")[0];
    firstPic.firstElementChild.classList.add("selectedPic");
}

function addToCart($i) {
    productID = parseInt(document.getElementsByName("product")[$i].value);
    addAmount = parseInt(document.getElementsByName("amount")[$i].value);
    $.ajax({
        type: "POST",
        url: "../server/add-to-cart.php",
        data: {id: productID, amount: addAmount},
        success: function(){
            alert("Product has been added.");
        }
    });
}

function modifyCart() {
    ids = "";
    amounts = "";
    for (i = 0; i < document.getElementsByName("product").length; i++) {
        ids += document.getElementsByName("product")[i].value + ",";
        amounts += document.getElementsByName("amount")[i].value + ",";
    }
    ids = ids.slice(0, -1);
    amounts = amounts.slice(0, -1);
    $.ajax({
        type: "GET",
        url: "../server/modify-cart.php",
        data: {id: ids, amount: amounts},
    });
}

function removeFromCart(i) {
    productID = parseInt(document.getElementsByName("product")[i].value);
    location.replace('../server/remove-from-cart.php?id='+productID);
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function selectedNavElement(i) {
    if (getCookie('session_id')) {
        if (i === (4 || 5)) {
            return;
        } else if (i === (6 || 7)) {
            i-=2;
        }
    }
    navOptions = document.getElementsByClassName("navOption");
    navOptions[i].classList.add("selected");
}

function selectedAsideElement(i) {
    asideOptions = document.getElementsByClassName("asideOption");
    asideOptions[i].classList.add("selected");
}

function changePaymentOption (i) {
    for (o of document.getElementsByClassName("paymentOption")) {
        if(o.classList.contains("selectedMethod")) {
            o.classList.remove("selectedMethod");
        }
    }
    i.classList.add("selectedMethod");
    document.getElementById("finalizeDisabled").style.display = "none";
    document.getElementById("finalizeEnabled").style.display = "inline-block";
    document.getElementById("payment").value = i;
}