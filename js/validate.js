function check() {
    var password = document.getElementById("password").value;
    var cpassword = document.getElementById("cpassword").value;
    var error = document.getElementById("err");

    if (password == "" && cpassword == "") {
        error.innerText = "Please, fill all the feilds!";
        $("#err").removeClass("hide");
        return false;
    } else if (password == "") {
        error.innerText = "Please, give a password!";
        $("#err").removeClass("hide");
        return false;
    } else if (cpassword == "") {
        error.innerText = "Please, confirm password!";
        $("#err").removeClass("hide");
        return false;
    } else if (password != "" && cpassword != "") {
        if(password==cpassword)
        {
            return true;
        }
        else
        {
            error.innerText = "Password doesn't match!";
            $("#err").removeClass("hide");
            return false;
        }
    } else {
        $("#err").addClass("hide");
    }
}