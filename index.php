<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// ====== Handle Add to Watchlist for hotel/activity ==========
$added_msg = '';
if (
    isset($_POST['add_watchlist']) &&
    isset($_SESSION['user_id']) &&
    isset($_POST['type']) &&
    isset($_POST['watchable_id'])
) {
    $user_id = (int)$_SESSION['user_id'];
    $watchable_type = trim(strtolower($_POST['type']));
    $watchable_id = (int)$_POST['watchable_id'];

    if (in_array($watchable_type, ['hotel', 'activity'])) {
        $stmt = $conn->prepare("SELECT id FROM watchlists WHERE user_id=? AND watchable_type=? AND watchable_id=?");
        $stmt->bind_param("isi", $user_id, $watchable_type, $watchable_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 0) {
            $stmt2 = $conn->prepare("INSERT INTO watchlists (user_id, watchable_type, watchable_id) VALUES (?, ?, ?)");
            $stmt2->bind_param("isi", $user_id, $watchable_type, $watchable_id);
            $stmt2->execute();
            $stmt2->close();
            $added_msg = "Added to watchlist!";
        } else {
            $added_msg = "Already in watchlist!";
        }
        $stmt->close();
    }
}

// جلب قائمة الفنادق
$result = $conn->query("SELECT * FROM hotels ORDER BY RAND() LIMIT 10");
// جلب قائمة النشاطات
$result2 = $conn->query("SELECT * FROM activities ORDER BY RAND() LIMIT 10");
// جلب قائمة الواتش ليست للمستخدم
$user_watchlist_hotel = $user_watchlist_activity = [];
if (isset($_SESSION['user_id'])) {
    $uid = (int)$_SESSION['user_id'];
    $q1 = $conn->query("SELECT watchable_id FROM watchlists WHERE user_id=$uid AND watchable_type='hotel'");
    while($roww = $q1->fetch_assoc()) $user_watchlist_hotel[] = (int)$roww['watchable_id'];
    $q2 = $conn->query("SELECT watchable_id FROM watchlists WHERE user_id=$uid AND watchable_type='activity'");
    while($roww = $q2->fetch_assoc()) $user_watchlist_activity[] = (int)$roww['watchable_id'];
}

// جلب المراجعات
$reviews_result = $conn->query("SELECT * FROM reviews ORDER BY RAND() LIMIT 12");


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Menzabetha</title>
  <link rel="stylesheet" href="Css/homestyle.css">
  <style>
    .cover {
      height: 100vh;
      background: url('Assets/Image/home-slide-2.jpg') no-repeat center center/cover;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      position: relative;
    }
    .btn.added { background: green !important; color: #fff; pointer-events: none; }

    .msg { text-align:center; color: green; margin: 20px 0;}
    form select {
    padding: 8px 12px;
    font-size: 16px;
    margin-left: 10px;
}

  </style>
</head>
<body>
<!-- Navbar -->
<header class="navbar">
  <div class="logo">Menzabetha</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="rooms.php">Hotels</a>
    <a href="rentcar.php">Rent</a>
    <a href="activity.php">Activity</a>
     <a href="package.php">packages</a>
      <a href="trips.php">trips</a>
    <a href="contact.php">Contact</a>
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="?logout=true">Logout</a>
      <a href="watchlist.php">Watchlist</a>
    <?php else: ?>
      <a href="login.php">Login</a>
      <a href=""></a>
    <?php endif; ?>
  </nav>
</header>
<!-- Cover -->
<section class="cover">
  <div class="cover-content">
    <h1>Welcome to Menzabetha</h1>
    <a  href="rooms.php" class="btn">Explor Hotels</a>
  </div>
</section>

<?php if (!empty($added_msg)) echo "<div class='msg'>$added_msg</div>"; ?>
<!-- Main Services Section -->
<section style="padding: 60px 0;">
   <h1 style="text-align:center; margin-bottom: 20px;">Our Services</h1>

  <div style="max-width: 1200px; margin: auto; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 30px;">
    
    <!-- Activity Box -->
     <a href="activity.php" style="text-decoration: none; color: inherit;">
    <div style="flex: 1; min-width: 250px; background: white; padding: 40px 20px; text-align: center; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
      <i class="fas fa-hiking" style="font-size: 40px; color: #28a745;"></i>
      <h3 style="margin-top: 15px;">Activity</h3>
    </div>
    </a>

    <!-- Rent Car Box -->
     <a href="rentcar.php" style="text-decoration: none; color: inherit;">
    <div style="flex: 1; min-width: 250px; background: white; padding: 40px 20px; text-align: center; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
      <i class="fas fa-car-side" style="font-size: 40px; color: #007bff;"></i>
      <h3 style="margin-top: 15px;">Rent Car</h3>
    </div>
    </a>

    <!-- Hotel Box -->
     <a href="rooms.php" style="text-decoration: none; color: inherit;">
    <div style="flex: 1; min-width: 250px; background: white; padding: 40px 20px; text-align: center; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
      <i class="fas fa-hotel" style="font-size: 40px; color: #ff6347;"></i>
      <h3 style="margin-top: 15px;">Hotel</h3>
    </div>
    </a> 
     
     <a href="trips.php" style="text-decoration: none; color: inherit;">
  <div style="flex: 1; min-width: 250px; background: white; padding: 40px 20px; text-align: center; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <img src="Assets/Image/map.png" alt="Trips Icon" style="width: 40px; height: 40px;">
    <h3 style="margin-top: 15px;">Trips</h3>
  </div>
</a>


  </div>
</section>

<!-- Include Font Awesome CDN (if not already included) -->
<?php
$cities = ['Amman', 'Ajloun', 'Aqaba', 'Dead sea', 'Jerash', 'Karak', 'Ma\'an', 'Madaba', 'Petra', 'Tafila', 'Wadi rum', 'Zarqa'];

$selectedCity = $_GET['city'] ?? '';
$sql = "SELECT * FROM hotels";
if (in_array($selectedCity, $cities)) {
    $sql .= " WHERE location = ?";
}
$stmt = $conn->prepare($sql);


if (in_array($selectedCity, $cities)) {
    $stmt->bind_param("s", $selectedCity);
}

$stmt->execute();
$result = $stmt->get_result();

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<form method="get" style="text-align: center; margin: 30px 0;">
    <label for="city">Filter by City:</label>
    <select name="city" id="city" onchange="this.form.submit()">
        <option value="">-- All Cities --</option>
        <?php foreach ($cities as $city): ?>
            <option value="<?= htmlspecialchars($city) ?>" <?= ($city === $selectedCity) ? 'selected' : '' ?>>
                <?= htmlspecialchars($city) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<!-- Hotel Section -->
<section class="hotel-section" id="hotels">
  <h2>Our Hotel</h2>
  <p style="font-size:18px; text-align:left;">
    we picked you the best hotels in jordan
  <div class="hotel-cards">
<?php
if ($result && $result->num_rows > 0) {
    while ($hotel = $result->fetch_assoc()) {
        $price = rand(100, 500);
        $stars = str_repeat("⭐", rand(3, 5)) . (rand(0, 1) ? "☆" : "");
        $review_count = rand(30, 200);
        $hotel_id = (int)$hotel['id'];
        $is_added = in_array($hotel_id, $user_watchlist_hotel, true);

        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($hotel['image']) . '" alt="' . htmlspecialchars($hotel['name']) . '">';
        echo '<h3>' . htmlspecialchars($hotel['name']) . '</h3>';
        echo '<p>$' . $price . ' / night</p>';

        if (isset($_SESSION['user_id'])) {
            echo '<form method="POST" style="display:inline;">
                    <input type="hidden" name="type" value="hotel">
                    <input type="hidden" name="watchable_id" value="'.$hotel_id.'">
                    <button class="btn'.($is_added ? ' added' : '').'" type="submit" name="add_watchlist" '.($is_added ? 'disabled' : '').'>'.($is_added ? 'Added to Watchlist' : 'Add to Watchlist').'</button>
                  </form>';

            echo '<a href="view_rooms.php?hotel_id=' . $hotel_id . '" class="btn" style="margin-left: 10px;">More Details</a>';
        } else {
            echo '<a href="login.php" class="btn" onclick="return confirm(\'Please login to add to watchlist.\')">Watchlist</a>';
        }

        echo '<p class="review">' . $stars . ' (' . $review_count . ' reviews)</p>';
        echo '</div>';
    }
} else {
    echo '<p>No hotels found.</p>';
}
?>

  </div>
</section>

<!-- Activities Section -->
<section class="activities">
  <h2>Explore Our Activities</h2>
  <div class="activity-grid">
    <?php
    if ($result2 && $result2->num_rows > 0) {
        while ($activity = $result2->fetch_assoc()) {
            $activity_id = (int)$activity['id'];
            $is_added = in_array($activity_id, $user_watchlist_activity, true);
            echo '<div class="activity-card">';
            echo '<img src="' . htmlspecialchars($activity['image']) . '" alt="' . htmlspecialchars($activity['title']) . '">';
            echo '<h3>' . htmlspecialchars($activity['title']) . '</h3>';
            echo '<p>' . htmlspecialchars($activity['description']) . '</p>';
            echo '<p class="price">$' . number_format($activity['price'], 2) . ' / person</p>';
            echo '<a class="btn" href="activity_details.php?id=' . $activity['id'] . '">More Details</a>';
            if (isset($_SESSION['user_id'])) {
              echo '<form method="POST" style="display:inline;">
                      <input type="hidden" name="type" value="activity">
                      <input type="hidden" name="watchable_id" value="'.$activity_id.'">
                    </form>';
            } else {
              echo '<a href="login.php" class="btn" onclick="return confirm(\'Please login to add to watchlist.\')">Watchlist</a>';
            }
            echo '</div>';
        }
    } else {
        echo '<p>No activities available.</p>';
    }
    ?>
  </div>
</section>

<!-- Reviews Section -->
<section class="reviews">
  <h2>What Our Guests Say</h2>
  <div class="carousel-wrapper">
    <button class="arrow left" onclick="scrollReviews(-1)">&#10094;</button>
    <div class="review-grid" id="reviewCarousel">
      <?php
      if ($reviews_result && $reviews_result->num_rows > 0) {
          while ($review = $reviews_result->fetch_assoc()) {
              $user = htmlspecialchars($review['user_name'] ?? 'Guest');
              $rating = intval($review['rating']);
              $comment = htmlspecialchars($review['comment']);
              $stars = str_repeat("⭐", $rating) . str_repeat("☆", 5 - $rating);
              $avatar = "https://randomuser.me/api/portraits/" . (rand(0, 1) ? "men/" : "women/") . rand(1, 80) . ".jpg";
              echo '
              <div class="review-card">
                <img src="' . $avatar . '" alt="' . $user . '" class="avatar">
                <p class="stars">' . $stars . '</p>
                <p>"' . $comment . '"</p>
                <h4>- ' . $user . '</h4>
              </div>';  
          }
      } else {
          echo '<p>No reviews yet.</p>';
      }
      ?>
    </div>
    <button class="arrow right" onclick="scrollReviews(1)">&#10095;</button>
  </div>
</section>

<!-- Explore Room CTA -->
<section class="explore-room">  
  <div class="explore-image">
    <a  href="rooms.php" class="explore-btn">Explor Hotels</a>
  </div>
</section>

<!-- Footer -->
<footer class="footer">
  <p>&copy; 2025 Hotel Menzabetha. All rights reserved.</p>
  <div class="footer-links">
    <a href="#">Privacy</a>
    <a href="#">Terms</a>
    <a href="#">Support</a>
  </div>
</footer>

<script src="Js/code.js"></script>
<script>
  function scrollReviews(direction) {
    const container = document.getElementById('reviewCarousel');
    const cardWidth = container.querySelector('.review-card').offsetWidth + 30;
    container.scrollBy({
      left: direction * (cardWidth * 3),
      behavior: 'smooth'
    });
  }
</script>
</body>
</html>
