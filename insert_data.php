<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style/css/kereses.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Lakáskereső</title>


</head>
<body id="main_page_margine">
<div class="keres_form">
    <form id="myForm" action="connect_insert.php" enctype="multipart/form-data" method="POST">
        <div class="container-fluid full_search">
            <div class="col-md-6 col-md-offset-3">
                <br> <input type="text" class="form-control" id="cim" name="cim" placeholder="Cim"  pattern=".{5,}" title="Csak betuket es szamokat irhat." required/>
            </div>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <br><select required id="varos" class="varos_keres" name="varos" >
                    <option value="--">Varos</option>
                    <option value="Kolozsvar">Kolozsvar</option>
                    <option value="Varad">Varad</option>
                    <option value="Braso">Braso</option>
                    <option value="Hunyad">Hunyad</option>
                </select></div>

            <div class="col-md-6 col-md-offset-3">
                <br> <input type="text" id="terulet" name="terulet" class="form-control" placeholder="Terulet"  pattern="[0-9 ]{1,}" title="Csak szamokat irhat. " required>
            </div>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <br> <select required id="penz" class="penz_keres" name="penz" >
                    <option value="--"> Penzerme</option>
                    <option value="RON">RON</option>
                    <option value="EURO">EURO</option>
                    <option value="FORINT">FORINT</option>
                </select></div>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <br><input type="text" id="ara" name="ara" class="form-control" placeholder="Ára"  pattern="[0-9]{1,}" title="Csak szamokat irhat. " required>
            </div>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <br> <input type="text" id="szobaszam" name="szobaszam" class="form-control"
                            placeholder=" Szobák száma"   pattern="[0-9]{1,}" title="Csak szamokat irhat." required />
            </div>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <br> <textarea cols="30" rows="5" name="comment" id="comment" class="form-control" required title="Kerem toltse ki!  "></textarea>
            </div>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <br> <input type="file" name="file" />
            </div>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <button class="btn btn-default dropdown-toggle keres_button" name="kereses" id="kereses1" type="submit"
                >Feltöltés</button>

            </div>
        </div>
</div>
</form>
</div>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
