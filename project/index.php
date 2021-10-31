<!DOCTYPE html>
<html>
<body>
<script>
var coo = navigator.geolocation.getCurrentPosition(coordinates);
function coordinates(position){
    console.log(position.coords.latitude);
    console.log(position.coords.longitude);
    var lat = position.coords.latitude;
    var long = position.coords.longitude;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function ()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var response = this.responseText;
            console.log(response);
        }
    };
    xhttp.open("POST", "ajax.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("lat="+lat+"&long=" + long);
    }
</script>
</body>
</html>