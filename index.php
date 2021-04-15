<?php
//require_once "parseXML.php";
require_once "Database.php";
$conn = (new Database())->getConnection();

$stmt = $conn->query("SELECT title, code FROM countries");

$countries = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($countries, [$row["title"], $row["code"]]);
}

?>


<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REST API</title>

    <meta name="theme-color" content="#7952b3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body class="bg-light">

<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>REST API form</h2>
            <p class="lead">Try it out!</p>
        </div>

        <div class="row g-5 justify-content-center">
            <div class="col-md-8">
                <h4 class="mb-3">Získaj zoznam</h4>
                <form class="mb-5" id="specialsForm">
                    <div class="col-md-5">
                        <label for="specials" class="form-label">Získaj zoznam sviatkov alebo dní</label>
                        <select class="form-select" name="specials" id="specials" required>
                            <option value="">Choose...</option>
                            <option>CZsviatky</option>
                            <option>SKsviatky</option>
                            <option>SKdni</option>
                        </select>
                    </div>
                    <button class="w-25 mt-3 btn btn-primary" type="submit">Submit</button>
                </form>
                <hr>

                <h4 class="mb-3">Kto má meniny?</h4>
                <form class="mb-5" id="whoForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="whoCountry" class="form-label">Krajina</label>
                            <select class="form-select" name="whoCountry" id="whoCountry" required>
                                <option value="">Choose...</option>
                                <?php
                                foreach ($countries as $country){?>
                                    <option value="<?php echo $country[1] ?>"><?php echo $country[0]?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="whoDate" class="form-label">Dátum</label>
                            <input type="date" class="form-control" name="whoDate" id="whoDate" placeholder="" value="" required>
                        </div>
                    </div>

                    <button class="w-25 mt-3 btn btn-primary" type="submit">Submit</button>
                </form>
                <hr>

                <h4 class="mb-3">Kedy má meniny ...?</h4>
                <form class="mb-5" id="whenForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="whenCountry" class="form-label">Krajina</label>
                            <select class="form-select" name="whenCountry" id="whenCountry" required>
                                <option value="">Choose...</option>
                                <?php
                                foreach ($countries as $country){?>
                                    <option value="<?php echo $country[1] ?>"><?php echo $country[0]?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="whenName" class="form-label">Meno</label>
                            <input type="text" class="form-control" id="whenName" name="whenName" placeholder="" value="" required>
                        </div>
                    </div>
                    <button class="w-25 mt-3 btn btn-primary " type="submit">Submit</button>
                </form>
                <hr>

                <h4 class="mb-3">Pridaj nové meno</h4>
                <form class="mb-5" id="addForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="newDate" class="form-label">Dátum</label>
                            <input type="date" class="form-control" name="newDate" id="newDate" placeholder="" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="newName" class="form-label">Meno</label>
                            <input type="text" class="form-control" id="newName" name="newName" placeholder="" value="" required>
                        </div>
                    </div>
                    <button class="w-25 mt-3 btn btn-primary " type="submit">Submit</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="my-3 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<script>
    $( "#specialsForm" ).submit(function( event ) {
        event.preventDefault();
        $.get(
            "api/"+getValue("specials"),
            function(result) {
                console.log(result);
            }
        );
    });
    $( "#whoForm" ).submit(function( event ) {
        event.preventDefault();
        $.get(
            "api/"+getValue("whoCountry") +"/"+formatDateById("whoDate"),
            function(result) {
                console.log(result);
            }
        );

    });
    $( "#whenForm" ).submit(function( event ) {
        event.preventDefault();
        $.get(
            "api/"+ getValue("whenCountry") +"/"+ getValue("whenName"),
            function(result) {
                console.log(result);
            }
        );
    });
    $( "#addForm" ).submit(function( event ){
        event.preventDefault();
        $.post(
            "api/",
            {date: formatDateById("newDate"), name: getValue("newName")},
            function(result){
                console.log(result);
            }
        );
    });

    function getValue(elementId){
        return document.getElementById(elementId).value;
    }

    function formatDateById(elementId){
        let rawDate = getValue(elementId);
        return rawDate.substring(8, 10) + rawDate.substring(5, 7);
    }
</script>
</body>
</html>
