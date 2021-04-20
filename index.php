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
            <h2 class="">REST API Dokumentácia</h2>
<!--            <p class="lead">Try it out!</p>-->
            <button id="docButton" class="mt-3 btn btn-primary" >Dokumentácia</button>
        </div>

        <div id="doc" class="row g-5 justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <h5 class="card-header">České sviatky</h5>
                    <div class="card-body">
                        <h6 class="card-title text-primary">PATH</h6>
                        <p class="card-text">GET /api/CZsviatky</p>
                        <h6 class="card-title mt-4 text-primary">DECRIBTION</h6>
                        <p class="card-text">získa zoznam všetkých sviatkov v Čechách spolu s dňom, na ktorý tieto sviatky pripadajú</p>
                        <h6 class="card-title mt-4 text-primary">RESPONSES</h6>
                        <p class="text-success">200 Success</p>
                        <span class="card-text">JSON, structure:</span>
                        <p class="card-text"><b>date</b>(string): <b>holidayName</b>(string)</p>
                        <hr>
                        <p class="text-danger">404 Not Found</p>
                        <p class="card-text">Wrong URL</p>
                        <a href="#specialsForm" class="btn btn-primary">Vyskúšaj</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <h5 class="card-header ">Slovenské sviatky</h5>
                    <div class="card-body">
                        <h6 class="card-title text-primary">PATH</h6>
                        <p class="card-text">GET /api/SKsviatky</p>
                        <h6 class="card-title mt-4 text-primary">DECRIBTION</h6>
                        <p class="card-text">získa zoznam všetkých sviatkov na Slovensku spolu s dňom, na ktorý tieto sviatky pripadajú</p>
                        <h6 class="card-title mt-4 text-primary">RESPONSES</h6>
                        <p class="text-success">200 Success</p>
                        <span class="card-text">JSON, structure:</span>
                        <p class="card-text"><b>date</b>(string): <b>holidayName</b>(string)</p>
                        <hr>
                        <p class="text-danger">404 Not Found</p>
                        <p class="card-text">Wrong URL</p>
                        <a href="#specialsForm" class="btn btn-primary">Vyskúšaj</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <h5 class="card-header ">Slovenské pamätné dni</h5>
                    <div class="card-body">
                        <h6 class="card-title text-primary">PATH</h6>
                        <p class="card-text">GET /api/SKdni</p>
                        <h6 class="card-title mt-4 text-primary">DECRIBTION</h6>
                        <p class="card-text">získa zoznam všetkých pamätných dní na Slovensku spolu s dňom, na ktorý tieto dni pripadajú</p>
                        <h6 class="card-title mt-4 text-primary">RESPONSES</h6>
                        <p class="text-success">200 Success</p>
                        <span class="card-text">JSON, structure:</span>
                        <p class="card-text"><b>date</b>(string): <b>memorialName</b>(string)</p>
                        <hr>
                        <p class="text-danger">404 Not Found</p>
                        <p class="card-text">Wrong URL</p>
                        <a href="#specialsForm" class="btn btn-primary">Vyskúšaj</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <h5 class="card-header ">Kto má meniny podľa dátumu</h5>
                    <div class="card-body">
                        <h6 class="card-title text-primary">PATH</h6>
                        <p class="card-text">GET /api/{date}</p>
                        <h6 class="card-title mt-4 text-primary">DECRIBTION</h6>
                        <p class="card-text">na základe zadaného dátumu získa informáciu, kto má v daný deň meniny na Slovensku, resp. v niektorom inom uvedenom štáte</p>
                        <h6 class="card-title mt-4 text-primary">REQUEST PARAMETERS</h6>
                        <hr>
                        <table class="table table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th class="text-end pe-4 col-md-6">date: string</th>
                                <td >Date</td>
                            </tr>
                            <tr>
                                <th class="text-end pe-4 col-md-6">format:</th>
                                <td>ddmm</td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6"><span class="badge bg-danger">required</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6">in path</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h6 class="card-title mt-4 text-primary">EXAMPLE</h6>
                        <p class="card-text">/api/2804</p>
                        <h6 class="card-title mt-4 text-primary">RESPONSES</h6>
                        <p class="text-success">200 Success</p>
                        <span class="card-text">JSON, structure:</span>
                        <p class="card-text"><b>countryCode</b>(string): <b>names</b>(Array&#60;string&#62;)</p>
                        <hr>
                        <p class="text-danger">400 Bad Request</p>
                        <p class="card-text">Invalid date</p>
                        <hr>
                        <p class="text-danger">404 Not Found</p>
                        <p class="card-text">Nobody found</p>
                        <a href="#whoForm" class="btn btn-primary">Vyskúšaj</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <h5 class="card-header">Kedy má osoba meniny v danom štáte</h5>
                    <div class="card-body">
                        <h6 class="card-title text-primary">PATH</h6>
                        <p class="card-text">GET /api/{code}/{name}</p>
                        <h6 class="card-title mt-4 text-primary">DECRIBTION</h6>
                        <p class="card-text">na základe uvedeného mena a štátu získa informáciu, kedy má osoba s týmto menom meniny v danom štáte</p>
                        <h6 class="card-title mt-4 text-primary">REQUEST PARAMETERS</h6>
                        <hr>
                        <table class="table table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th class="text-end pe-4 col-md-6">code: string</th>
                                <td >State code</td>
                            </tr>
                            <tr>
                                <th class="text-end pe-4 col-md-6">format:</th>
                                <td>XY</td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6"><span class="badge bg-danger">required</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6">in path</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th class="text-end pe-4 col-md-6">name: string</th>
                                <td >Name</td>
                            </tr>
                            <tr>
                                <th class="text-end pe-4 col-md-6">format:</th>
                                <td>characters only, at least one</td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6"><span class="badge bg-danger">required</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6">in path</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h6 class="card-title mt-4 text-primary">EXAMPLE</h6>
                        <p class="card-text">/api/SK/2804</p>
                        <h6 class="card-title mt-4 text-primary">RESPONSES</h6>
                        <p class="text-success">200 Success</p>
                        <span class="card-text"><b>date</b>(string)</span>
                        <p class="card-text">Example: 12.3.</p>
                        <hr>
                        <p class="text-danger">404 Not Found</p>
                        <p class="card-text">Wrong country code or nobody found</p>
                        <a href="#whenForm" class="btn btn-primary">Vyskúšaj</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <h5 class="card-header">Vlož nové meno k určitému dňu</h5>
                    <div class="card-body">
                        <h6 class="card-title text-primary">PATH</h6>
                        <p class="card-text">POST /api</p>
                        <h6 class="card-title mt-4 text-primary">DECRIBTION</h6>
                        <p class="card-text">vloží nové meno do kalendára k určitému dňu</p>
                        <h6 class="card-title mt-4 text-primary">REQUEST PARAMETERS</h6>
                        <hr>
                        <table class="table table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th class="text-end pe-4 col-md-6">date: string</th>
                                <td >Date</td>
                            </tr>
                            <tr>
                                <th class="text-end pe-4 col-md-6">format:</th>
                                <td>ddmm</td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6"><span class="badge bg-danger">required</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6">in path</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th class="text-end pe-4 col-md-6">name: string</th>
                                <td >Name</td>
                            </tr>
                            <tr>
                                <th class="text-end pe-4 col-md-6">format:</th>
                                <td>characters only, at least one</td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6"><span class="badge bg-danger">required</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-end pe-4 col-md-6">in path</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h6 class="card-title mt-4 text-primary">RESPONSES</h6>
                        <p class="text-success">200 Success</p>
                        <p class="card-text">Status message</p>
                        <hr>
                        <p class="text-danger">400 Bad Request</p>
                        <p class="card-text">Invalid date</p>
                        <a href="#addForm" class="btn btn-primary">Vyskúšaj</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>


        <div class="py-5 text-center">
            <h2>REST API formuláre</h2>
            <p class="lead">Vyskúšaj si to!</p>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-md-8">
                <h4 class="mb-3">Získaj zoznam</h4>
                <form class="mb-2" id="specialsForm">
                    <div class="col-md-5">
                        <label for="specials" class="form-label">Získaj zoznam sviatkov alebo dní</label>
                        <select class="form-select" name="specials" id="specials" required>
                            <option value="">Choose...</option>
                            <option>CZsviatky</option>
                            <option>SKsviatky</option>
                            <option>SKdni</option>
                        </select>
                    </div>
                    <button class="mt-3 btn btn-primary" type="submit">Submit</button>
                </form>
                <div class="form-floating mb-5">
                    <textarea class="form-control" placeholder="Leave a comment here" id="listArea"></textarea>
                    <label for="listArea">Result</label>
                </div>
                <hr>

                <h4 class="mb-3">Kto má meniny?</h4>
                <form class="mb-3" id="whoForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="whoDate" class="form-label">Dátum</label>
                            <input type="date" class="form-control" name="whoDate" id="whoDate" placeholder="" value="" required>
                        </div>
                    </div>

                    <button class="mt-3 btn btn-primary" type="submit">Submit</button>
                </form>
                <div class="form-floating mb-5">
                    <textarea class="form-control" placeholder="Leave a comment here" id="whoArea"></textarea>
                    <label for="whoArea">Result</label>
                </div>
                <hr>

                <h4 class="mb-3">Kedy má meniny ...?</h4>
                <form class="mb-3" id="whenForm">
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
                    <button class="mt-3 btn btn-primary " type="submit">Submit</button>
                </form>
                <div class="form-floating mb-5">
                    <textarea class="form-control" placeholder="Leave a comment here" id="whenArea"></textarea>
                    <label for="whenArea">Result</label>
                </div>
                <hr>

                <h4 class="mb-3">Pridaj nové meno</h4>
                <form class="mb-3" id="addForm">
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
                    <button class="mt-3 btn btn-primary " type="submit">Submit</button>
                </form>
                <div class="form-floating mb-5">
                    <textarea class="form-control" placeholder="Leave a comment here" id="addArea"></textarea>
                    <label for="addArea">Result</label>
                </div>
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
    $('#docButton').click(function() {
        $('#doc').toggle();
    });

    $( "#specialsForm" ).submit(function( event ) {
        event.preventDefault();
        $.get(
            "api/"+getValue("specials"),
            function(data) {
                console.log(typeof data);
                console.log(data);
                $( "#listArea" ).val(JSON.stringify(data));
            }
        );
    });
    $( "#whoForm" ).submit(function( event ) {
        event.preventDefault();
        $.get(
            "api/"+formatDateById("whoDate"),
            function(data) {
                console.log(typeof data);
                console.log(data);
                $( "#whoArea" ).val(JSON.stringify(data));
            }
        ).fail(function(data, status, xhr) {
            $( "#whoArea" ).val(xhr);
        });

    });
    $( "#whenForm" ).submit(function( event ) {
        event.preventDefault();
        $.get(
            "api/"+ getValue("whenCountry") +"/"+ getValue("whenName"),
            function(data) {
                console.log(typeof data);
                console.log(data);
                $( "#whenArea" ).val(JSON.stringify(data));
            }
        ).fail(function(data, status, xhr) {
            $( "#whenArea" ).val(xhr);
        });
    });
    $( "#addForm" ).submit(function( event ){
        event.preventDefault();
        $.post(
            "api/",
            {date: formatDateById("newDate"), name: getValue("newName")},
            function(data, status){
                $( "#addArea" ).val(status);
            }
        ).fail(function(data, status, xhr) {
            $( "#addArea" ).val(xhr);
        });
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
