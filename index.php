<?php
// Definizione dell'array degli hotel
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

// Filtri
$parkingFilter = ($_GET['parking'] ?? '') == 'on'; // Verifica se il filtro parcheggio è attivo, considerando un valore vuoto se il parametro "parking" non è definito
$ratingFilter = ($_GET['rating'] ?? '0'); // Legge il filtro di voto dalla richiesta GET, considerando '0' come valore predefinito se il parametro "rating" non è definito

// Array degli hotel filtrati
$filteredHotels = [];

// Ciclo per filtrare
foreach ($hotels as $hotel) {
    // Verifica se l'hotel soddisfa i filtri
    $filterConditionsMet = (!$parkingFilter || $hotel['parking']) && ($ratingFilter === '0' || $hotel['vote'] >= $ratingFilter);

    // Se l'hotel soddisfa i filtri, lo aggiungiamo all'array dei risultati filtrati
    if ($filterConditionsMet) {
        $filteredHotels[] = $hotel;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>PHP Hotel</title>
</head>
<body>
    <div class="container">
        <h1>Elenco Hotel</h1>

        <form method="GET">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="parking" id="parkingFilter" <?php if ($parkingFilter) echo 'checked'; ?>>
                <label class="form-check-label" for="parkingFilter">Filtro Parcheggio</label>
            </div>

            <div class="form-group">
                <label for="ratingFilter">Voto minimo:</label>
                <select class="form-control" name="rating" id="ratingFilter">
                    <option value="1">1 stella</option>
                    <option value="2">2 stelle</option>
                    <option value="3">3 stelle</option>
                    <option value="4">4 stelle</option>
                    <option value="5">5 stelle</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Applica Filtri</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome Hotel</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza al Centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredHotels as $hotel) : ?>
                    <tr>
                        <td><?php echo $hotel['name']; ?></td>
                        <td><?php echo $hotel['description']; ?></td>
                        <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
                        <td><?php echo $hotel['vote']; ?> stelle</td>
                        <td><?php echo $hotel['distance_to_center']; ?> km</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
