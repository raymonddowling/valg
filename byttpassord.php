<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bytt Passord</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/forms.css">
    <script src="js/hamburger.js"></script>
</head>
<body>
    <header>
        <nav id="menu">
            <a href="index.html"> <img class="dtpics" src="images/election.png" alt="valgurne" height="100" width="130"> </a>
            <button onclick=toggleMenu()>MENY</button>
            <ul id="menuitems">
                <li id="home"><a href="index.html">Home</a></li>
				<li><a href="nominering.html">Nominering</a></li>
				<li><a href="avstemning.html">Avstemning</a></li>
				<li><a href="registering.html">Registering</a></li>
				<li><a href="logginn.html">Logg inn</a></li>
            </ul>
        </nav>
    </header>
<main>
          <form action="php/oppdater_password.php" method="post">
            <div class="form-group">
              <label for="oldpassword" style="">Gamle passord</label>
              <input type="password" class="form-control" name="old_pass" id="oldpassword" placeholder="Gamle passord...">
            </div>
            <div class="form-group">
              <label for="newpassword" style="">Nytt ønsket passord</label>
              <input type="password" class="form-control" name="new_pass" id="newpassword" placeholder="Nytt passord...">
            </div>
            <div class="form-group">
              <label for="repeatpassword" style="">Gjenta det nye passordet</label>
              <input type="password" class="form-control" name="re_pass" id="repeatpassword" placeholder="Gjenta det nye passordet...">
            </div>
            <button type="submit" name="re_password" class="registerknapp">Bytt</button>
          </form>

      </div>

    </div>
</main>

<footer>
        <h3>Kontakt oss</h3>
        <p> Email: r-15@teams.usn.no <span class="copy">&copy; Gruppe R-15 2020</span></p>
</footer>

  </body>

</html>
