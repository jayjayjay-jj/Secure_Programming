<?php
    session_start();
    // require "../../controllers/authController.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki-Medic</title>
    <link rel="shortcut icon" href="../pics/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../header.css">
</head>

<body>
    <header>
        <div class="name">
            <a href="../homepage/hompage.html"><img src="../pics/logo1.png" alt=""></a>
        </div>
        <div class="navbar">
            <a href="../register.php">Register</a>
        </div>
    </header>
    <div class="greetings">
        <h2><b>Wiki-Medic Dictionary</b></h2>
    </div>
    <main>
        <div id="greetings1">
            <h1>View Only</h1>
        </div>
        <div class="leaderboard"></div>
        <table class="center">
            <tr class="col1">
                <th>No.</th>
                <th>Name</th>
                <th>Description</th>
                <th>More info</th>
            </tr>
            <!-- <tr>
                <td class="number">1</td>
                <td class="uname">Heimz</td>
                <td class="kill">40</td>
                <td class="accuracy">95%</td>
                <td class="points">398.254</td>
            </tr>
            <tr>
                <td class="number">2</td>
                <td class="uname">Shelby</td>
                <td class="kill">37</td>
                <td class="accuracy">91%</td>
                <td class="points">368.144</td>
            </tr>
            <tr>
                <td class="number">3</td>
                <td class="uname">Jane</td>
                <td class="kill">34</td>
                <td class="accuracy">87%</td>
                <td class="points">308.193</td>
            </tr>
            <tr>
                <td class="number">4</td>
                <td class="uname">Jonathan</td>
                <td class="kill">30</td>
                <td class="accuracy">84%</td>
                <td class="points">298.752</td>
            </tr>
            <tr>
                <td class="number">5</td>
                <td class="uname">Andy</td>
                <td class="kill">21</td>
                <td class="accuracy">72%</td>
                <td class="points">158.298</td>
            </tr> -->
        </table>
        <br>
        <br>
        <div class="out">
            <a href="../register.php">Exit</a>
        </div>
        </div>
    </main>
    <Footer class="foot">
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </Footer>
</body>

</html>