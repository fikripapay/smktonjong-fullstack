<?php
// Mengimpor file koneksi.php
include "koneksi.php";

// Memeriksa apakah parameter 'detail' telah diset dalam URL
if (isset($_GET['detail'])){
    // Menyimpan nilai 'detail' dari URL ke dalam variabel $id_berita
    $id_berita = $_GET['detail'];

    // Menyiapkan query untuk mengambil detail berita berdasarkan id
    $query = "SELECT * FROM tb_berita WHERE id = ?";
    // Menyiapkan statement SQL
    $stmt = $conn->prepare($query);
    // Mengikat parameter ke placeholder pada query
    $stmt->bind_param("s", $id_berita);
    // Mengeksekusi statement SQL
    $stmt->execute();
    // Mendapatkan hasil dari eksekusi query
    $result = $stmt->get_result();

    // Memeriksa apakah terdapat baris hasil query
    if ($result->num_rows > 0){
        // Melakukan iterasi melalui hasil query dan menetapkan nilai ke variabel yang sesuai
        while ($row = $result->fetch_assoc()){
            $thumbnail = $row['thumbnail'];
            $judul = $row['judul'];
            $waktu = $row['waktu'];
            $berita = $row['berita'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="<?php echo $judul ?>" />
    <meta name="keywords"
        content="smk tonjong, smks tonjong, smp tonjong, smp bogor, smk bogor, yayasan dharma bhakti tonjong bogor, yayasan dharma bhakti smk tonjong bogor, smk tonjong bojong gede" />
    <title><?php echo $judul ?> - SMK TONJONG</title>
    <link rel="icon" href="assets/img/logo/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Style AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />

    <!-- My CSS -->
    <link rel="stylesheet" href="assets/style/app.css" />

    <style>
      .thumbnail img {
        width: 50%;
      }

      @media (max-width: 768px) {
        .thumbnail img {
          width: 100%;
        }
      }
    </style>
</head>

<body>
    <!-- Preloader -->

    <!-- Start Navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg sticky-top border-bottom" style="background-color: #071952;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php" data-aos="fade-down" data-aos-once="true"
                data-aos-duration="1000">
                <img src="assets/img/logo/logo.png" alt="logo smk tonjong" height="65"
                    class="d-inline-block align-text-center me-2" />
                <div class="brand-title text-white">
                    <span>YAYASAN DHARMA BHAKTI<br />
                        SMK TONJONG</span>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation" data-aos="fade-right" data-aos-once="true" data-aos-duration="1000">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup" data-aos="fade-right"
                data-aos-once="true" data-aos-duration="1000">
                <div class="navbar-nav">
                    <a class="nav-link active" href="index.php">Home</a>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle text-white"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                            <a class="dropdown-item my-dropdown" style="color: #071952;" href="profile.php"
                                >Profile</a
                            >
                            </li>
                            <li>
                            <a class="dropdown-item my-dropdown" style="color: #071952;" href="dkv.php"
                                >Desain Komunikasi Visual</a
                            >
                            </li>
                            <li>
                            <a class="dropdown-item my-dropdown" style="color: #071952;" href="mplb.php"
                                >Manajemen Perkantoran dan Layanan Bisnis</a
                            >
                            </li>
                            <a class="dropdown-item my-dropdown" style="color: #071952;" href="pengajar-staff.php"
                                >Pengajar & Staff</a
                            >
                            </li>
                        </ul>
                    </li>
                    <a class="nav-link text-white" href="galeri.php">Galeri</a>
                    <a class="nav-link text-white" href="berita.php">Berita</a>
                    <a class="nav-link text-white" href="#kontak">Kontak</a>
                    <a class="nav-link ms-lg-3 mt-3 mt-lg-0 text-center rounded text-white" href="info-ppdb.php" style="background-color: #28a745";>Info PPDB</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Main -->
    <main>
        <div class="container py-5 text-center">
            <!-- Menampilkan judul berita -->
            <h2 style="color: #21409a;"><?php echo $judul ?></h2>
            <!-- Menampilkan waktu berita -->
            <?php echo '<p>' . $waktu . '</p>' ?>
            <div class="thumbnail">
                <!-- Menampilkan gambar thumbnail berita -->
                <img src="assets/img/berita/<?php echo basename($thumbnail); ?>" alt="Picture" class="img-fluid">
            </div>
            <div class="content text-start mt-5">
                <?php
                // Misalkan $prestasi_siswa adalah teks yang berisi prestasi yang didapatkan oleh siswa dari database
                $prestasi_siswa = $berita;

                // Memisahkan teks menjadi array berdasarkan tanda titik
                $prestasi_siswa_array = explode("...", $prestasi_siswa);

                // Menampilkan setiap elemen array dalam tag <p>
                foreach ($prestasi_siswa_array as $prestasi) {
                    echo "<p style='text-align: justify;'>$prestasi.</p>";
                }
                ?>
            </div>
        </div>
    </main>
    <!-- End Main -->


    <!-- Start Kontak Section -->
    <section id="kontak" class="kontak">
        <div class="container">
            <div class="row py-5 justify-content-sm-between">
                <div class="col-md-2">
                    <h3>Ikuti Kami</h3>
                    <div class="followme">
                        <a href="https://www.instagram.com/smktonjong/" target="_blank"><i
                                class="fa-brands fa-square-instagram"></i></a>
                        <a href="https://www.youtube.com/@smkstonjong6210" target="_blank"><i class="fa-brands fa-square-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3>Hubungi Kami</h3>
                    <div class="detail">
                        <i class="fa-solid fa-phone"></i>
                        <span>(0251) 8583881</span>
                    </div>
                    <div class="detail mt-3">
                        <a href="https://wa.me/6285772226202" target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                            +62 857-7222-6602
                        </a>
                    </div>
                    <div class="detail mt-3">
                        <a href="mailto:smktonjong@gmail.com" target="_blank">
                            <i class="fa-regular fa-envelope"></i>
                            smktonjong@gmail.com</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <h3>Lokasi</h3>
                    <div class="lokasi">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7928.424564449169!2d106.75924559127593!3d-6.494785423989194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c2f654a8a85b%3A0x51cf6d4a78fe70fc!2sYayasan%20Dharma%20Bakti%20SMK%20TONJONG!5e0!3m2!1sid!2sid!4v1712673758098!5m2!1sid!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Kontak Section -->

    <!-- Start Footer -->
    <footer class="footer text-center">
        <p class="text-white">
            Copyright &copy; 2024 SMK Tonjong. All Rights Reserved.
        </p>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Script AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    AOS.init();
    </script>

    <!-- My Script -->
    <script src="assets/script/app.js"></script>
</body>

</html>