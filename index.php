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
                <form class="mb-5">
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
                <form class="mb-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="country" class="form-label">Krajina</label>
                            <select class="form-select" name="country" id="country" required>
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
                            <label for="date" class="form-label">Dátum</label>
                            <input type="date" class="form-control" name="date" id="date" placeholder="" value="" required>
                        </div>
                    </div>

                    <button class="w-25 mt-3 btn btn-primary" type="submit">Submit</button>
                </form>
                <hr>

                <h4 class="mb-3">Kedy má meniny ...?</h4>
                <form class="mb-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="country" class="form-label">Krajina</label>
                            <select class="form-select" name="country" id="country" required>
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
                            <label for="name" class="form-label">Meno</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
                        </div>
                    </div>
                    <button class="w-25 mt-3 btn btn-primary " type="submit">Submit</button>
                </form>
                <hr>

                <h4 class="mb-3">Pridaj nové meno</h4>
                <form class="mb-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label">Dátum</label>
                            <input type="date" class="form-control" name="date" id="date" placeholder="" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Meno</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>
