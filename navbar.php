<!-- navbar.php -->
<style>
  .navbar {
    background-color: #2e7d32;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: 'Poppins', sans-serif;
  }

  .navbar .nav-left {
    font-size: 1.4em;
    font-weight: bold;
    color: white;
  }

  .navbar .nav-right a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    font-weight: 500;
    transition: color 0.3s ease;
  }

  .navbar .nav-right a:hover {
    color: #a5d6a7;
  }

  .nav-right {
    display: flex;
    align-items: center;
  }
</style>

<div class="navbar">
  <div class="nav-left">🌴 WisataNusantara</div>
  <div class="nav-right">
    <a href="home.php">Home</a>
    <a href="pengunjung.php">Pengunjung</a>
    <a href="pengelola.php">Pengelola</a>
    <a href="villa.php">Villa</a>
    <a href="wahana.php">Wahana</a>
  </div>
</div>
