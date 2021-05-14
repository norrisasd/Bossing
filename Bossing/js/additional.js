const rmCheck = document.getElementById("rememberMe"),
    userInput = document.getElementById("username");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  userInput.value = localStorage.username;
} else {
  rmCheck.removeAttribute("checked");
  userInput.value = "";
}

function lsRememberMe() {
  if (rmCheck.checked && userInput.value !== "") {
    localStorage.username = userInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.checkbox = "";
  }
}

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}