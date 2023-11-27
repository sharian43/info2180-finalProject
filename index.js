function submitForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Basic validation
    if (email.trim() === "" || password.trim() === "") {
        alert("Please enter both email and password.");
    } else {
        document.getElementById("loginForm").submit();
    }
}