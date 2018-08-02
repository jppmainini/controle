function revelaSenha(campo) {
    var x = document.getElementById(campo);
    if (x.type === "password") {
        x.type = "text";

    } else {
        x.type = "password";
    }
}