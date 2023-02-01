<?php
require_once 'authChecker.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hello, world!</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="description" content=""/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
            integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
          integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary vh-10">
        <div class="container-sm">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/index.php">Form page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin.php">Admin page</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="container-sm vh-90 d-flex align-items-center mt-4">
        <form action="action.php" class="form w-100 mh-100 vh-90 d-flex align-items-center flex-column" method="post">
            <div class="form-group w-100">
                <label for="textarea">
                    Delivery information (json):
                </label>
                <textarea name="deliveryJSON" id="textarea" cols="50" rows="34" class="form-control"
                          required style="resize: none;"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </form>
    </div>

</main>

<footer>
</footer>

<?php
if (isset($_SESSION['toastMessage']) && isset($_SESSION['toastType'])) {
	$title = ucfirst($_SESSION['toastType']);
	$message = $_SESSION['toastMessage'];
	$icon = $_SESSION['toastType'];

	$toast = "$.toast({
    heading: '$title',
    text: '$message',
    icon: '$icon'
    })";

    echo "<script>$toast</script>";

	unset($_SESSION['toastMessage']);
    unset($_SESSION['toastType']);
}
?>

</body>
</html>