<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Number</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Generează un număr aleatoriu</h1>

<form id="random-number-form">
    <label for="min">Min:</label>
    <input type="number" id="min" name="min" value="1" required>

    <label for="max">Max:</label>
    <input type="number" id="max" name="max" value="100" required>

    <button type="submit" style="padding: 10px 20px; font-size: 16px;">Generează</button>
</form>

<p id="random-number" style="font-size: 24px; font-weight: bold; margin-top: 20px;"></p>

<script>
    $(document).ready(function () {
        $('#random-number-form').submit(function (event) {
            event.preventDefault();

            let min = $('#min').val();
            let max = $('#max').val();

            if (parseInt(min) >= parseInt(max)) {
                $('#random-number').text("Eroare: Min trebuie să fie mai mic decât Max!");
                return;
            }

            $.ajax({
                url: '/get-random-number',
                type: 'GET',
                data: { min: min, max: max },
                success: function (response) {
                    if (response.randomNumber !== undefined) {
                        $('#random-number').text("Număr generat: " + response.randomNumber);
                    } else {
                        $('#random-number').text("Eroare: " + response.error);
                    }
                },
                error: function (xhr) {
                    $('#random-number').text("Eroare la request: " + xhr.responseJSON.error);
                }
            });
        });
    });
</script>
</body>
</html>
