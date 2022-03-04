<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Városok</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <?php
        require_once('config.php');
        
        if($conn) {
            $result = $conn->query("SELECT name FROM regions ORDER BY name");
            $regions = $result->fetch_all(MYSQLI_ASSOC);
        }   
    ?>  
</head>
<body>
    <div class="warpper">
        <div class="left">
            <div class="box">
                <h1>Megye:</h1>
                <form method="POST" action="">
                    <select class="select" id="mySelect" name="Megye" onchange="myFunction()" >
                        <option value="" disabled selected>Válasszon</option> 
                        <?php foreach($regions as $region) { ?>
                            <option value=" <?php echo $region['name']; ?> "> <?php echo $region['name']; ?> </option>   
                        <?php } ?> 
                    </select>
                </form>
            </div>
            <div class="new" id="new"></div>   
        </div>
        <div class="right" id="app"></div>
        <?php include "template.html" ?>  
    </div>  
    <div class="copyright">
        <p >@2022 BÁLINT</p>
        <p>ALL RIGHTS RESERVED</p>
    </div>

</body>
<script>
    var editcityname;
    var editcityid;

    function myFunction() {
            const myNode = document.getElementById("app");
            myNode.innerHTML = '';
            var x = document.getElementById("mySelect").value;
            var temp1;
            switch(x) {
                case ' Bács-Kiskun ':
                    temp1 = document.getElementById("egy").content;
                    break;
                case ' Baranya ':
                    temp1 = document.getElementById("ketto").content;
                    break;
                case ' Békés ':
                    temp1 = document.getElementById("harom").content;
                    break;
                case ' Borsod-Abaúj-Zemplén ':
                    temp1 = document.getElementById("negy").content;
                    break;
                case ' Csongrád-Csanád ':
                    temp1 = document.getElementById("ot").content;
                    break;
                case ' Fejér ':
                    temp1 = document.getElementById("hat").content;
                    break;
                case ' Győr-Moson-Sopron ':
                    temp1 = document.getElementById("het").content;
                    break;
                case ' Hajdú-Bihar ':
                    temp1 = document.getElementById("nyolc").content;
                    break;
                case ' Heves ':
                    temp1 = document.getElementById("kilenc").content;
                    break;
                case ' Jász-Nagykun-Szolnok ':
                    temp1 = document.getElementById("tiz").content;
                    break;
                case ' Komárom-Esztergom ':
                    temp1 = document.getElementById("tegy").content;
                    break;
                case ' Nógrád ':
                    temp1 = document.getElementById("tketto").content;
                    break;
                case ' Pest ':
                    temp1 = document.getElementById("tharom").content;
                    break;
                case ' Somogy ':
                    temp1 = document.getElementById("tnegy").content;
                    break;
                case ' Szabolcs-Szatmár-Bereg ':
                    temp1 = document.getElementById("tot").content;
                    break;
                case ' Tolna ':
                    temp1 = document.getElementById("that").content;
                    break;
                case ' Vas ':
                    temp1 = document.getElementById("thet").content;
                    break;
                case ' Veszprém ':
                    temp1 = document.getElementById("tnyolc").content;
                    break;
                case ' Zala ':
                    temp1 = document.getElementById("tkilenc").content;
                    break;
            }
            var copyHTML = document.importNode(temp1,true);
            document.getElementById("app").appendChild(copyHTML);

            x = x.slice(1, -1);
            if (x) {
                $.ajax({
                type: 'post',
                url: 'getdata.php',
                data: {
                name:x,
                },
                success: function (response) {
                $('#res').html(response);
                }
                });
                $.ajax({
                            type: 'post',
                            url: 'next.php',
                            data: {
                            x:x,
                        },
                        success: function (response) {
                            $('#new').html(response);
                        }
                        });
                } else {
                    console.log("fail2");
                }
            
    }
    $(document).ready(function() {
        $(document).on('click', '#delete', function() {
            var id = $(this).data("id3");
            var x= $(this).data("id4");
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "text",
                    success: function(data) {
                        alert(data);
                        $.ajax({
                            type: 'post',
                            url: 'data.php',
                            data: {
                            id:x,
                        },
                        success: function (response) {
                            $('#res').html(response);
                        }
                        });
                    }
                });
            }
        });
        $(document).on('click', '#cancel', function() {
            var x= $(this).data("id4");
            
            $.ajax({
                type: 'post',
                url: 'data.php',
                data: {
                    id:x,
                },
                success: function (response) {
                    $('#res').html(response);
                }
            });
            
        });
        $(document).on('click', '#edit', function() {
            var x= $(this).data("id4");
            if (confirm("Are you sure you want to edit this?")) {
            $.ajax({
                type: 'post',
                url: 'edit.php',
                data: {
                    id:editcityid,
                    name: editcityname,
                },
                success: function (response) {
                        $.ajax({
                            type: 'post',
                            url: 'data.php',
                            data: {
                            id:x,
                        },
                        success: function (response) {
                            $('#res').html(response);
                        }
                        });
                }
            });
            }    
        });
        $(document).on('click', '#insert', function() {
            var inputid = $(this).data("id3");
            if (confirm("Are you sure you want to add this?")) {
                $.ajax({
                            type: 'post',
                            url: 'insert.php',
                            data: {
                                id: inputid,
                                name: document.getElementById('textbox_id').value

                        },
                        success: function (response) {
                            $.ajax({
                            type: 'post',
                            url: 'data.php',
                            data: {
                            id: inputid,
                        },
                        success: function (response) {
                            $('#res').html(response);
                            
                        }
                        });
                        }
                        });
                }
        });
        $(document).on('blur', '.editcity', function() {
            editcityid = $(this).data("id1");
            editcityname = $(this).text();
        });


          
    });

</script>

<?php  
$conn->close(); ?>
</html>