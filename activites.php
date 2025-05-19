<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menzabetha Activities</title>
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
  <h1>Find an Activity</h1>
  <form method="GET" action="">
    <input type="text" name="destination" placeholder="e.g. Amman" required>
    <button type="submit">Search</button>
  </form>

<?php
// Fake API call
function fetchActivities($destination) {
    return [
        [
            'name' => "Hiking in $destination",
            'description' => 'Enjoy guided mountain hiking adventure.',
            
            'image' => 'http://localhost/project101/back/travel/images/hiking.jpg',
            'duration' => '3 hours',
            'location' => $destination
        ]
    ];
}

if (isset($_GET['destination'])) {
    $destination = htmlspecialchars($_GET['destination']);
    $activities = fetchActivities($destination);

    if (empty($activities)) {
        echo "<p>No activities found for '$destination'.</p>";
    } else {
        foreach ($activities as $activity) {
            $name = htmlspecialchars($activity['name']);
            $description = htmlspecialchars($activity['description']);
           
            $image = htmlspecialchars($activity['image']);
            $duration = htmlspecialchars($activity['duration']);
            $location = htmlspecialchars($activity['location']);

            echo "<div class='activity-card'>
                    <img src='$image' alt='$name' style='width: 150px; height: 100px; object-fit: cover; border-radius: 8px;'>
                    <div>
                      <h3>$name</h3>
                      <p>$description</p>
                     
                      <p><strong>Duration:</strong> $duration</p>
                      <p><strong>Location:</strong> $location</p>
                      <form method='POST' action='add_to_wishlist.php'>
                          <input type='hidden' name='item_id' value='activity_$name'>
                          <input type='hidden' name='item_type' value='activity'>
                          <input type='hidden' name='name' value='$name'>
                         
                          <button type='submit'>Add to Wishlist</button>
                      </form>
                    </div>
                  </div>";
        }
    }
}
?>

<h2>Suggested Activities</h2>

<?php
$suggestedActivities = [
    [
        'name' => 'Hiking',
        'desc' => 'Experience the natural beauty of Jordan through guided hiking adventures across stunning landscapes.',
        
        'img' => 'http://localhost/project101/back/travel/images/photo_5861684362884532204_y.jpg',
        'duration' => '4 to 5 hours',
        'location' => 'Amman'
        
    ],
    [
        'name' => 'Horseback Riding',
        'desc' => 'Ride through scenic trails with a guide.',
        
        'img' => 'http://localhost/project101/back/travel/images/horse.jpg',
        'duration' => '1.5 hours',
        'location' => 'Wadi Rum'
    ],
    [
        'name' => 'Photography Tour',
        'desc' => 'Capture the beauty of Petra with a pro.',
        
        'img' => 'http://localhost/project101/back/travel/images/photo.jpg',
        'duration' => '3 hours',
        'location' => 'Petra'
    ]
];

foreach ($suggestedActivities as $activity) {
    echo "<div class='activity-card'>
            <img src='{$activity['img']}' alt='{$activity['name']}' style='width: 150px; height: 100px; object-fit: cover; border-radius: 8px;'>
            <div>
              <h3>{$activity['name']}</h3>
              <p>{$activity['desc']}</p>
              
              <p><strong>Duration:</strong> {$activity['duration']}</p>
              <p><strong>Location:</strong> {$activity['location']}</p>
              <form method='POST' action='add_to_wishlist.php'>
                <input type='hidden' name='item_id' value='activity_{$activity['name']}'>
                <input type='hidden' name='item_type' value='activity'>
                <input type='hidden' name='name' value='{$activity['name']}'>
               
                <button type='submit'>Add to Wishlist</button>
              </form>
            </div>
          </div>";
}
?>

</div>
</body>
</html>