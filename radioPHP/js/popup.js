$(document).ready(function () {
    //setTimeout(popup, 3000);
    function popup() {
        $("#logindiv").css("display", "block");
    }
    $("#login #cancel").click(function () {
        $(this).parent().parent().hide();
    });

    $("#onclick").click(function () {
        $("#alertediv").css("display", "block");
    });
    $("#contact #cancel").click(function () {
        $(this).parent().parent().hide();
    });
// Contact form popup send-button click event.
    $("#send").click(function () {
        var idkeyarduino = $("#idkeyarduino").val();
        var name = $("#name").val();
        var datelaunch = $("#datelaunch").val();
        var tempmin = $("#tempmin").val();
        var tempmax = $("#tempmax").val();
        var species = $("#species").val();

        if (idkeyarduino == "" ||
                name == "" ||
                datelaunch == "" ||
                tempmin == "" ||
                tempmax == "" ||
                species == "") {
            alert("Please Fill All Fields");
        } else {
            $("#contact").submit(function ()
            {
                alert('Aquarium ajouté');
                return true;
            });
            $("#contact").submit(); //invoke form submission
        }
    });
    
// Login form popup login-button click event.
    $("#loginbtn").click(function () {
        var name = $("#username").val();
        var password = $("#password").val();
        if (username == "" || password == "") {
            alert("Username or Password was Wrong");
        } else {
            $("#logindiv").css("display", "none");
        }
    });
});