//app.js: js for handling dashboard functionalities

//Function to refresh the dashboard after every 5 seconds
function refreshDashboard(){
    setTimeout(function(){
        window.location.reload();}, 5000
    );

    window.onload= function(){
        refreshDashboard();
    }
}