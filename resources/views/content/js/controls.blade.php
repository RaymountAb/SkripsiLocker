<script>
    function changestatus1(value)
    {
        if(value==true) value='ON';
        else value = "OFF";
        document.getElementById('status1').innerHTML = value;

        //Create XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        //Define the request URL
        var url = "/get-status/loker1/1";

        // Define the request method
        xmlhttp.open('GET', url, true);

        // Define the callback function when the request completes
        xmlhttp.onload = function() {
            if (xmlhttp.status === 200) {
                // Request successful
                var response = JSON.parse(xmlhttp.responseText);
                var statusElement = document.getElementById('status1');
                statusElement.textContent = response.status;
            } else {
                // Request failed
                console.error('Request failed. Status: ' + xmlhttp.status);
            }
        };
        // Send the request
        xhr.send();
    }

    function changestatus2(value)
    {
        if(value==true) value='ON';
        else value = "OFF";
        document.getElementById('status2').innerHTML = value;

        //ajax relay 2
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                // ambil respon web
                document.getElementById('status2').innerHTML = xmlhttp.responseText;
            }
        }
        //execute nilai database
        xmlhttp.open("GET", )
    }

    function changestatus3(value)
    {
        if(value==true) value='ON';
        else value = "OFF";
        document.getElementById('status3').innerHTML = value;

        //ajax relay 3
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                // ambil respon web
                document.getElementById('status3').innerHTML = xmlhttp.responseText;
            }
        }
        //execute nilai database
        xmlhttp.open("GET", )
    }

    function changestatus4(value)
    {
        if(value==true) value='ON';
        else value = "OFF";
        document.getElementById('status4').innerHTML = value;

        //ajax relay 4
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                // ambil respon web
                document.getElementById('status4').innerHTML = xmlhttp.responseText;
            }
        }
        //execute nilai database
        xmlhttp.open("GET", )
    }
</script>