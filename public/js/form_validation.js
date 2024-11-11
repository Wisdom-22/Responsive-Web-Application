// Client-side form validation using the JustValidate library

// Create a new instance of JustValidate for the signup form
const validation = new JustValidate('#signup');

// Add validation rules for each form field
validation
    .addField("#f_name", [
        {
            rule: "required" // First name is required
        }
    ])
    .addField("#l_name", [
        {
            rule: "required" // Last name is required
        }
    ])
    .addField("#username", [
        {
            rule: "required" // Username is required
        }
    ])
    .addField("#email", [
        {
            rule: "required" // Email is required
        },
        {
            rule: "email" // Email must be a valid email format
        },
        {
            // Custom validator to check if the email is already taken
            validator: (value) => () => {
                return fetch('../../app/controllers/validate_email.php?email=' + encodeURIComponent(value))
                       .then(function(response) {
                           return response.json();
                       })
                       .then(function(json) {
                           return json.available;
                       });
            },
            errorMessage: "email already taken" // Error message if email is already taken
        }
    ])
    .addField("#password", [
        {
            rule: "required" // Password is required
        },
        {
            rule: "password" // Password must meet password strength criteria
        }
    ])
    .addField("#confirm_password", [
        {
            // Custom validator to check if the confirm password matches the password field
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match" // Error message if passwords don't match
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit(); // Submit the form if validation is successful
    });
