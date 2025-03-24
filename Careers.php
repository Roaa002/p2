<?php
// db_connection.php
$host = 'localhost';
$db = 'company_jobs';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");


$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id'];
    $job_title = $_POST['job_title'];
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cover_letter = $_POST['cover-letter'];

    // تحميل ملف السيرة الذاتية
    $target_dir = "./images/cv/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); // إنشاء المجلد إذا لم يكن موجودًا
    }

    $file_name = basename($_FILES["cv"]["name"]);
    $target_file = $target_dir . $file_name;

    // تحقق من أن الملف تم تحميله بنجاح
    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
        // إدخال البيانات في جدول applications
        $sql = "INSERT INTO applications (job_id, job_title, full_name, email, phone, cv_path, cover_letter)
                VALUES ('$job_id', '$job_title', '$full_name', '$email', '$phone', '$target_file', '$cover_letter')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Application submitted successfully.')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Application submitted successfully.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>HUMANITY AI’d</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Muli:300,400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
    <style>
        .intro-section:before {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
            background: #3f56a6;
            border-bottom-right-radius: 0px;
        }

        .intro-section,
        .intro-section .container .row {
            height: 60vh;
            min-height: 90px;
        }

        .intro-section h5 {
            font-size: 1rem;
            font-weight: 900;
            color: #f1f1f1;
        }


        .breadcrumb {
            position: absolute;
            bottom: 10px;

            left: 15px;

            background: none;
            margin-bottom: 0;

        }

        .breadcrumb a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #ffffff;
        }


        /* .job-posting {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .job-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .job-subtitle {
            font-size: .9rem;
            color: #555;
            margin-bottom: 20px;
        }

        .job-description,
        .job-cta {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
        }

        .job-details h4 {
            font-size: 1.4rem;
            color: #444;
            margin-top: 20px;
        }

        .job-details ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        .job-details li {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
        }

        .apply-button {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }

        .apply-button:hover {
            background: white;
            color: #007bff;
        }

        .application-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .application-form h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 1rem;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .submit-button {
            display: inline-block;
            padding: 10px 20px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #218838;
        } */
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="100">


    <!-- <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->


    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="site-logo">
                        <img src="./images/2.png" id="logo1" class="logo active" alt="Logo 1">
                        <img src="./images/3.png" id="logo2" class="logo" alt="Logo 2">
                    </div>

                    <div>
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-xl-block">
                                <li><a href="./index.html#home-section" class="nav-link">Home</a></li>
                                <li><a href="./about_us.html" class="nav-link">About Us</a></li>
                                <li><a href="./index.html#services-section" class="nav-link">Our Features</a></li>
                                <li><a href="./Careers.php" class="nav-link active">Careers</a></li>

                            </ul>
                        </nav>
                    </div>
                    <div class="ml-auto">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-xl-block">

                                <li class="cta"><a href="index.html#contact-section" class="nav-link"><span
                                            class="border bg-danger rounded text-white border-danger">Contact Us</span></a>
                                </li>
                            </ul>
                        </nav>
                        <a href="#" class="d-inline-block d-xl-none site-menu-toggle js-menu-toggle float-right"><span
                                class="icon-menu h3"></span></a>
                    </div>
                </div>
            </div>

        </header>

        <div class="intro-section custom-owl-carousel breadcrumb-section" id="home-section">
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-12">
                <!-- شريط البحث -->
                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="search....">
                    <button id="search-button">search</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="search-results" id="search-results" style="display: none;">
    <h3>Search result</h3>
    <ul id="results-list"></ul>
</div>
        <!-- <div class="site-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="job-posting">
                            <h2 class="job-title">🚀 Careers: Join Our Team</h2>
                            <h3 class="job-subtitle">We’re Hiring: Computer Vision/AI Expert</h3>
                            <p class="job-description">
                                We are looking for talented professionals who share our passion for AI and smart glasses
                                technology. If you are eager to be part of an innovative and fast-growing company, we
                                invite you to apply.
                            </p>
                            <div class="job-details">
                                <h4>🔹 Responsibilities:</h4>
                                <ul>
                                    <li>Develop and optimize computer vision algorithms.</li>
                                    <li>Work on AI-driven applications for smart glasses.</li>
                                    <li>Collaborate with cross-functional teams to integrate AI solutions.</li>
                                </ul>
                                <h4>🔹 Requirements:</h4>
                                <ul>
                                    <li>Strong background in computer vision and AI.</li>
                                    <li>Experience with machine learning frameworks.</li>
                                    <li>Passion for innovation and technology.</li>
                                </ul>
                            </div>
                            <p class="job-cta">
                                Join us as we lead the charge in transforming lives through smart glasses technology.
                            </p>
                            <a href="#apply-form" class="apply-button" id="apply-button">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="apply-form" class="site-section" style="display: none;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="application-form">
                            <h2>Apply for the Position</h2>
                            <form action="submit_application.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="cv">Upload CV</label>
                                    <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                </div>
                                <div class="form-group">
                                    <label for="cover-letter">Cover Letter</label>
                                    <textarea id="cover-letter" name="cover-letter" rows="5"></textarea>
                                </div>
                                <button type="submit" class="submit-button">Submit Application</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->




        <div class="site-section">
    <div class="container">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                $counter = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($counter % 3 == 0) {
                        echo '</div><div class="row">'; // إغلاق الصف الحالي وفتح صف جديد كل 3 وظائف
                    }
                    echo '<div class="col-lg-4" data-aos="fade-up">';
                    echo '<div class="job-posting">';
                    
                    // العنوان مع نوع الوظيفة
                    echo '<h2 class="job-title">' . $row["title"] .'</h2>';
                    echo '<h3 class="job-subtitle d-flex justify-content-between align-items-center">'; 
                    echo '<span>' . $row["level"] . '</span>';
                    echo '</h3>';
                    echo '<span class="job-type">' . $row["location"] . '</span>';
                    echo '<p class="job-description">' . $row["short_description"] . '</p>';
                    
                    // زر "اقرأ المزيد" بحجم أصغر مع سهم
                    echo '<a href="#" class="read-more small-link" data-job-id="' . $row["id"] . '">Read More <i class="fas fa-arrow-right"></i></a>';
                    
                    // زر "Read Less" مخفي في البداية
                    echo '<a href="#" class="read-less small-link hidden" data-job-id="' . $row["id"] . '">Read Less <i class="fas fa-arrow-up"></i></a>';
                    
                    // تفاصيل الوظيفة مع مسافة بينها وبين العنصر التالي
                    echo '<div id="job-details-' . $row["id"] . '" class="job-details hidden">';
                    echo '<h4>🔹 Full Description:</h4>';
                    echo '<p>' . $row["full_description"] . '</p>';
                    echo '<a href="#" class="apply-button" data-job-id="' . $row["id"] . '">Apply Now</a>';
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                    $counter++;
                }
            } else {
                echo "No job postings available.";
            }
            ?>
        </div>
    </div>
</div>


    <!-- نافذة منبثقة -->
    <div id="apply-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Apply for the Position</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="job_id" name="job_id" value="">
            <input type="hidden" id="job_title" name="job_title" value="">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="cv">Upload CV</label>
                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
            </div>
            <div class="form-group">
                <label for="cover-letter">Cover Letter</label>
                <textarea id="cover-letter" name="cover-letter" rows="5"></textarea>
            </div>
            <button type="submit" class="submit-button">Submit Application</button>
        </form>
    </div>
</div>
        


        <footer class="footer-section">
            <div class="container text-center">
                <!-- الشعار في الأعلى -->
                <div class="footer-logo">
                    <img src="./images/1.png" alt="Logo">
                </div>
                <ul class="list-unstyled footer-social">

                    <li><a href="Privacy.html">Terms and Privacy</a></li>
                </ul>
                <!-- أيقونات السوشيال ميديا -->
                <ul class="list-unstyled footer-social">
                    <li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a></li>
                </ul>

                <!-- الكوبي رايت أسفل الأيقونات -->
                <div class="footer-bottom">
                    <p>Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> All rights reserved by <a href="#"
                            style="color:#fff;">Bebsa6a</a>
                    </p>
                </div>
            </div>
        </footer>



    </div> <!-- .site-wrap -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // تغيير الشعار عند التمرير
        var logo1 = document.getElementById("logo1");
        var logo2 = document.getElementById("logo2");

        window.addEventListener("scroll", function () {
            var scrolled = window.scrollY > 50;
            logo1.style.opacity = scrolled ? "0" : "1";
            logo2.style.opacity = scrolled ? "1" : "0";
        });

        // عرض تفاصيل الوظيفة عند النقر على "Read More" وإدارة "Read Less"
        document.querySelectorAll('.read-more').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const jobId = this.getAttribute('data-job-id');
                const jobDetails = document.getElementById('job-details-' + jobId);
                const readLessLink = document.querySelector(`.read-less[data-job-id="${jobId}"]`);

                // إظهار التفاصيل وإخفاء زر "Read More" وإظهار زر "Read Less"
                jobDetails.style.display = 'block';
                this.style.display = 'none';
                readLessLink.style.display = 'inline';
                jobDetails.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // إخفاء تفاصيل الوظيفة عند النقر على "Read Less"
        document.querySelectorAll('.read-less').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const jobId = this.getAttribute('data-job-id');
                const jobDetails = document.getElementById('job-details-' + jobId);
                const readMoreLink = document.querySelector(`.read-more[data-job-id="${jobId}"]`);

                // إخفاء التفاصيل وإخفاء زر "Read Less" وإظهار زر "Read More"
                jobDetails.style.display = 'none';
                this.style.display = 'none';
                readMoreLink.style.display = 'inline';
            });
        });

        // إظهار نموذج التقديم عند النقر على "Apply Now"
        document.querySelectorAll('.apply-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const jobId = this.getAttribute('data-job-id');
                document.getElementById('job_id').value = jobId;
                const applyForm = document.getElementById('apply-form');
                applyForm.style.display = 'block';
                applyForm.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // البحث في الوظائف
        document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const jobPostings = document.querySelectorAll('.job-posting');

    // وظيفة البحث
    function searchJobs() {
        const searchTerm = searchInput.value.trim().toLowerCase();

        jobPostings.forEach(job => {
            const jobTitle = job.querySelector('.job-title').textContent.toLowerCase();
            if (jobTitle.includes(searchTerm)) {
                job.style.display = 'block'; // عرض الوظيفة إذا تطابقت مع البحث
            } else {
                job.style.display = 'none'; // إخفاء الوظيفة إذا لم تتطابق
            }
        });
    }

    // حدث البحث عند النقر على زر البحث
    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        searchJobs();
    });

    // حدث البحث عند الضغط على Enter في حقل البحث
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchJobs();
        }
    });

    // نقل المستخدم إلى مكان الوظيفة عند النقر على نتيجة البحث
    jobPostings.forEach(job => {
        job.addEventListener('click', function() {
            const jobId = job.querySelector('.read-more').getAttribute('data-job-id');
            const jobDetails = document.getElementById('job-details-' + jobId);

            // نقل المستخدم إلى مكان الوظيفة
            jobDetails.scrollIntoView({ behavior: 'smooth' });

            // عرض تفاصيل الوظيفة
            jobDetails.style.display = 'block';
        });
    });
});
// 
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const jobPostings = document.querySelectorAll('.job-posting');
    const resultsList = document.getElementById('results-list');
    const searchResults = document.getElementById('search-results');

    // وظيفة البحث
    function searchJobs() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        resultsList.innerHTML = ''; // مسح النتائج السابقة

        jobPostings.forEach(job => {
            const jobTitle = job.querySelector('.job-subtitle').textContent.toLowerCase();
            if (jobTitle.includes(searchTerm)) {
                const jobId = job.querySelector('.read-more').getAttribute('data-job-id');
                const listItem = document.createElement('li');
                listItem.innerHTML = `<a href="#job-details-${jobId}" class="search-result-link">${jobTitle}</a>`;
                resultsList.appendChild(listItem);
            }
        });

        // عرض أو إخفاء قسم نتائج البحث
        if (resultsList.children.length > 0) {
            searchResults.style.display = 'block';
        } else {
            searchResults.style.display = 'none';
        }
    }

    // حدث البحث عند النقر على زر البحث
    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        searchJobs();
    });

    // حدث البحث عند الضغط على Enter في حقل البحث
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchJobs();
        }
    });

    // نقل المستخدم إلى مكان الوظيفة عند النقر على نتيجة البحث
    resultsList.addEventListener('click', function(e) {
        if (e.target.classList.contains('search-result-link')) {
            e.preventDefault();
            const jobId = e.target.getAttribute('href').split('-')[2];
            const jobDetails = document.getElementById('job-details-' + jobId);

            // نقل المستخدم إلى مكان الوظيفة
            jobDetails.scrollIntoView({ behavior: 'smooth' });

            // عرض تفاصيل الوظيفة
            jobDetails.style.display = 'block';
        }
    });
});
        // النافذة المنبثقة عند التقديم على الوظيفة
        const modal = document.getElementById('apply-modal');
        const closeBtn = document.querySelector('.close');

        document.querySelectorAll('.apply-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const jobId = this.getAttribute('data-job-id');
                const jobTitle = this.closest('.job-posting').querySelector('.job-subtitle').textContent;

                document.getElementById('job_id').value = jobId;
                document.getElementById('job_title').value = jobTitle;
                modal.style.display = 'block';
            });
        });

        closeBtn.addEventListener('click', () => modal.style.display = 'none');
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.style.display = 'none';
        });
    });
</script>

</body>

</html>