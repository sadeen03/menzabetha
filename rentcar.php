<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menzabetha Car Rentals</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Arial', sans-serif; background: #f2f2f2; padding: 20px; }
    nav {
      display: flex; justify-content: space-between; align-items: center;
      background-color: #fff; padding: 20px 60px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .logo { font-size: 24px; font-weight: bold; font-family: 'Cairo', sans-serif; }
    .nav-links { display: flex; gap: 30px; }
    .nav-links a {
      text-decoration: none; color: #000; font-size: 16px; font-weight: 500;
    }
    .nav-links a:hover { color: #4486ad; }

    .container {
      max-width: 900px; margin: auto; background: white;
      padding: 30px; border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1, h2 { text-align: center; color: #333; margin: 20px 0; }

    form {
      display: flex; gap: 10px; margin-bottom: 30px;
    }

    input, button {
      padding: 10px; border-radius: 6px; font-size: 16px;
    }

    button {
      background-color: #4486ad; color: white; border: none; cursor: pointer;
    }

    .activity-card {
      border: 1px solid #ddd; border-radius: 10px;
      padding: 15px; margin-bottom: 20px; background: #fff;
      display: flex; gap: 15px; align-items: center;
    }
  </style>
</head>
<body>

<nav>
  <div class="logo">منزبطها</div>
  <div class="nav-links">
    <a href="home.php">Home</a>
    <a href="about.php">About</a>
    <a href="package.php">Package</a>
    <a href="book.php">Book</a>
    <a href="index.php">Login</a>
  </div>
</nav>

<div class="container">
  <h1>Find a Rental Car</h1>
  <form method="GET" action="">
    <input type="text" name="city" placeholder="e.g. Amman" required>
    <button type="submit">Search</button>
  </form>

<?php
// Fake API call
function fetchCars($city) {
    return [
        [
            'model' => "Toyota Corolla",
            'description' => 'Reliable and fuel-efficient sedan.',
           
            'image' => 'http://localhost/project101/back/travel/images/car1.jpg',
            'duration' => 'Daily rental',
            'location' => $city
        ]
    ];
}

if (isset($_GET['city'])) {
    $city = htmlspecialchars($_GET['city']);
    $cars = fetchCars($city);

    if (empty($cars)) {
        echo "<p>No rental cars found in '$city'.</p>";
    } else {
        foreach ($cars as $car) {
            $model = htmlspecialchars($car['model']);
            $description = htmlspecialchars($car['description']);
            
            $image = htmlspecialchars($car['image']);
            $duration = htmlspecialchars($car['duration']);
            $location = htmlspecialchars($car['location']);

            echo "<div class='activity-card'>
                    <img src='$image' alt='$model' style='width: 150px; height: 100px; object-fit: cover; border-radius: 8px;'>
                    <div>
                      <h3>$model</h3>
                      <p>$description</p>
                      
                      <p><strong>Rental Term:</strong> $duration</p>
                      <p><strong>Location:</strong> $location</p>
                      <form method='POST' action='add_to_wishlist.php'>
                          <input type='hidden' name='item_id' value='car_$model'>
                          <input type='hidden' name='item_type' value='car'>
                          <input type='hidden' name='name' value='$model'>
                          
                          <button type='submit'>Add to Wishlist</button>
                      </form>
                    </div>
                  </div>";
        }
    }
}
?>

<h2>Suggested Cars</h2>

<?php
$suggestedCars = [
    [
        'model' => 'Hyundai Elantra',
        'desc' => 'Comfortable sedan perfect for city drives.',
        
        'img' => 'http://localhost/project101/back/travel/images/car2.jpg',
        'duration' => 'Daily rental',
        'location' => 'Amman'
    ],
    [
        'model' => 'Kia Sportage',
        'desc' => 'Spacious SUV ideal for family trips.',
        
        'img' => 'http://localhost/project101/back/travel/images/car3.jpg',
        'duration' => 'Daily rental',
        'location' => 'Aqaba'
    ],
    [
        'model' => 'Suzuki Swift',
        'desc' => 'Compact and easy to park, great for tight spaces.',
        
        'img' => 'http://localhost/project101/back/travel/images/car4.jpg',
        'duration' => 'Daily rental',
        'location' => 'Irbid'
    ]
];

foreach ($suggestedCars as $car) {
    echo "<div class='activity-card'>
            <img src='{$car['img']}' alt='{$car['model']}' style='width: 150px; height: 100px; object-fit: cover; border-radius: 8px;'>
            <div>
              <h3>{$car['model']}</h3>
              <p>{$car['desc']}</p>
              
              <p><strong>Rental Term:</strong> {$car['duration']}</p>
              <p><strong>Location:</strong> {$car['location']}</p>
              <form method='POST' action='add_to_wishlist.php'>
                <input type='hidden' name='item_id' value='car_{$car['model']}'>
                <input type='hidden' name='item_type' value='car'>
                <input type='hidden' name='name' value='{$car['model']}'>
                
                <button type='submit'>Add to Wishlist</button>
              </form>
            </div>
          </div>";
}
?>

</div>
</body>
</html>
