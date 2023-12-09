document.addEventListener("DOMContentLoaded", function () {
    // Get the form element
    var loginForm = document.querySelector('#login form');
    
     // Function to handle the login
     function handleLogin(email, password) {
        // You can perform additional client-side validation here

        // Send the form data to the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'login.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Successful login
                    console.log('Login successful');
                    if (email=="admin@project2.com"){
                        console.log(email);
                        window.location.href = 'addUser.php';  
                        
                    }
                    else{window.location.href = 'dashboard.php';} // Redirect to the dashboard
                } else {
                    // Failed login
                    console.error('Login failed');
                }
            }
        };

        // Prepare the data for sending
        var data = 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);

        // Send the request
        xhr.send(data);
    }


    // Attach an event listener to the form submission
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the values from the form
        var email = loginForm.querySelector('[name="email"]').value;
        var password = loginForm.querySelector('[name="password"]').value;

        // Call a function to handle the login
        handleLogin(email, password);
    });

   
});
