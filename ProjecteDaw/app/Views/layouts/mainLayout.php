<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/68a68b86d2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Tickets</title>
    <style>
        * {
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .bgc-1 {
            background-color: #333333;
        }

        .bgc-2 {
            background-color: #666666;
        }

        .bgc-3 {
            background-color: #999999;
        }

        .bgc-4 {
            background-color: #DDDDDD;
        }

        .bgc-5 {
            background-color: #F5F5F5;
        }

        .c-1 {
            color: #333333;
        }

        .c-2 {
            color: #666666;
        }

        .c-3 {
            color: #999999;
        }

        .c-4 {
            color: #DDDDDD;
        }

        .c-5 {
            color: #F5F5F5;
        }

        .menuButton {
            cursor: pointer;
            transition: background-color 1s ease-out;
        }

        .menuButton :hover {
            background-color: #C00000;
        }
    </style>
</head>

<body>
    <!-- <body class="m-0 p-0"> -->
    <div class="contain-fluid vh-100">
        <div class="col-12 px-5 bgc-1 py-3">
            <img src="<?= base_url('images/gencat_cat_blanc.png') ?>" alt="Logo" style="height: 24px">
            <!-- <img src="<? base_url('Logo.png') ?>" alt="Logo" style="max-width: 60px"> -->
        </div>
        <div class="col-2 h-100 bgc-1 c-5"><!--TODO: col-2 no me agrade -->
            <div class="col-12 menuButton">
                <h5 class="py-3 mb-0">
                    <i class="fa-solid fa-ticket-simple ms-3 me-2"></i>
                    Tickets
                </h5>
            </div>
            <div class="col-12 menuButton">
                <h5 class="py-3 mb-0">
                    <i class="fa-solid fa-ticket-simple ms-3 me-2"></i>
                    Tickets
                </h5>
            </div>
            <div class="col-12 menuButton">
                <h5 class="py-3 mb-0">
                    <i class="fa-solid fa-ticket-simple ms-3 me-2"></i>
                    Tickets
                </h5>
            </div>
        </div>
        <div class="col-10">
            <?php echo $this->renderSection("main_content") ?>
        </div>
    </div>
</body>

</html>