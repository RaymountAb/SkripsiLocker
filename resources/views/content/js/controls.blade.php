<script>
    function changestatus1(value)
    {
        if(value==true) value='ON';
        else value = "OFF";
        document.getElementById('status1').innerHTML = value;

        //ajax relay 1
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                // ambil respon web
                document.getElementById('status1').innerHTML = xmlhttp.responseText;
            }
        }
        //execute nilai database
        xmlhttp.open("GET", )
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